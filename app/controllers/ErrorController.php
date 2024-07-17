<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Controllers\AbstractController;

class ErrorController extends AbstractController{

    public function Error403() : Void{
        (new View())->render("403");
    }

    public function Error404() : Void{
        (new View())->render("404");
    }
}