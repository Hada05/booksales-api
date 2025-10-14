<!DOCTYPE html>
<html>
<head>
    <title>Genre List</title>
</head>
<body>
    <h1>Daftar Genre</h1>
    <ul>
        <?php foreach ($genres as $genre): ?>
            <li><?= $genre['id'] ?> - <?= $genre['name'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
