<!DOCTYPE html>
<html>

<head>
    <title>Upload Image</title>
</head>

<body>
    <h1>Upload Image for Pet</h1>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('uploadImage', ['petId' => $pet['id']]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="additionalMetadata">Additional Metadata:</label>
        <input type="text" id="additionalMetadata" name="additionalMetadata" value="{{ old('additionalMetadata') }}"><br><br>

        <label for="file">Select image:</label>
        <input type="file" id="file" name="file" required><br><br>

        <button type="submit">Upload Image</button>
    </form>
</body>

</html>