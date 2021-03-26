<?php
require_once 'model/usuario.php';
require_once 'controller/parent.controller.php';

class UsuarioController extends ParentController {

    public function __CONSTRUCT(){
        parent::__construct();

        if ($this->isLoggedIn == false) {
            header('Location: index.php');
        } else {
            $this->model = new Usuario();
        }
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $usu = new Usuario();
        
        if(isset($_REQUEST['id'])){
            $usu = $this->model->ObtenerPorId($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $usu = new Usuario();
        
        $usu->setId($_REQUEST['id']);
        $usu->setNombre($_REQUEST['Nombre']);
        $usu->setPassword($_REQUEST['Password']);

        $usu->getId() > 0 
            ? $this->model->Actualizar($usu)
            : $this->model->Registrar($usu);
        
        header('Location: index.php?c=Usuario');
    }

}