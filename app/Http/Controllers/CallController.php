<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Party;
use App\Http\Requests\StoreCallRequest;
use App\Http\Requests\UpdateCallRequest;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calls = Call::with('party', 'user')->get();
        return view('calls.index', compact('calls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = Party::all();
        $users = \App\Models\User::all();
        return view('calls.create', compact('parties', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallRequest $request)
    {
        Call::create($request->validated());
        return redirect()->route('calls.index')->with('success', 'Call created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Call $call)
    {
        $call->load('party', 'user');
        return view('calls.show', compact('call'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Call $call)
    {
        $parties = Party::all();
        $users = \App\Models\User::all();
        return view('calls.edit', compact('call', 'parties', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCallRequest $request, Call $call)
    {
        $call->update($request->validated());
        return redirect()->route('calls.index')->with('success', 'Call updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Call $call)
    {
        $call->delete();
        return redirect()->route('calls.index')->with('success', 'Call deleted successfully.');
    }
}
