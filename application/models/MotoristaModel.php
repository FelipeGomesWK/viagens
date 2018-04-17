<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MotoristaModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function logar($login, $senha){
		$this->db->where(array("login" => $login, "senha" => $senha));
		$motorista = $this->db->get("motoristas")->result();
		if (isset($motorista['motorista_id']) && $motorista['login'] == $login) {			
			$this->session->set_userdata('motorista_id',$this->motorista['motorista_id']);
			return $this->motorista;
		}
		return false;
	}
	
	public function logout(){
		$this->session->unset_userdata('motorista_id');
		if ($this->session->has_userdata('motorista_id')){
			return false;
		}
		return true;
	}
	
	public function iniciarTrajeto($nomeTrajeto){
		if ($this->session->has_userdata('motorista_id')){
			$this->db->set('fk_motorista_id', $this->session->userdata('motorista_id'));
			$this->db->set('nome_trajeto', $nomeTrajeto);
			$result = $this->db->insert('trajetos');
			if ($result){
				$this->session->set_userdata('trajeto_atual_id',$this->db->insert_id());
				return true;
			}
		}
		return false;		
	}
	
	public function marcar($marcacao) {
		if ($this->session->has_userdata('motorista_id')  && $this->session->has_userdata('trajeto_atual_id')){
			$this->db->set('fk_trajeto_id', $marcacao->getTrajetoId());
			$this->db->set('fk_tipo_marcacao_id', $marcacao->getTipoMarcacaoId());
			$this->db->set('lat_long',$marcacao->getLatLong(), false);
			return $this->db->insert('marcacoes');
		}
		return false;
	}
	
	public function finalizarTrajeto(){
		$this->session->unset_userdata('trajeto_atual_id');
		if ($this->session->has_userdata('trajeto_atual_id')){
			return false;
		}
		return true;
	}
	
	public function listarTrajetos(){
		$this->db->select("mt.*, t.*, mr.*");
		$this->db->from("motoristas mt");
		$this->db->join("trajetos t", "m.motorista_id = t.fk_motorista_id", "left");
		$this->db->join("marcacoes mr", "t.trajeto_id = mr.fk_trajeto_id", "left");
		$this->db->where("motorista_id", $this->session->userdata('motorista_id'));
		return $this->db->get()->result();		
	}
}

