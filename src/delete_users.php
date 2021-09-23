<?php
$dir = __DIR__ . '/data/users';
$file = __DIR__ . '/data/users/' . $_GET["id"] . '.json';
unlink($file);
header('Location: /users');
?>