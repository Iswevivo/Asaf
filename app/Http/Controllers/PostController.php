<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    // Afficher la liste des posts
    public function index()
    {
        // $postsToDelete = Post::all();
        // foreach ($postsToDelete as $post) {
        //     if ($post->images()->count() == 0) {
        //         $post->delete();
        //     }
        // }
        $posts = Post::with('images', 'author', 'tags', 'category')->orderBy('created_at', 'desc')->paginate(15);

        return view('posts.index', compact('posts'));
    }

    // Afficher le formulaire de création de post
    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        $tags = Tag::orderBy('name')->pluck('name', 'id');

        return view('posts.form', compact('tags', 'categories'));
    }

    // Enregistrer un nouveau post
    public function store(StorePostRequest $request)
    {        
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'asaf@gmail.com',
        //     'password' => Hash::make('asaf2025'),
        //     'photo_url' => asset('images/5.jpg'), // Utilisation de asset() pour générer l'URL complète
        // ]);

        if ($request->hasFile('images')) {
            $user = Auth::user();
            $post = new Post($request->validated());

            if ($user) {
                $post->user_id = $user->id;
            } else {
                $post->user_id = 1;
            }

            $post->save();
            $post->tags()->sync($request->validated('tags'));
        
            $imageIds = []; // Tableau pour stocker les IDs des images
        
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imageModel = Image::create(['path' => $path]); // Enregistre l'image et récupère l'ID
                $imageIds[] = $imageModel->id; // Ajoute l'ID au tableau
            }
        
            // Synchroniser les IDs des images après la boucle
            $post->images()->sync($imageIds);
        } else {
            return redirect()->back()->with('error', 'Aucune image choisie.');
        }        

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    // Afficher un post spécifique
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->with('images', 'author', 'tags', 'category', 'comments')->first();

        return view('posts.show', compact('post'));
    }

    public function show_images(string $slug)
    {
        $post = Post::where('slug', $slug)->with('images')->first();

        return view('posts.show-images', compact('post'));
    }

    // Afficher le formulaire d'édition d'un post
    public function edit(string $slug)
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        $tags = Tag::orderBy('name')->pluck('name', 'id');
        $post = Post::where('slug', $slug)->with('images', 'author', 'tags', 'category')->first();

        return view('posts.form', compact('post', 'tags', 'categories'));
    }

    // Mettre à jour un post
    public function update(UpdatePostRequest $request, Post $post) {
        $user = Auth::user();
    
        // Mise à jour des données du post
        $post->fill($request->validated());
    
        if ($user) {
            $post->user_id = $user->id;
        } else {
            $post->user_id = 1; // Valeur par défaut si aucun utilisateur n'est authentifié
        }
    
        $post->save();
    
        // Synchroniser les tags
        $post->tags()->sync($request->validated('tags'));
    
        // Gérer les images
        $imageIds = $post->images()->select('images.id')->pluck('id')->toArray(); // Conserve les IDs des images existantes
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imageModel = Image::create(['path' => $path]); // Enregistre l'image et récupère l'ID
                $imageIds[] = $imageModel->id; // Ajoute l'ID au tableau
            }
        }
    
        // Synchroniser toutes les images (anciennes + nouvelles)
        $post->images()->sync($imageIds);
    
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post mis à jour avec succès.');
    }
    
    // Supprimer un post
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function add_comment(Request $request, Post $post) {
        // Validation des données d'entrée
        $data = $request->validate([
            'content' => ['required', 'string']
        ], ['content.required' => 'Vous devez ecrire au moins un mot.']);

        // Récupération de l'utilisateur authentifié
        $user = Auth::user();
    
        // Utilisation de l'instance de Post directement, pas besoin de recherche supplémentaire
        $post_id = $post->id;
    
        // Création d'un nouveau commentaire
        try {
            Comment::create([
                'user_id' => $user ? $user->id : 1,
                'post_id' => $post_id,
                'content' => $data['content'],
            ]);
        } catch (\Exception $e) {
            // dd($e); // Affiche l'exception
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commentaire.');
        }
        
    
        // Redirection vers la page précédente
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }    
}