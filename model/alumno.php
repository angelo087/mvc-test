<?php
class Alumno
{
	private $pdo;
    
    private $id;
    private $Nombre;
    private $Apellido;
    private $Sexo;
    private $FechaRegistro;
    private $FechaNacimiento;
    private $Foto;
    private $Correo;

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

	public function getApellido() {
		return $this->Apellido;
	}

	public function setApellido($valor) {
		$this->Apellido = $valor;
	}

	public function getSexo() {
		return $this->Sexo;
	}

	public function setSexo($valor) {
		$this->Sexo = $valor;
	}

	public function getFechaRegistro() {
		return $this->FechaRegistro;
	}

	public function setFechaRegistro($valor) {
		$this->FechaRegistro = $valor;
	}

	public function getFechaNacimiento() {
		return $this->FechaNacimiento;
	}

	public function setFechaNacimiento($valor) {
		$this->FechaNacimiento = $valor;
	}

	public function getFoto() {
		return $this->Foto;
	}

	public function setFoto($valor) {
		$this->Foto = $valor;
	}

	public function getCorreo() {
		return $this->Correo;
	}

	public function setCorreo($valor){
		$this->Correo = $valor;
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM alumnos");
			$stm->execute();

			//return $stm->fetchAll(PDO::FETCH_OBJ);
			return $stm->fetchAll(PDO::FETCH_CLASS, "Alumno");
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
			          ->prepare("SELECT * FROM alumnos WHERE id = ?");
			          

			$stm->execute(array($id));
			//return $stm->fetch(PDO::FETCH_OBJ);
			$stm->setFetchMode(PDO::FETCH_CLASS, 'Alumno');
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
			            ->prepare("DELETE FROM alumnos WHERE id = ?");			          

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
			$sql = "UPDATE alumnos SET 
						Nombre          = ?, 
						Apellido        = ?,
                        Correo        = ?,
						Sexo            = ?, 
						FechaNacimiento = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre, 
                        $data->Apellido,
                        $data->Correo,
                        $data->Sexo,
                        $data->FechaNacimiento,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Alumno $data)
	{
		try 
		{
		$sql = "INSERT INTO alumnos (Nombre,Correo,Apellido,Sexo,FechaNacimiento,FechaRegistro) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre,
                    $data->Correo, 
                    $data->Apellido, 
                    $data->Sexo,
                    $data->FechaNacimiento,
                    date('Y-m-d')
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}