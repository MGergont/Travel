<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\StatisticModel;
use App\Controllers\AbstractController;

class StatisticController extends AbstractController{

    public function statisticView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $statisticModel = new StatisticModel($this->configuration);
            (new View())->render("statistic", $this->paramsView);
        }else{
            $this->redirect("/403");
        }
    }

    
}