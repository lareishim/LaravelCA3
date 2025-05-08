<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    // Show all players
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    // Show player creation form (admin only)
    public function create()
    {
        return view('players.create');
    }

    // Store a new player (admin only)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'team' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255', // local file name like lebron.jpg
            'highlight_url' => 'nullable|url',
            'afrobeats_track' => 'nullable|string|max:255',
            'points_per_game' => 'nullable|integer',
            'assists_per_game' => 'nullable|integer',
            'rebounds_per_game' => 'nullable|integer',
        ]);

        Player::create($request->all());

        return redirect()->route('players.index')->with('success', 'Player added successfully.');
    }

    // Show a single player profile
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    // Show edit form (admin only)
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    // Update a player (admin only)
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'team' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'highlight_url' => 'nullable|url',
            'afrobeats_track' => 'nullable|string|max:255',
            'points_per_game' => 'nullable|integer',
            'assists_per_game' => 'nullable|integer',
            'rebounds_per_game' => 'nullable|integer',
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')->with('success', 'Player updated.');
    }

    // Delete a player (admin only)
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted.');
    }
}
