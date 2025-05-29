@extends('layouts.app')
@section('title','Add Meeting')
@section('content')
  <div class="card mx-auto" style="max-width: 500px">
    <div class="card-header">New Meeting</div>
    <div class="card-body">
      <form action="{{ route('meetings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input name="title" type="text"
                 class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title') }}">
          @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Start Time</label>
          <input name="start_time" type="datetime-local"
                 class="form-control @error('start_time') is-invalid @enderror"
                 value="{{ old('start_time') }}">
          @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">End Time</label>
          <input name="end_time" type="datetime-local"
                 class="form-control @error('end_time') is-invalid @enderror"
                 value="{{ old('end_time') }}">
          @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Add Meeting</button>
        <a href="{{ route('schedule.index') }}" class="btn btn-link">Cancel</a>
      </form>
    </div>
  </div>
@endsection
