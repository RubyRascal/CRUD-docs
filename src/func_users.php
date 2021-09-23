<?php
function createId($file)
{
    $len = strlen($file);
    $fileName = substr($file, 0, $len - 5);
    return $fileName;
}

function getUsersArray()
{
    $dir = __DIR__ .  '/data/users';
    $files = array_diff(scandir($dir), ['..', '.']);
    $id = 0;
    $jsonArray = [];

    $result = array();

    foreach ($files as $file) {
        $string = file_get_contents($dir . '/' . $file);
        $outmsv = json_decode($string, true);
        $id = createId($file);
        $result[] = array(
            "id" => $id, "json" => $outmsv
        );
    }

    return $result;
}