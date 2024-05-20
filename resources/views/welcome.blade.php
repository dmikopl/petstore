<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pets</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
</body>

<br><br>
<p>List of Routes:</p>
<br>
<a href="{{ route('pets.create') }}">
    <button>Create</button>
</a>
<p>/pets/{pet}</p>
<p>/pets/{pet}/edit</p>
<p>/pets/{pet}/update</p>
<p>/pets/{pet}/upload</p>
<p>/pets/find/by/status</p>
</body>

</html>