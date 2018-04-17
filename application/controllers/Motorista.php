<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista extends CI_Controller {
    
    public function __construct() {
        parent::__construct();       
        $this->load->helper('form');
        $this->load->model('MotoristaModel', 'motorista');
    }
    
    public function index(){
    	echo "funcionou";
    }
    
    public function logar(){
    	$login = $this->input->post('login');
    	$senha = $this->input->post('senha');
    	//$usuario = $this->uri->uri_to_assoc();    	
    	$motorista = $this->motorista->logar($login, $senha);    	
    	if ($this->session->has_userdata('motorista_id')){
    		echo json_encode($motorista);
    	}else{
    		echo json_encode(array("status" => "false"));
    	}
    }
    
    public function deslogar(){
    	echo json_encode($this->motorista->logout());
    }
	
	public function iniciarTrajeto(){		
		$nomeTrajeto = $this->input->post('nome_trajeto');		
		$trajeto = $this->uri->uri_to_assoc(); 
		$this->motorista->iniciarTrajeto($nomeTrajeto);
		if ($this->session->has_userdata('trajeto_atual_id')){					
			$result = $this->marcar(1);
			echo json_encode($result);
		}else{
			echo json_encode(
				array(
					"status" => "false"						
				)
			);
		}
	}
	
	public function finalizarTrajeto() {
		$result = $this->marcar(2);
		if ($resut){
			if($this->motorista->finalizarTrajeto()){
				echo json_encode(true);
				return true;
			}
			echo json_encode(false);
			return false;
		}
		echo json_encode(false);
		return false;
	}
	
	public function inicioPausa(){
		$result = $this->marcar(3);
		echo json_encode($result);
	}
	
	public function fimPausa() {
		$result = $this->marcar(4);
		echo json_encode($result);
	}
	
	public function listarTrajetos() {
		echo json_encode($this->motorista->listarTrajetos());		
	}
	
	private function marcar($tipoMarcacaoId){
		$this->load->model('MarcacaoModel');
		$marcacao = new MarcacaoModel();
		$marcacao->setTrajetoId($this->session->userdata('trajeto_atual_id'));
		$marcacao->setTipoMarcacaoId($tipoMarcacaoId);
		$marcacao->setLatLong($this->input->post('lat_long'));
		return $this->motorista->marcar($marcacao);		
	}
		
}
