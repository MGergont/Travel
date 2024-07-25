<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\RegistrationModel;
use App\Controllers\AbstractController;

class RegistrationController extends AbstractController{

    public function registrationView() : Void{
            (new View())->render("register");
    }

    public function registration() : Void{

        $registration = new RegistrationModel($this->configuration);

        $data = [
            'usersName' => trim($this->request->postParam('usersName')),
            'usersEmail' => trim($this->request->postParam('usersEmail')),
            'phone' => trim($this->request->postParam('phone')),
            'usersPwd' => trim($this->request->postParam('usersPwd')),
            'pwdRepeat' => trim($this->request->postParam('pwdRepeat'))
        ];
        
        if (empty($data['usersEmail']) || empty($data['usersName']) || empty($data['usersName']) || empty($data['usersPwd']) || empty($data['pwdRepeat'])) {
            FeedbackMess("register", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/register");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['usersName'])){
            FeedbackMess("register", "Niedozwolone znaki w nazwie użytkownika");
            $this->redirect("/register");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            FeedbackMess("register", "Niepoprawny email");
            $this->redirect("/register");
        }

        if(!strlen($data['phone']) == 9){
            FeedbackMess("register", "Niepoprawny numer telefonu");
            $this->redirect("/register");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['phone'])){
            FeedbackMess("register", "Niepoprawny numer telefonu2");
            $this->redirect("/register");
        }

        if(strlen($data['usersPwd']) < 6){
            FeedbackMess("register", "Niepoprawne hasło");
            $this->redirect("/register");
        }else if($data['usersPwd'] !== $data['pwdRepeat']){
            FeedbackMess("register", "Hasła nie sa takie same");
            $this->redirect("/register");
        }

        if($registration->findUserByEmail($data['usersEmail'])){
            FeedbackMess("register", "Adres email jest już zajęty");
            $this->redirect("/register");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        if($registration->register($data)){
            FeedbackMess("register", "Udało się");
            $this->redirect("/register");
        }else{
            $this->redirect("/404");
        }

    }

}