<?php
require_once 'model/anime.php';
require_once 'model/pdf.php';
require_once 'controller/parent.controller.php';
require('assets/googlechart/GoogChart.class.php');

class AnimeController extends ParentController {
    
    private $chart1;
    private $chart2;

    public function __CONSTRUCT(){
    	parent::__construct();

        if ($this->isLoggedIn == false) {
            header('Location: index.php');
        } else {
            $this->model = new Anime();
	        $this->chart1 = new GoogChart();
    	    $this->chart2 = new GoogChart();
        }
    }
    
    public function Index(){

    	require_once 'view/header.php';
        require_once 'view/anime/anime.php';
        require_once 'view/footer.php';

    	// Contamos numero de animes y mangas
    	/*$categoriasMap = $this->model->ObtenerTotalCategorias();

    	// Creamos grafico de google
		$this->chart1 = new GoogChart();
		$data = array();
		foreach ($categoriasMap as $categoria) {
			$data[$categoria->type] = $categoria->total;
		}
		$color = array(
			'#99C754',
			'#54C7C5',
			'#999999',
		);
		$this->chart1->setChartAttrs( array(
			'type' => 'pie',
			'title' => 'Total por categorias',
			'data' => $data,
			'size' => array( 400, 300 ),
			'color' => $color
		));*/

		// Mostramos las vistas
    }

    public function Sincronizar() {
    	//$url = "https://www.animenewsnetwork.com/encyclopedia/reports.xml?id=155";
		$url = "https://www.animenewsnetwork.com/encyclopedia/reports.xml?id=155&nskip=0&nlist=20";
		$animeXML = new SimpleXMLElement(file_get_contents($url));

		foreach ($animeXML->{'item'} as $itemXML) {
			$anime = new Anime();
			$anime->setIdAnime($itemXML->id);
			$anime->setGuid($itemXML->gid);
			$anime->setType($itemXML->type == 'manga' ? 'manga' : 'anime');
			$anime->setName($itemXML->name);

			// Obtenemos imagenes
			$urlImages =  "https://cdn.animenewsnetwork.com/encyclopedia/api.xml?".$anime->getType()."=".$anime->getIdAnime();
			$imagesXML = new SimpleXMLElement(file_get_contents($urlImages));

			foreach ($imagesXML->{$anime->getType()}[0]->{'info'} as $info) {
				if (((string)$info['type']) == 'Picture') {
					$anime->setPicture($info['src']);
				}
				if (((string)$info['type']) == 'Official website') {
					$anime->setWebsite($info['href']);
				}
			}
			if ($anime->getPicture() == null || empty($anime->getPicture())) {
				$anime->setPicture('http://www.wellesleysocietyofartists.org/wp-content/uploads/2015/11/image-not-found.jpg');
			}
			if ($anime->getWebsite() == null || empty($anime->getWebsite())) {
				$anime->setWebsite('#');
			}

			$animeBBDD = $this->model->ObtenerPorNombre($anime->getName());

			if($animeBBDD != null && $animeBBDD->getId() && $animeBBDD->getId() > 0) { // Modificamos
				$anime->setId($animeBBDD->getId());
				$this->model->Actualizar($anime);
			} else { // Creamos
				$this->model->Registrar($anime);
			}

		}

		header('Location: index.php?c=anime');
    }

}