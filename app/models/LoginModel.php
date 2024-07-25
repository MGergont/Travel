<?php

declare(strict_types=1);

namespace App\Models;

class LoginModel extends AbstractModel{

    public function login(string $nameOrEmail,string $password){
       
        $row = $this->findUserByEmail($nameOrEmail);

        if($row == false) return false;

        $hashedPassword = $row->pwd;
    
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function updateLastLogin(int $userId){
        $this->query('UPDATE users SET last_login = NOW() WHERE id_users = :userId;');
        
        $this->bind(':userId', $userId);

        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateStatus(int $userId){
        $this->query('UPDATE users SET user_status = "aktywne" WHERE users.id_users = :userId;');
        
        $this->bind(':userId', $userId);

        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }


}