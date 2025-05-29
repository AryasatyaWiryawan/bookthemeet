@extends('layouts.app')
@section('title','Manage Meetings')
@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h2>Meetings</h2>
    <a href="{{ route('meetings.create') }}" class="btn btn-primary">+ New Meeting</a>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th width="150">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($meetings as $m)
      <tr>
        <td>{{ $m->title }}</td>
        <td>{{ \Carbon\Carbon::parse($m->start_time)->format('Y-m-d H:i') }}</td>
        <td>{{ \Carbon\Carbon::parse($m->end_time)->format('Y-m-d H:i') }}</td>
        <td>
          <a href="{{ route('meetings.edit', $m) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
          <form method="POST" action="{{ route('meetings.destroy', $m) }}" class="d-inline"
                onsubmit="return confirm('Delete this meeting?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
