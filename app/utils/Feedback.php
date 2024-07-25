<?php

if(!isset($_SESSION)){
    session_start();
}

function FeedbackMess(string $name = '', string $message = '') :void{
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            $_SESSION[$name] = $message;
        }else if(empty($message) && !empty($_SESSION[$name])){
            echo '<div>'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name]);
        }
    }
}
