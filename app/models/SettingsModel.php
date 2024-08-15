<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\AbstractModel;

class SettingsModel extends AbstractModel{
    
    public function userData(int $id){
        $this->query('SELECT * FROM users WHERE id_users = :id;');
        $this->bind(':id', $id);

        $row = $this->singleArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
    
    public function editUserData($data, $id){
        $this->query('UPDATE users SET user_name = :firstName, user_last_name = :lastName, phone_number = :phone WHERE users.id_users = :id');
    
        $this->bind(':firstName', $data['firstName']);
        $this->bind(':lastName', $data['lastName']);
        $this->bind(':phone', $data['phone']);
        $this->bind(':id', $id);
    
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function editUserPass($data, $id){
        $this->query('UPDATE users SET pwd = :pwd WHERE users.id_users = :id');
        $this->bind(':pwd', $data['passNew']);
        $this->bind(':id', $id);
    
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }
}