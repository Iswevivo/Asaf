<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Http\Requests\StoreCenterRequest;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::orderBy('name')->paginate(10);
        return view('centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('centers.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCenterRequest $request)
    {
        $center = Center::create($request->validated());
        $center->save();
        return redirect()->route('centres.index')->with('success', 'Centre '.$center->name.' ajoute avec success.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $center = Center::where('name', $name)->first();
        return view('centers.show', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $name)
    {
        $center = Center::where('name', $name)->first();

        return view('centers.form', compact('center'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCenterRequest $request, Center $center)
    {
        $center->fill($request->validated());
        $center->save();

        return redirect()->route('centres.index')->with('success', 'Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $center)
    {
        $center = Center::findOrFail($center)->first();
        $center->delete();

        return redirect()->route('centres.index')->with('success', 'Center deleted successfully.');
    }
}
