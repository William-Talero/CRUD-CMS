<?php

class securityController extends Security {

    public function login(){
        $user = parent::validateLogin($_POST['email']);

        if(!is_object($user)) die('Ingreso incorrecto.');

       if(password_verify($_POST['password'], $user->password)){
        
           $_SESSION['user'] = $user;

           if($_SESSION['user']->id_rol == 1){
               return header('Location:?controller=publi');
           }else if($_SESSION['user']->id_rol == 2) {
               return header('location:?controller=publi');
           }
       }
       return header ('location:?controller=index');
    }
    

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location:?controller=index');
    }

}