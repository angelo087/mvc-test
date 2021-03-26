<?php
class Usuario
{
	const HASH = PASSWORD_DEFAULT;
	const COST = 14;

	private $pdo;
    private $id;
    private $Nombre;
    private $Password;

    public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setId($valor) {
		$this->id = $valor;
	}

	public function getNombre() {
		return $this->Nombre;
	}

	public function setNombre($valor) {
		$this->Nombre = $valor;
	}

	public function getPassword() {
		return $this->Password;
	}

	public function setPassword($valor){
		$this->Password = password_hash($valor, self::HASH, ['cost' => self::COST]);
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuario");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_CLASS, "Usuario");
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPorId($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuario WHERE id = ?");
			          

			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
			return $stm->fetch();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPorNombre($nombre)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuario WHERE Nombre = ?");
			          
			$stm->execute(array($nombre));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
			return $stm->fetch();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		$sql = "INSERT INTO usuario (Nombre, Password) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre,
                    $data->Password
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function getLogin($username, $password) {
        if (isset($username) && isset($password)) {

        	$userBBDD = $this->ObtenerPorNombre($username);

        	if ( isset($userBBDD) && isset($userBBDD->id) ) { // Usuario existe
        		// Comprobamos password
        		if (password_verify($password, $userBBDD->getPassword())) {
        			return $userBBDD;
        		}
        	}
        } 
        return null;
    }
}
?>
