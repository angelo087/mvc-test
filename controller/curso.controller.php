<?php
require_once 'model/curso.php';
require_once 'model/pdf.php';
require_once 'assets/fpdf/fpdf.php';
require_once 'controller/parent.controller.php';

class CursoController extends ParentController {

	public function __CONSTRUCT(){
        
        parent::__construct();

        if ($this->isLoggedIn == false) {
            header('Location: index.php');
        } else {
            $this->model = new Curso();
        }

    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/curso/curso.php';
        require_once 'view/footer.php';
    }

    public function Sincronizar() {
    	include 'view/alumno/ejemplo-xml.php';
        $cursosXML = new SimpleXMLElement($xmlstr);

        foreach ($cursosXML->curso as $cursoXML) {

        	$curso = new Curso();
        	$curso->setNombre($cursoXML->nombre);

        	$idCurso = $this->model->ObtenerPorNombre($cursoXML->nombre);

        	if(isset($idCurso) && $idCurso > 0) { // Modificamos

        		$curso->setId(intval($idCurso));
        		$this->model->Actualizar($curso);

        	} else  { // Creamos
        		$this->model->Registrar($curso);
        	}
        }

        header('Location: index.php?c=curso');
    }

    public function PDF() {

        // Cabecera
        $header = array('Id', 'Curso');

        // Datos para la tabla
        $cursos = $this->model->Listar();
        $data = array();
        foreach ($cursos as $curso) {
            $str = $curso->getId() . ';' . $curso->getNombre();
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