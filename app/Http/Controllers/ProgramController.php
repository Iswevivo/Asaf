<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Center;
use App\Http\Requests\ProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('center')->orderBy('title')->paginate(10);
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = Center::orderBy('name')->pluck('name', 'id');
        return view('programs.form', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramRequest $request)
    {
        // $program = new Program($request->validated());

        $program = Program::create($request->validated());
        $program->save();
        return redirect()->route('programs.index')->with('success', $program->title.' a ete ajoute avec success au centre '.$program->center->name);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $program = Program::with('center')->where('slug', $slug)->firstOrFail();
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();
        $centers = Center::orderBy('name')->pluck('name', 'id');

        return view('programs.form', compact('program', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramRequest $request, Program $Program)
    {
        $Program->fill($request->validated());
        $Program->save();

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $Program)
    {
        $Program = Program::findOrFail($Program)->first();
        $Program->delete();

        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
