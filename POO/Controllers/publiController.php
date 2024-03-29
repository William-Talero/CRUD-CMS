<?php

class publiController extends publi{
    //Mostrar toda la informacion
    public function __construct()
    {
        Security::verifyUser();
//        die('hola');
    }
    
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/public/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        require_once 'views/layouts/header.php';
        require_once 'views/public/create.php';
        require_once 'views/layouts/footer.php';
    }

    //'Validaciones e interaccion model
    public function store(){

        $nomimg=$_FILES['link']['name'];
        $num=date("GHs");
        $nombreimg=$num.$nomimg;
        $archivo=$_FILES['link']['tmp_name'];
        $ruta="assets";
       
        $ruta=$ruta."/".$nombreimg;       
       
        move_uploaded_file($archivo,$ruta);    

        $_POST['rutas'] =$ruta;

        $important=preg_replace('/\s+/', '', $_POST['title']); 

        $_POST['important'] =$important;


        echo parent::register($_POST) ? header('location: ?controller=publi') : 'Error en el registro';
    }

    //consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $user = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/user/edit.php';
        require_once 'views/layouts/footer.php';
    }

    //Validaciones e interaccion model
    public function update(){
        echo parent::update_register($_POST) ? header('location: ?controller=publi') : 'Error al borrar la publicacion';
    }


    //
    public function delete(){
        echo parent::delete_register($_GET) ? header('location: ?controller=publi') : 'Error al borrar la publicacion';

    }

}