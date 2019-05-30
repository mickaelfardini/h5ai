<?php
spl_autoload_register(function ($class_name) {
    require_once "./inc/class." . $class_name . '.php';
});
// echo "<pre>";
// print_r($_SERVER);
Main::init();
// echo "</pre>";