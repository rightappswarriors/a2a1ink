<?php

namespace App\Controller;

use Exception;

use App\Core\View;

class HomeController
{
    public function index()
    {
        View::make()->render('pages/resume-form.view');
    }
}