<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
</head>

<body>
    <h1>Edit Pet</h1>
    <form action="{{ route('edit', ['petId' => $pet['id']]) }}" method="post">
        @csrf
        @method('PUT')
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
        <!-- Kategorie -->
        <label for="category_id">Category ID:</label>
        <input type="text" id="category_id" name="category_id" value="{{ old('category_id', $pet['category']['id'] ?? '') }}"><br><br>
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="{{ old('category_name', $pet['category']['name'] ?? '') }}"><br><br>

        <!-- Zdjęcia -->
        <label for="photoUrls">Photo URLs (comma separated):</label>
        <input type="text" id="photoUrls" name="photoUrls" value="{{ old('photoUrls', implode(',', $pet['photoUrls'] ?? [])) }}"><br><br>

        <!-- Tagi -->
        <label for="tags">Tags (format: id:name, id:name, ...):</label>
        <input type="text" id="tags" name="tags" value="{{ old('tags', implode(',', array_map(function($tag) { return $tag['id'] . ':' . $tag['name']; }, $pet['tags'] ?? []))) }}"><br><br>
        <button type="submit">Update Pet</button>
    </form>

    <script src="/js/photoUrls.js"></script>

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