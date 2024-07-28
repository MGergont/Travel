<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\VehicleModel;
use App\Controllers\AbstractController;

class VehicleController extends AbstractController{

    public function vehicleView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $vehicleModel = new VehicleModel($this->configuration);

            $this->paramsView['vehicle'] = $vehicleModel->showVehicle($_SESSION['usersId']);
            
            (new View())->render("vehicle", $this->paramsView);
        }else{
            $this->redirect("/403");
        }
    }

    public function addVehicle() : Void{

        $noteMod = new VehicleModel($this->configuration);

        $data = [
            'mark' => trim($this->request->postParam('mark')),
            'model' => trim($this->request->postParam('model')),
            'year' => trim($this->request->postParam('year')),
            'engine' => trim($this->request->postParam('engine')),
            'course' => trim($this->request->postParam('course')),
            'picture' => trim($this->request->postParam('picture'))
        ];
        
        if(empty($data['mark']) || empty($data['model']) || empty($data['year']) || empty($data['engine']) || empty($data['course']) || empty($data['picture'])){
            FeedbackMess("vehicle", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/vehicle");
        }

        if($noteMod->addVehicle($data, $_SESSION['usersId'])){
            FeedbackMess("vehicle", "Udało się ");
            $this->redirect("/vehicle");
        }else{
            FeedbackMess("vehicle", "Coś poszło nie tak");
            $this->redirect("/vehicle");
        }

    }

    public function editVehicle() : Void{

        $vehicleMod = new VehicleModel($this->configuration);

        $data = [
            'mark' => trim($this->request->postParam('mark')),
            'model' => trim($this->request->postParam('model')),
            'year' => trim($this->request->postParam('year')),
            'engine' => trim($this->request->postParam('engine')),
            'course' => trim($this->request->postParam('course')),
            'picture' => trim($this->request->postParam('picture')),
            'id' => $this->request->postParam('id')
        ];
        
        if(empty($data['id']) || empty($data['mark']) || empty($data['model']) || empty($data['year']) || empty($data['engine']) || empty($data['course']) || empty($data['picture'])){
            FeedbackMess("vehicle", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/vehicle");
        }
        
        if($vehicleMod->editVehicle($data, $_SESSION['usersId'])){
            FeedbackMess("vehicle", "Udało się");
            $this->redirect("/vehicle");
        }else{
            FeedbackMess("vehicle", "Coś poszło nie tak");
            $this->redirect("/vehicle");
        }

    }

    public function dellVehicle() : Void{
        $vehicleMod = new VehicleModel($this->configuration);

        $data = [
            'id' => $this->request->postParam('id')
        ];

        if (empty($data['id'])) {
            FeedbackMess("vehicle", "Wymagany fomularz nie jest uzupełniony");
            $this->redirect("/vehicle");
        }

        if($vehicleMod->delVehicle($data, $_SESSION['usersId'])){
            FeedbackMess("vehicle", "Udało się ");
            $this->redirect("/vehicle");
        }else{
            FeedbackMess("vehicle", "Nie udało się usunąć");
            $this->redirect("/vehicle");
        }

    }

    public function addCostVehicle() : Void{
        $vehicleMod = new VehicleModel($this->configuration);

        $data = [
            'amount' => trim($this->request->postParam('amount')),
            'description' => trim($this->request->postParam('description')),
            'id' => $this->request->postParam('idcostVehicle')
        ];

        if (empty($data['amount']) || empty($data['description'])) {
            FeedbackMess("vehiclecost", "Wymagany fomularz nie jest uzupełniony");
            $this->redirect("/vehicle");
        }

        if(preg_match('/^[0-9]{9,15}$/', $data['amount'])){
            FeedbackMess("vehiclecost", "Niepoprawny znak");
            $this->redirect("/vehicle");
        }

        if($vehicleMod->addCost($data, $_SESSION['usersId'])){
            FeedbackMess("vehiclecost", "Udało się ");
            $this->redirect("/vehicle");
        }else{
            FeedbackMess("vehiclecost", "Nie udało się usunąć");
            $this->redirect("/vehicle");
        }

    }
}