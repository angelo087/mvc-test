<?php

class Utils {
	
	public static $VALOR_SI = 'y';

	public static function isLoggedIn($logIn, $username) {
    	return $logIn == true && !empty($username);
	}

}

?>