<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\MeetingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        // 1. Grab the date param (default to today)
        $date = $request->query('date', now()->toDateString());

        // 2. Load only that day’s meetings
        $rooms = Room::with(['meetings' => function($q) use ($date) {
            $q->whereDate('start_time', $date)
              ->orderBy('start_time');
        }])->get();

        return view('schedule', compact('rooms','date'));
    }

    public function optimize(Request $request): RedirectResponse
    {
        $date = $request->input('date', now()->toDateString());

        // 1. Find which meetings fall on that date
        $meetingIds = MeetingRequest::whereDate('start_time', $date)
                                    ->pluck('id');

        // 2. Detach those only
        Room::all()->each(fn($r) => $r->meetings()->detach($meetingIds));

        // 3. Fetch and optimize just that day’s meetings
        $meetings = MeetingRequest::whereDate('start_time', $date)
                                  ->orderBy('start_time')
                                  ->get();

        // 4. Greedy assign
        $availability = Room::pluck('id')
                             ->mapWithKeys(fn($id)=>[$id=>null])
                             ->all();

        foreach ($meetings as $m) {
            foreach ($availability as $roomId => $lastEnd) {
                if (is_null($lastEnd) || $m->start_time >= $lastEnd) {
                    $m->rooms()->attach($roomId);
                    $availability[$roomId] = $m->end_time;
                    break;
                }
            }
        }

        return redirect()
            ->route('schedule.index', ['date'=>$date])
            ->with('status', "Optimized for {$date}");
    }
}
