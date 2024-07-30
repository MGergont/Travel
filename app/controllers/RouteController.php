<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\RouteModel;
use App\Controllers\AbstractController;

class RouteController extends AbstractController{

    public function routeView() : Void{
        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            if(empty($_SESSION['statusDel'])){
                $_SESSION['statusDel'] = "start";
            }

            $routModel = new RouteModel($this->configuration);

            $this->paramsView['location'] = $routModel->getLocation($_SESSION['usersId']);

            (new View())->render("route", $this->paramsView);
        }else{
            $this->redirect("/403");
        }
    }

    public function startRoute() : Void{
        $routeMod = new RouteModel($this->configuration);
        $result = $routeMod->getIdDel($_SESSION['usersId']);
        $_SESSION['id_del'] = $result['id_del'] + 1; 
        $_SESSION['StartRoute'] = trim($this->request->postParam('StartRoute'));
        $_SESSION['Distance'] = $this->request->postParam('Distance');
        $_SESSION['StopRoute'] = trim($this->request->postParam('StopRoute'));
        $_SESSION['startTrip'] = $this->getCurrentDateTime();

        $_SESSION['statusDel'] = "runtime";
        $this->redirect("/route");
    }

    public function startNextRoute() : Void{
        $_SESSION['StartRoute'] = trim($this->request->postParam('StartRoute'));
        $_SESSION['Distance'] = $this->request->postParam('NextDistance');
        $_SESSION['StopRoute'] = trim($this->request->postParam('StopRoute'));
        $_SESSION['startTrip'] = $this->getCurrentDateTime();

        $_SESSION['statusDel'] = "runtime";
        $this->redirect("/route");
    }

    public function stopRoute() : Void{
        $routeMod = new RouteModel($this->configuration);
        
        $_SESSION['stopTrip'] = $this->getCurrentDateTime();

        $data = [
            'id_del' => $_SESSION['id_del'],
            'StartRoute' => $_SESSION['StartRoute'],
            'Distance' => $_SESSION['Distance'],
            'StopRoute' => $_SESSION['StopRoute'],
            'startTrip' => $_SESSION['startTrip'],
            'stopTrip' => $_SESSION['stopTrip']
        ];

        $routeMod->addTrip($data, $_SESSION['usersId']);

        $_SESSION['statusDel'] = "next";
        $this->redirect("/route");
    }

    public function addCost() : Void{
        $routeMod = new RouteModel($this->configuration);
        
        $_SESSION['stopTrip'] = $this->getCurrentDateTime();

        $data = [
            'id_del' => $_SESSION['id_del'],
            'StartRoute' => $_SESSION['StartRoute'],
            'Distance' => $_SESSION['Distance'],
            'StopRoute' => $_SESSION['StopRoute'],
            'startTrip' => $_SESSION['startTrip'],
            'stopTrip' => $_SESSION['stopTrip']
        ];

        $routeMod->addTrip($data, $_SESSION['usersId']);

        $_SESSION['statusDel'] = "next";
        $this->redirect("/route");
    }

    public function endRoute() : Void{
        unset($_SESSION['id_del']);
        unset($_SESSION['StartRoute']);
        unset($_SESSION['Distance']);
        unset($_SESSION['StopRoute']);
        unset($_SESSION['startTrip']);
        unset($_SESSION['stopTrip']);
        unset($_SESSION['statusDel']);
        $this->redirect("/");
    }

    private function getCurrentDateTime() {
        $now = new \DateTime();
        
        return $now->format('Y-m-d H:i:s');
    }
}