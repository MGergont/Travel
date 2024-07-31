<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\AbstractModel;

class StatisticModel extends AbstractModel{
    

    public function showCostVehicle(int $id){
        $this->query('SELECT * FROM costs WHERE id_users = 2 AND category = car;');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function showCostRoute(int $id){
        $this->query('SELECT * FROM vehicle WHERE id_users = :id');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function showStatRoute(int $id){
        $this->query('SELECT * FROM travel WHERE id_users = :id');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}