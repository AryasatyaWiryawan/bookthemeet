@extends('layouts.app')

@section('title','Manage Rooms')
@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h2>Rooms</h2>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ New Room</a>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <table class="table table-bordered">
    <thead><tr><th>Name</th><th width="150">Actions</th></tr></thead>
    <tbody>
      @foreach($rooms as $room)
        <tr>
          <td>{{ $room->name }}</td>
          <td>
            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="d-inline" 
                  onsubmit="return confirm('Delete this room?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
