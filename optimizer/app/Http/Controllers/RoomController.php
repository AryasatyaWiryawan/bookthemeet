<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('name')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'name' => 'required|string|max:50|unique:rooms,name',
        ]);

        Room::create($data);

        return redirect()->route('rooms.index')
                         ->with('status','Room “'.$data['name'].'” created.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $req, Room $room)
    {
        $data = $req->validate([
            'name' => 'required|string|max:50|unique:rooms,name,'.$room->id,
        ]);

        $room->update($data);

        return redirect()->route('rooms.index')
                         ->with('status','Room updated.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('status','Room deleted.');
    }
}
