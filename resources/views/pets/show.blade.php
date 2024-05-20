@extends('layouts.app')

@section('title', 'Pets')

@section('content')

@if (isset($pet) && isset($pet['name']))
    <h1>{{ $pet['name'] }}</h1>
    <p>Status: {{ $pet['status'] }}</p>
    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <form action="{{ route('pets.uploadImage', $pet['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload Image</button>
    </form>
@else
    <p>Brak informacji o zwierzęciu.</p>
@endif
@endsection

@extends('layouts.app')

@section('title', 'Pets')

@section('content')

    @if (isset($pet) && isset($pet['name']))
        <h1>{{ $pet['name'] }}</h1>
        <p>Status: {{ $pet['status'] }}</p>
        <!-- Dodaj inne dane, które chcesz wyświetlić -->
    @else
        <p>Brak informacji o zwierzęciu.</p>
    @endif

@endsection
