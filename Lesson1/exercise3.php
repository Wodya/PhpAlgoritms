<?php
$source = empty($_GET["dir"])?'C:\\':$_GET["dir"];
$dirs = [];
$files = [];

foreach (new DirectoryIterator($source) as $item){
    if($item->isDot())
        continue;
    if($item->isDir())
        $dirs[] = $item->getFilename();
    else
        $files[] = $item->getFilename();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0 0 0 10px;
            padding: 0;
        }
    </style>
</head>
<body>
    <?php if(dirname($source) != $source) : ?>
        <a href="?">Наверх <?php dirname($source) ?> </a><BR><BR>
    <?php endif; ?>
    <?php foreach ($dirs as $dir): ?>
        <a href="?dir=<?= $source . '/' . $dir ?> "><?= $dir ?></a><BR>
    <?php endforeach; ?>
    <?php foreach ($files as $file): ?>
        <p><?= $file ?></p>
    <?php endforeach; ?>
</body>
</html>

