<?php
use compact\mvvm\FrontController;
include_once '../compact/classes/compact/ClassLoader.php';
compact\ClassLoader::create();

$fc = new FrontController();
$fc->run();
