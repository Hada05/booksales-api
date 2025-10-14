<!DOCTYPE html>
<html>
<head>
    <title>Author List</title>
</head>
<body>
    <h1>Daftar Author</h1>
    <ul>
        <?php foreach ($authors as $author): ?>
            <li><?= $author['id'] ?> - <?= $author['name'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
