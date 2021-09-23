<?php 


echo '$_SERVER[REQUEST_URI]=';
var_dump($_SERVER['REQUEST_URI']);
echo '<br>';

// var_dump($_SERVER);
echo '$_SERVER[QUERY_STRING]=';
var_dump($_SERVER['QUERY_STRING']);
echo '<br>';

echo '$_GET=';
var_dump($_GET);
echo '<br>';

if (false) {

} else {
    http_response_code(404);
    echo '404';
    die();
}