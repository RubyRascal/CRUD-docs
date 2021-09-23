<?php
$dir = __DIR__ . '/data/docs';
$file = __DIR__ . '/data/docs/' . $_GET["id"] . '.json';
unlink($file);
header('Location: /docs');
?>