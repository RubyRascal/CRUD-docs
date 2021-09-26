<?php
function getDocsArray()
{
    $dir = __DIR__ .  '/data/docs';
    $files = array_diff(scandir($dir), ['..', '.']);
    $id = 1;

    $result = array();

    foreach ($files as $file) {
        $string = file_get_contents($dir . '/' . $file);
        $outmsv = json_decode($string, true);
        $id = createIdDocs($file);
        $result[] = array(
            "id" => $id, "json" => $outmsv
        );
    }
    return $result;
}

function createIdDocs($file)
{
    $len = strlen($file);
    $fileName = substr($file, 0, $len - 5);
    return $fileName;
}
