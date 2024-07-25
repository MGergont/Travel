<?php

declare(strict_types=1);

namespace App\Models;

class RegistrationModel extends AbstractModel{

    public function register($data){

        $this->query('INSERT INTO users (id_users, user_name, phone_number, email, pwd, last_login, user_status) VALUES (NULL, :name, :phone, :email, :password, NULL, "nowe");');
        $this->bind(':name', $data['usersName']);
        $this->bind(':email', $data['usersEmail']);
        $this->bind(':phone', $data['phone']);
        $this->bind(':password', $data['usersPwd']);
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }
}