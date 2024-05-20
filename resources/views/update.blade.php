<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pet</title>
</head>

<body>
    <h1>Update Pet</h1>
    <form action="/pet/{{ $pet['id'] }}/update" method="post">
        @csrf
        @method('POST')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $pet['name']) }}" required><br><br>
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="{{ old('id', $pet['id']) }}" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="available" {{ old('status', $pet['status']) == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status', $pet['status']) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status', $pet['status']) == 'sold' ? 'selected' : '' }}>Sold</option>
        </select><br>
        <button type="submit">Update Pet</button>
    </form>

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