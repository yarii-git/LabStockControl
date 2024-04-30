<?php

namespace App\Http\Controllers;

use App\Models\Cascode;
use Illuminate\Http\Request;

class CascodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cascodes = Cascode::latest()->paginate(10);
        return view('cascodes.index', ['cascodes' => $cascodes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cascodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cas_code' => 'required',
            'name' => 'required',
            'fds',
            'status' => 'required',
        ]);

        Cascode::create($request->all());
        return redirect()->route('cascodes.index')->with('success', 'Codi CAS afegit correctament!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cascode $casCode)
    {
        return view('cascodes.edit', compact('casCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cascode $casCode)
    {
        $request->validate([
            'cas_code' => 'required',
            'name' => 'required',
            'fds',
            'status' => 'required',
        ]);

        Cascode::create($request->all());

        return redirect()->route('cascodes.index')->with('success', 'ProduCodi CAS actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cascode $casCode)
    {
        //
    }
}
