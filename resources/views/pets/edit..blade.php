@extends('layouts.app')

@section('title', 'Pets')

@section('content')
    <h1>Edit Pet</h1>
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $pet['name'] }}">
        <label>Status:</label>
        <input type="text" name="status" value="{{ $pet['status'] }}">
        <button type="submit">Update Pet</button>
    </form>
@endsection
