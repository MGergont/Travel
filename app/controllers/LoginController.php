<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\LoginModel;
use App\Controllers\AbstractController;

class LoginController extends AbstractController{

    public function loginView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $this->redirect("/home");
        }else{
            (new View())->render("login");
        }
    }

    public function login() : Void{
        $loginMod = new LoginModel($this->configuration);

        $data = [
            'email' => trim($this->request->postParam('email')),
            'pwd' => trim($this->request->postParam('pwd'))
        ];
        

        if(empty($data['email']) || empty($data['pwd'])){
            FeedbackMess("login", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/");
        }

        if ($loginMod->findUserByEmail($data['email'], $data['pwd'])) {
            $loggedInUser = $loginMod->login($data['email'], $data['pwd']);
            if ($loggedInUser) {
                $loginMod->updateLastLogin($loggedInUser->id_users);
                $this->createUserSession($loggedInUser);
            } else {
                FeedbackMess("login", "Niepoprawne dane logowania");
                $this->redirect("/");
            }
            
        } else {
            FeedbackMess("login", "Niepoprawne dane logowania");
            $this->redirect("/");
        }
    }

    private function createUserSession($user){
        $_SESSION['status'] = "login";
        $_SESSION['usersId'] = $user->id_users;
        $_SESSION['usersName'] = $user->user_name;
        $_SESSION['usersEmail'] = $user->email;
        $this->redirect("/home");
    }

    public function logout(){
        unset($_SESSION['status']);
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_unset();
        session_destroy();
        $this->redirect("/");
    }    
}