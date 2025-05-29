<?php

namespace App\Http\Controllers;

use App\Models\MeetingRequest;
use Illuminate\Http\Request;

class MeetingRequestController extends Controller
{
    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'      => 'required|string|max:100',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        MeetingRequest::create($data);

        return redirect()
            ->route('schedule.index')
            ->with('status','Meeting “'.$data['title'].'” added.');
    }

    public function destroy(MeetingRequest $meeting)
    {
        $meeting->delete();
        return back()->with('status','Meeting deleted.');
    }
}
