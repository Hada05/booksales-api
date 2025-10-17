<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Author</title>
</head>
<body>
    <h1>✍️ Daftar Author</h1>

    @if($authors->isEmpty())
        <p>Tidak ada data author.</p>
    @else
        <ul>
            @foreach ($authors as $author)
                <li>{{ $author->id }} - {{ $author->name }}</li>
                <p>{{ $author->bio }}</p>
            @endforeach
        </ul>
    @endif
</body>
</html>
