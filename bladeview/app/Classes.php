<?php

spl_autoload_register(function ($class) {

    if (!str_starts_with($class, 'App\\')) {
        return;
    }

    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($path)) {
        require $path;
    }
});
