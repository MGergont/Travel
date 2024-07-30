<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\AbstractModel;

class RouteModel extends AbstractModel{

    public function getIdDel(int $id){
        $this->query('SELECT MAX(id_delegation) AS id_del FROM travel WHERE id_user_fk = :id;');
        $this->bind(':id', $id);

        $row = $this->singleArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }


    public function addTrip(array $data, int $id){

        $this->query('INSERT INTO travel VALUES (NULL, :StartRoute, :StopRoute, :id_del, :startTrip, :stopTrip, :Distance, :id);');
        
        $this->bind(':id_del', $data['id_del']);
        $this->bind(':StartRoute', $data['StartRoute']);
        $this->bind(':Distance', $data['Distance']);
        $this->bind(':StopRoute', $data['StopRoute']);
        $this->bind(':StopRoute', $data['StopRoute']);
        $this->bind(':startTrip', $data['startTrip']);
        $this->bind(':stopTrip', $data['stopTrip']);
        $this->bind(':id', $id);
        
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function getLocation(int $id){
        $this->query('SELECT DISTINCT location_1 FROM travel WHERE id_user_fk = :id;');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}