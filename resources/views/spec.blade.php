<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details</title>
</head>

<body>
    @if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    @endif
    <h1>Pet Details</h1>
    <p>ID: {{ $pet['id'] }}</p>
    <p>Name: {{ $pet['name'] }}</p>

    @if(isset($pet['category']))
    <p>Category:
    <ul>
        @if(isset($pet['category']['id']))
        <li>ID: {{ $pet['category']['id'] }}</li>
        @endif
        @if(isset($pet['category']['name']))
        <li>Name: {{ $pet['category']['name'] }}</li>
        @endif
    </ul>
    </p>
    @endif
    <p>Photos:
    <ul>
        @foreach ($pet['photoUrls'] as $photoUrl)
        <li>{{ $photoUrl }}</li>
        @endforeach
    </ul>
    </p>
    <p>Tags:
    <ul>
        @if(isset($pet['tags']) && !empty($pet['tags']))
        @foreach ($pet['tags'] as $tag)
        <li>ID: {{ $tag['id'] }}, Name: {{ $tag['name'] }}</li>
        @endforeach
        @else
        <li>No tags available.</li>
        @endif
    </ul>
    </p>

    <form action="{{ route('show', ['petId' => $pet['id']]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this pet?')">Delete Pet</button>
    </form>
    <br>

    <a href="{{ route('pets.edit', ['pet' => $pet['id']]) }}">
        <button>Edit Pet</button>
    </a>

    <br></br>

    <a href="{{ route('pets.update', ['pet' => $pet['id']]) }}">
        <button>Update Form Pet</button>
    </a>

    <br></br>

    <a href="{{ route('pets.upload', ['pet' => $pet['id']]) }}">
        <button>Upload Photo For Pet</button>
    </a>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>

</html>