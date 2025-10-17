<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Genre</title>
</head>
<body>
    <h1>📚 Daftar Genre</h1>

    @if($genres->isEmpty())
        <p>Tidak ada data genre.</p>
    @else
        <ul>
            @foreach ($genres as $genre)
                <li>{{ $genre->id }} - {{ $genre->name }}</li>
                <p>{{ $genre->description }}</p>
            @endforeach
        </ul>
    @endif
</body>
</html>
