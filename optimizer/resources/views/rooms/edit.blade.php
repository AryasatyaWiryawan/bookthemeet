@extends('layouts.app')

@section('title','Edit Room')
@section('content')
  <h2>Edit Room</h2>
  <form action="{{ route('rooms.update', $room) }}" method="POST" class="mt-3">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Room Name</label>
      <input name="name" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', $room->name) }}">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-link">Cancel</a>
  </form>
@endsection
