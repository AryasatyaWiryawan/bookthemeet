<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\MeetingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Show the current room assignments.
     */
    public function index(): View
    {
        // Load rooms and their meetings, ordered by start_time
        $rooms = Room::with(['meetings' => function($q) {
            $q->orderBy('start_time');
        }])->get();

        return view('schedule', compact('rooms'));
    }

    /**
     * Run the greedy interval-scheduling algorithm.
     */
    public function optimize(): RedirectResponse
    {
        // 1. Detach previous assignments
        Room::all()->each(fn($r) => $r->meetings()->detach());

        // 2. Fetch all meetings sorted by start_time
        $meetings = MeetingRequest::orderBy('start_time')->get();

        // 3. Track availability: room_id => last_end_time
        $availability = Room::pluck('id')->mapWithKeys(fn($id) => [$id => null])->all();

        // 4. Greedy assign
        foreach ($meetings as $m) {
            foreach ($availability as $roomId => $lastEnd) {
                if (is_null($lastEnd) || $m->start_time >= $lastEnd) {
                    // assign meeting to this room
                    $m->rooms()->attach($roomId);
                    // update that room’s availability
                    $availability[$roomId] = $m->end_time;
                    break;
                }
            }
        }

        return redirect()
            ->route('schedule.index')
            ->with('status', 'Schedule optimized!');
    }
}
