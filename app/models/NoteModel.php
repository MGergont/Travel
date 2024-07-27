<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\AbstractModel;

class NoteModel extends AbstractModel{
    
    public function AddNote(array $data, int $id){

        $this->query('INSERT INTO notes VALUES (NULL, :title, :content, NOW(), NOW(), :id);');
        
        $this->bind(':title', $data['title']);
        $this->bind(':content', $data['content']);
        $this->bind(':id', $id);
        
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function showNote(int $id){
        $this->query('SELECT * FROM notes WHERE id_users = :id');
        $this->bind(':id', $id);

        $row = $this->allArray();
    
        if($this->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }


    public function editNote($data, $id){
        $this->query('UPDATE notes SET title = :title, content = :content, `updated_at` = NOW() WHERE id = :idnote AND id_users = :id');
    
        $this->bind(':title', $data['title']);
        $this->bind(':content', $data['content']);
        $this->bind(':idnote', $data['id']);
        $this->bind(':id', $id);
    
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delNote($data, $id){
        $this->query('DELETE FROM notes WHERE id = :idnote AND id_users = :id');
        $this->bind(':idnote', $data['dellId']);
        $this->bind(':id', $id);
        if($this->execute()){
            return true;
        }else{
            return false;
        }
    }
}