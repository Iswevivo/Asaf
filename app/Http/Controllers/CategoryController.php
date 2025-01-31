<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return view('posts.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données avec message personnalisé
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.unique' => 'La catégorie "' . $request->name . '" existe déjà. Veuillez choisir un autre nom.',
        ]);

        // Créer la nouvelle catégorie
        Category::create(['name' => $validatedData['name']]);

        return redirect()->route('posts.create')->with('success', 'Catégorie ajoutée avec succès. Vous pouvez alors créer un nouvel article avec cette catégorie.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
