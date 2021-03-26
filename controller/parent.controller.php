<?php
require_once 'model/utils.php';

class ParentController {

	protected $model;
	protected $isLoggedIn;
	protected $usernameSession;

	public function __CONSTRUCT(){
        $loggedinSession = isset($_SESSION["loggedin"]) && 
                                $_SESSION["loggedin"] == true ? true : false;
        $usernameSession = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
        $this->isLoggedIn = Utils::isLoggedIn($loggedinSession, $usernameSession);
        $this->usernameSession = $usernameSession;
	}

}

?>