<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.tags.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données avec message personnalisé
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ], [
            'name.unique' => 'L\'etiquette "' . $request->name . '" existe déjà. Veuillez choisir un autre nom.',
        ]);

        // Créer la nouvelle catégorie
        Tag::create(['name' => $validatedData['name']]);

        return redirect()->route('posts.create')->with('success', 'Etiquette (mot-clef) ajoutée avec succès. Vous pouvez alors créer un nouvel article avec cette tag.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
