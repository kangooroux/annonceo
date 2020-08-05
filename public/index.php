<?php
require __DIR__.'../vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use Service\Router;

try {
    $page = new Router($_SERVER['REQUEST_URI']);
    var_dump($_SERVER['REQUEST_URI']);
    if (false) {

    } else {

    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
}
?>

