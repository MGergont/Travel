<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\LoginModel;
use App\Controllers\AbstractController;

class LoginController extends AbstractController{

    public function loginView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            //TODO wejście bezpośrenie jeśli zalogowny
        }else{
            (new View())->render("login");
        }
    }

}