<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\AbstractModel;

class VehicleModel extends AbstractModel{
    
    public function addVehicle(array $data, int $id){

        $this->query('INSERT INTO vehicle VALUES (NULL, :id, :mark, :model, :year, :engine, :course, :picture, NULL);');
        
        $this->bind(':mark', $data['mark']);
        $this->bind(':model', $data['model']);
        $this->bind(':year', $data['year']);
        $this->bind(':engine', $data['engine']);
        $this->bind(':course', $data['course']);
        $this->bind(':picture', $data['picture']);
        $this->bind(':id', $id);
        
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addCost(array $data, int $id){

        $this->query('INSERT INTO costs VALUES (NULL, NOW(), :amount, :description, "car", :Idvehicle, :id);');
        
        $this->bind(':amount', $data['amount']);
        $this->bind(':description', $data['description']);
        $this->bind(':Idvehicle', $data['id']);
        $this->bind(':id', $id);
        
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function showVehicle(int $id){
        $this->query('SELECT * FROM vehicle WHERE id_users = :id');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function editVehicle($data, $id){
        $this->query('UPDATE vehicle SET make = :mark, model = :model, year = :year, engine_car = :engine, course = :course, path_photo = :picture WHERE id_vehicle = :Idvehicle AND id_users = :id');
    
        $this->bind(':mark', $data['mark']);
        $this->bind(':model', $data['model']);
        $this->bind(':year', $data['year']);
        $this->bind(':engine', $data['engine']);
        $this->bind(':course', $data['course']);
        $this->bind(':picture', $data['picture']);
        $this->bind(':Idvehicle', $data['id']);
        $this->bind(':id', $id);
    
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delVehicle($data, $id){
        $this->query('DELETE FROM vehicle WHERE id_vehicle = :Idvehicle AND id_users = :id');
        $this->bind(':Idvehicle', $data['id']);
        $this->bind(':id', $id);
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function serviceVehicle($data, $id){
        $this->query('UPDATE vehicle SET last_service = NOW() WHERE id_vehicle = :Idvehicle AND id_users = :id');
        $this->bind(':Idvehicle', $data['id']);
        $this->bind(':id', $id);
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }
}