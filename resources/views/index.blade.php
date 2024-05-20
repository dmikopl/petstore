<!DOCTYPE html>
<html>

<head>
    <title>Pet Store</title>
</head>

<body>
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

</body>

</html>