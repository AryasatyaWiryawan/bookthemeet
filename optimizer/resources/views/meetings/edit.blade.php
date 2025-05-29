@extends('layouts.app')
@section('title','Edit Meeting')
@section('content')
  <h2>Edit Meeting</h2>
  <form action="{{ route('meetings.update', $meeting) }}" method="POST" class="mt-3">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input name="title" type="text"
             class="form-control @error('title') is-invalid @enderror"
             value="{{ old('title', $meeting->title) }}">
      @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Start Time</label>
      <input name="start_time" type="datetime-local"
             class="form-control @error('start_time') is-invalid @enderror"
             value="{{ old('start_time', \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d\TH:i')) }}">
      @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">End Time</label>
      <input name="end_time" type="datetime-local"
             class="form-control @error('end_time') is-invalid @enderror"
             value="{{ old('end_time', \Carbon\Carbon::parse($meeting->end_time)->format('Y-m-d\TH:i')) }}">
      @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('meetings.index') }}" class="btn btn-link">Cancel</a>
  </form>
@endsection
