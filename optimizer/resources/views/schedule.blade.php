@extends('layouts.app')
@section('title','Room Schedule')
@section('content')
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  {{-- Date Filter --}}
  <form method="GET" action="{{ route('schedule.index') }}" class="mb-3 d-flex align-items-center">
    <label for="date" class="me-2">Select date:</label>
    <input 
      type="date" 
      id="date" 
      name="date" 
      value="{{ $date }}" 
      class="form-control me-2" 
      style="width:auto">
    <button class="btn btn-outline-secondary">Filter</button>
  </form>

  {{-- Actions --}}
  <div class="mb-3 d-flex">
    <form method="POST" action="{{ route('schedule.optimize') }}" class="me-2">
      @csrf
      <input type="hidden" name="date" value="{{ $date }}">
      <button class="btn btn-success">Optimize for {{ $date }}</button>
    </form>
  </div>

  {{-- Schedule Table --}}
  <table class="table table-striped">
    <thead class="table-dark">
      <tr><th>Room</th><th>Meetings on {{ $date }}</th></tr>
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
                  <li>
                    {{ $m->title }}
                    ({{ \Carbon\Carbon::parse($m->start_time)->format('H:i') }}
                     – 
                     {{ \Carbon\Carbon::parse($m->end_time)->format('H:i') }})
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
