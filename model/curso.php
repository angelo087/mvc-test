<?php
class Curso
{
	private $pdo;
    
    private $id;
    private $Nombre;

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
		$this->id = $id;
	}

	public function getNombre() {
		return $this->Nombre;
	}

	public function setNombre($valor) {
		$this->Nombre = $valor;
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM cursos");
			$stm->execute();

			//return $stm->fetchAll(PDO::FETCH_OBJ);
			return $stm->fetchAll(PDO::FETCH_CLASS, "Curso");
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
			          ->prepare("SELECT * FROM cursos WHERE id = ?");
			          

			$stm->execute(array($id));
			//return $stm->fetch(PDO::FETCH_OBJ);
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Curso');
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
			          ->prepare("SELECT id FROM cursos WHERE Nombre = ?");
			          

			$stm->execute(array($nombre));
			//return $stm->fetch(PDO::FETCH_OBJ);
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Curso');
			return $stm->fetch();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM cursos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE cursos SET 
						Nombre          = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Curso $data)
	{
		try 
		{
		$sql = "INSERT INTO cursos (Nombre) 
		        VALUES (?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}