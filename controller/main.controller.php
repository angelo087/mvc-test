<?php
require_once 'model/usuario.php';
require_once 'model/utils.php';
require_once 'controller/parent.controller.php';

class MainController extends ParentController {

    private $loginError;
    private $registerError;

    public function __CONSTRUCT(){
        parent::__construct();
    	$this->model = new Usuario();
        $this->loginError = "";
        $this->registerError = "";
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/main/main.php';
        require_once 'view/footer.php';
    }

    public function Register() {

        if ($this->isLoggedIn == true) {
            header('Location: index.php');
        }
        
        require_once 'view/header.php';
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

        if(empty($username) || empty($password)) {
            include 'view/main/register.php';
        } else {
            $usuario = $this->model->ObtenerPorNombre($username);

            if ($usuario) { // Usuario ya existe
                $this->registerError = "Ya existe un usuario con ese nombre";
                include 'view/main/register.php';
            } else { // Usuario no existe

                $usuario = new Usuario();
                $usuario->setNombre($username);
                $usuario->setPassword($password);

                $this->model->Registrar($usuario); // Guardamos el usuario

                // Realizamos el login
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $usuario->getNombre();
                header('Location: index.php');
            }
        }

        require_once 'view/footer.php';   
    }

    public function Login() {

        if ($this->isLoggedIn == true) {
            header('Location: index.php');
        }
        
        require_once 'view/header.php';
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

        if(empty($username) || empty($password)) {
            include 'view/main/login.php';
        } else {
            $usuario = $this->model->getLogin($username, $password);
            if (isset($usuario)) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $usuario->getNombre();
                header('Location: index.php');
            } else {
                $this->loginError = "Usuario o password no correctos";
                include 'view/main/login.php';
            }
        }
        require_once 'view/footer.php';
    }

    public function Logout() {
        session_destroy();
        header('Location: index.php');
    }
}