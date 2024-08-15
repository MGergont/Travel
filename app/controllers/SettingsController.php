<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\SettingsModel;
use App\Controllers\AbstractController;

class SettingsController extends AbstractController{

    public function settingsView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $settingsModel = new SettingsModel($this->configuration);

            $this->paramsView['user'] = $settingsModel->userData($_SESSION['usersId']);

            (new View())->render("settings", $this->paramsView);
        }else{
            $this->redirect("/403");
        }
    }

    public function userDataChange() : Void{
        $settingsMod = new SettingsModel($this->configuration);

        $data = [
            'firstName' => trim($this->request->postParam('firstName')),
            'lastName' => trim($this->request->postParam('lastName')),
            'phone' => trim($this->request->postParam('phone')),
        ];

        if (empty($data['firstName']) || empty($data['phone'])) {
            FeedbackMess("userSet", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/settings");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['firstName'])){
            FeedbackMess("userSet", "Niedozwolone znaki w nazwie użytkownika");
            $this->redirect("/settings");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['lastName'])){
            FeedbackMess("userSet", "Niedozwolone znaki w nazwie użytkownika");
            $this->redirect("/settings");
        }

        if(!strlen($data['phone']) == 9){
            FeedbackMess("userSet", "Niepoprawny numer telefonu");
            $this->redirect("/settings1");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['phone'])){
            FeedbackMess("userSet", "Niepoprawny numer telefonu");
            $this->redirect("/settings");
        }

        if($settingsMod->editUserData($data, $_SESSION['usersId'])){
            FeedbackMess("userSet", "Udało się ");
            $this->redirect("/settings");
        }else{
            FeedbackMess("userSet", "Coś poszło nie tak");
            $this->redirect("/settings");
        }
    }

    public function userPassChange() : Void{ 
        $settingsMod = new SettingsModel($this->configuration);

        $new['passLastDB'] = $settingsMod->userData($_SESSION['usersId']);

        $data = [
            'passLast' => trim($this->request->postParam('passLast')),
            'passNew' => trim($this->request->postParam('passNew')),
            'passRepe' => trim($this->request->postParam('passRepe'))
        ];

        if (empty($data['passLast']) || empty($data['passNew']) || empty($data['passRepe'])) {
            FeedbackMess("passCh", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/settings");
        }

        if(!password_verify($data['passLast'], $new['passLastDB']['pwd'])){
            FeedbackMess("passCh", "Hasło nie jest poprawne");
            $this->redirect("/settings");
        }

        if(strlen($data['passNew']) < 6){
            FeedbackMess("passCh", "Niepoprawne hasło");
            $this->redirect("/settings");
        }else if($data['passNew'] !== $data['passRepe']){
            FeedbackMess("passCh", "Hasła nie sa takie same");
            $this->redirect("/settings");
        }

        $data['passNew'] = password_hash($data['passNew'], PASSWORD_DEFAULT);

        if($settingsMod->editUserPass($data, $_SESSION['usersId'])){
            FeedbackMess("passCh", "Udało się");
            $this->redirect("/settings");
        }else{
            FeedbackMess("passCh", "Coś poszło nie tak");
            $this->redirect("/settings");
        }

    }
}