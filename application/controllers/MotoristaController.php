<?php
use application\models\MarcaModel;

defined('BASEPATH') OR exit('No direct script access allowed');

class MotoristaController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();       
        $this->load->helper('form');
        $this->load->model('MotoristaModel', 'motorista');
    }
    
    public function logar(){
    	$login = $this->input->post('login');
    	$senha = $this->input->post('senha');
    	$motorista = $this->motorista->logar($login, $senha);    	
    	if (isset($motorista['motorista_id'])){
    		echo json_encode($motorista);
    	}else{
    		echo json_encode(
    			array(
    				"status" => "erro"
    			)
    		);
    	}
    }
	
	public function iniciarTrajeto(){		
		$nomeTrajeto = $this->input->post('nome_trajeto');		
		$this->motorista->iniciarTrajeto($nomeTrajeto);
		if ($id){					
			$result = $this->marcar(1);
			echo json_encode($result);
		}else{
			echo json_encode(
				array(
					"status" => "erro"						
				)
			);
		}
	}
	
	public function finalizarTrajeto() {
		$result = $this->marcar(2);
		$this->motorista->finalizarTrajeto();
		echo json_encode($result);
	}
	
	public function inicioPausa(){
		$result = $this->marcar(3);
		echo json_encode($result);
	}
	
	public function fimPausa() {
		$result = $this->marcar(4);
		echo json_encode($result);
	}
	
	private function marcar($tipoMarcacaoId){
		$marca = new MarcaModel();
		$marca->setTrajetoId($this->session->get('trajeto_atual_id'));
		$marca->setTipoMarcacaoId($tipoMarcacaoId);
		$marca->setLatLong($this->input->post('lat_long'));
		$this->motorista->marcar($marca);
		
	}
		
}
