<?php

namespace App\Http\Controllers;

use App\Models\MeetingRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MeetingRequestController extends Controller
{
    // 1. Listing all meetings
    public function index(): View
    {
        $meetings = MeetingRequest::orderBy('start_time')->get();
        return view('meetings.index', compact('meetings'));
    }

    // 2. Show form to create
    public function create(): View
    {
        return view('meetings.create');
    }

    // 3. Store new meeting
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'      => 'required|string|max:100',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        MeetingRequest::create($data);

        return redirect()
            ->route('meetings.index')
            ->with('status', 'Meeting “'.$data['title'].'” added.');
    }

    // 4. Show form to edit
    public function edit(MeetingRequest $meeting): View
    {
        return view('meetings.edit', compact('meeting'));
    }

    // 5. Update existing meeting
    public function update(Request $request, MeetingRequest $meeting): RedirectResponse
    {
        $data = $request->validate([
            'title'      => 'required|string|max:100',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        $meeting->update($data);

        return redirect()
            ->route('meetings.index')
            ->with('status', 'Meeting updated.');
    }

    // 6. Delete a meeting
    public function destroy(MeetingRequest $meeting): RedirectResponse
    {
        $meeting->delete();

        return back()->with('status', 'Meeting deleted.');
    }
}
