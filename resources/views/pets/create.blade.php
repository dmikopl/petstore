@extends('layouts.app')

@section('title', 'Pets')

@section('content')
    <h1>Add New Pet</h1>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name">
        <label>Status:</label>
        <input type="text" name="status">
        <button type="submit">Add Pet</button>
    </form>
@endsection
