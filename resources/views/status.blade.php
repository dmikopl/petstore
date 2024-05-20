<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find by status</title>
</head>

<body>
    <h1>Find by status</h1>

    <form action="{{ route('findByStatus') }}" method="get">
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if(isset($pets))
    <h2>Pets Found:</h2>
    <ul>
        @foreach($pets as $pet)
        <li>
            <strong>ID:</strong> {{ $pet['id'] }}<br>
            @if(isset($pet['name']))
            <strong>Name:</strong> {{ $pet['name'] }}<br>
            @endif
            <strong>Status:</strong> {{ $pet['status'] }}<br>
            <br><br>
        </li>
        @endforeach
    </ul>
    @else
    <h2>No pets Found</h2>
    @endif
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