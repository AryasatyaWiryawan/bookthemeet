@extends('layouts.app')

@section('title','New Room')
@section('content')
  <h2>Create Room</h2>
  <form action="{{ route('rooms.store') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Room Name</label>
      <input name="name" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name') }}">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-link">Cancel</a>
  </form>
@endsection
