<?php
class Anime
{
	private $pdo;

	private $id;
	private $idAnime;
	private $guid;
	private $type;
	private $name;
	private $picture;
	private $website;

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

	public function setId($value) {
		$this->id = $value;
	}

	public function getIdAnime() {
		return $this->idAnime;
	}

	public function setIdAnime($value) {
		$this->idAnime = $value;
	}

	public function getGuid() {
		return $this->guid;
	}

	public function setGuid($value) {
		$this->guid = $value;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($value) {
		$this->type = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function getPicture() {
		return $this->picture;
	}

	public function setPicture($value) {
		$this->picture = $value;
	}

	public function getWebsite() {
		return $this->website;
	}

	public function setWebsite($value) {
		$this->website = $value;
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM anime");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_CLASS, "Anime");
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM anime WHERE id = ?");
			          

			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Anime');
			return $stm->fetch();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Anime $data)
	{
		try 
		{
		$sql = "INSERT INTO anime (idAnime,guid,type,name,picture,website) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->idAnime,
                    $data->guid, 
                    $data->type, 
                    $data->name,
                    $data->picture,
                    $data->website
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE anime SET 
						idAnime 	= ?,
						guid          = ?, 
						type        = ?,
                        name        = ?,
                        picture = ?, 
                        website = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->idAnime,
                        $data->guid, 
                        $data->type,
                        $data->name,
                        $data->picture,
                        $data->website,
                        $data->id
					)
				);
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
			          ->prepare("SELECT * FROM anime WHERE name = ?");
			          

			$stm->execute(array($nombre));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Anime');
			return $stm->fetch();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTotalCategorias() {
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT type, count(*) as total FROM anime GROUP BY type");
			          
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}	
	}
}

?>