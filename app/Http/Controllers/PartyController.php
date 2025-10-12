<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parties = Party::all();
        return view('parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartyRequest $request)
    {
        Party::create($request->validated());
        return redirect()->route('parties.index')->with('success', 'Party created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        return view('parties.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        return view('parties.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartyRequest $request, Party $party)
    {
        $party->update($request->validated());
        return redirect()->route('parties.index')->with('success', 'Party updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        $party->delete();
        return redirect()->route('parties.index')->with('success', 'Party deleted successfully.');
    }
}
