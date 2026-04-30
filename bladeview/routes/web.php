<?php

require 'app/Classes.php';

use App\Core\Route;
use App\Controller\HomeController;
use App\Core\View;

$route = new Route;

$route->get('/', [HomeController::class, 'index']);
$route->get('/king', function () {
    View::make()->render('pages/resume-form.view');
});

$route->dispatch();