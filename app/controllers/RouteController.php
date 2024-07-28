<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\RouteModel;
use App\Controllers\AbstractController;

class RouteController extends AbstractController{

    public function routeView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            (new View())->render("route", );
        }else{
            $this->redirect("/403");
        }
    }

    public function startRoute() : Void{
        
        

    }
}