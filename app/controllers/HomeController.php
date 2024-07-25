<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\HomeModel;
use App\Controllers\AbstractController;

class HomeController extends AbstractController{

    public function homeView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            (new View())->render("home");
        }else{
            $this->redirect("/403");
        }
    }
}