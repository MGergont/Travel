<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;
use App\Models\NoteModel;
use App\Controllers\AbstractController;

class NoteController extends AbstractController{

    public function noteView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $noteModel = new NoteModel($this->configuration);

            $this->paramsView['note'] = $noteModel->showNote($_SESSION['usersId']);

            (new View())->render("note", $this->paramsView);
        }else{
            $this->redirect("/403");
        }
    }

    public function addNote() : Void{

        $noteMod = new NoteModel($this->configuration);

        $data = [
            'title' => trim($this->request->postParam('Title')),
            'content' => trim($this->request->postParam('Content'))
        ];
        
        if(empty($data['title']) || empty($data['content'])){
            FeedbackMess("note", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/notes");
        }

        if($noteMod->AddNote($data, $_SESSION['usersId'])){
            FeedbackMess("note", "Udało się ");
            $this->redirect("/notes");
        }else{
            FeedbackMess("note", "Coś poszło nie tak");
            $this->redirect("/notes");
        }

    }

    public function editNote() : Void{

        $noteMod = new NoteModel($this->configuration);

        $data = [
            'title' => trim($this->request->postParam('title')),
            'content' => trim($this->request->postParam('content')),
            'id' => $this->request->postParam('id')
        ];
        
        if(empty($data['title']) || empty($data['content'])){
            FeedbackMess("note", "Nie uzupełniono wymaganych formularzy");
            $this->redirect("/notes");
        }

        if($noteMod->editNote($data, $_SESSION['usersId'])){
            FeedbackMess("note", "Udało się ");
            $this->redirect("/notes");
        }else{
            FeedbackMess("note", "Coś poszło nie tak");
            $this->redirect("/notes");
        }

    }

    public function dellNote() : Void{
        $noteMod = new NoteModel($this->configuration);

        $data = [
            'dellId' => $this->request->postParam('id')
        ];

        if (empty($data['dellId'])) {
            FeedbackMess("note", "Wymagany fomularz nie jest uzupełniony");
            $this->redirect("/notes");
        }

        if($noteMod->delNote($data, $_SESSION['usersId'])){
            FeedbackMess("note", "Udało się ");
            $this->redirect("/notes");
        }else{
            FeedbackMess("note", "Udało się ");
            $this->redirect("/notes");
        }

    }


}