<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Pet</title>
</head>

<body>
    <h1>Add New Pet</h1>
    <form action="{{ route('add') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
        </select><br><br>
        <label for="category_id">Category ID:</label>
        <input type="number" id="category_id" name="category_id" value="{{ old('category_id') }}"><br><br>

        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="{{ old('category_name') }}"><br><br>

        <label for="photoUrls">Photo URLs:</label>
        <div id="photoUrlsContainer">
            <input type="text" name="photoUrls[]" placeholder="Enter photo URL" required><br>
        </div>
        <button type="button" onclick="addPhotoUrlField()">Add another photo URL</button><br><br>


        <label for="tags">Tags (id:name comma separated):</label>
        <input type="text" id="tags" name="tags" value="{{ old('tags') }}"><br><br>

        <button type="submit">Add Pet</button>
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