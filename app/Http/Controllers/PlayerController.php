<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    public function create()
    {
        return view('players.create');
    }

    public function store(Request $request)
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

        Player::create($request->all());

        return redirect()->route('players.index')->with('success', 'Player added successfully.');
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

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

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted.');
    }

    // ✅ Like a player
    public function like(Player $player)
    {
        $user = Auth::user();
        $user->likedPlayers()->syncWithoutDetaching([$player->id]);

        return redirect()->back()->with('success', 'Player liked.');
    }

    // ✅ Unlike a player
    public function unlike(Player $player)
    {
        $user = Auth::user();
        $user->likedPlayers()->detach($player->id);

        return redirect()->back()->with('success', 'Player unliked.');
    }
}
