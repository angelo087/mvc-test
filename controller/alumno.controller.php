<?php
require_once 'model/alumno.php';
require_once 'model/pdf.php';
require_once 'controller/parent.controller.php';

class AlumnoController extends ParentController {
    
    private $cursosXML;
    
    public function __CONSTRUCT(){
        parent::__construct();

        if ($this->isLoggedIn == false) {
            header('Location: index.php');
        } else {
            $this->model = new Alumno();
        }
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/alumno/alumno.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Alumno();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/alumno/alumno-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Alumno();
        
        $alm->setId($_REQUEST['id']);
        $alm->setNombre($_REQUEST['Nombre']);
        $alm->setApellido($_REQUEST['Apellido']);
        $alm->setCorreo($_REQUEST['Correo']);
        $alm->setSexo($_REQUEST['Sexo']);
        $alm->setFechaNacimiento($_REQUEST['FechaNacimiento']);

        $alm->getId() > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function Xml(){

        include 'view/alumno/ejemplo-xml.php';
        $this->cursosXML = new SimpleXMLElement($xmlstr);

        require_once 'view/header.php';
        require_once 'view/alumno/alumno-xml.php';
        require_once 'view/footer.php';
    }

    public function PDF() {

        // Cabecera
        $header = array('Id', 'Nombre');

        // Datos para la tabla
        $alumnos = $this->model->Listar();
        $data = array();
        foreach ($alumnos as $alumno) {
            $str = $alumno->getId() . ';' . $alumno->getNombre();
            $data[] = explode(';',trim($str));
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->SetFont('Times','',12);
        $pdf->AddPage();
        $pdf->BasicTable($header,$data);
        $pdf->AddPage();
        $pdf->ImprovedTable($header,$data);
        $pdf->AddPage();
        $pdf->FancyTable($header,$data);
        $pdf->Output();
    }
}