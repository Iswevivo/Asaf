<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Image;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'asaf@gmail.com',
            'password' => Hash::make('asaf2025'),
            'photo_url' => asset('images/5.jpg'), // Utilisation de asset() pour générer l'URL complète
        ]);

        // Créer des catégories, utilisateurs, et posts
        $categories = Category::factory(5)->create();
        $users = User::factory(5)->create();

        $posts = Post::factory(15)->create()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

        // Créer et enregistrer 62 images
        $images = Image::factory(62)->create();

        // Associer au moins 3 images à chaque post en utilisant la table pivot
        foreach ($posts as $post) {
            $randomImages = $images->random(3);
            $post->images()->attach($randomImages->pluck('id'));
        }

        // Créer des tags et les associer aux posts
        $tags = Tag::factory(10)->create();
        foreach ($posts as $post) {
            $randomTags = $tags->random(2);
            $post->tags()->attach($randomTags);
        }

        // Créer des commentaires
        Comment::factory(50)->create()->each(function ($comment) use ($posts) {
            $comment->post_id = $posts->random()->id;
            $comment->user_id = User::all()->random()->id;
            $comment->save();
        });
    }
}