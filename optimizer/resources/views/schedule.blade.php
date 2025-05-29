@extends('layouts.app')
@section('title','Room Schedule')
@section('content')
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <div class="d-flex mb-3">
    <a href="{{ route('meetings.create') }}" class="btn btn-outline-primary me-2">
      + Add Meeting
    </a>
    <form method="POST" action="{{ route('schedule.optimize') }}">
      @csrf
      <button class="btn btn-success">Optimize Meetings</button>
    </form>
  </div>

  <table class="table table-striped">
    <thead class="table-dark">
      <tr><th>Room</th><th>Assigned Meetings</th></tr>
    </thead>
    <tbody>
    @foreach($rooms as $room)
      <tr>
        <td>{{ $room->name }}</td>
        <td>
          @if($room->meetings->isEmpty())
            <em>No meetings</em>
          @else
            <ul class="ps-3">
              @foreach($room->meetings as $m)
                <li class="d-flex justify-content-between">
                  <span>
                    {{ $m->title }}
                    ({{ \Carbon\Carbon::parse($m->start_time)->format('H:i') }}
                     &dash;
                     {{ \Carbon\Carbon::parse($m->end_time)->format('H:i') }})
                  </span>
                  <form method="POST"
                        action="{{ route('meetings.destroy', $m) }}"
                        onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">&times;</button>
                  </form>
                </li>
              @endforeach
            </ul>
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
