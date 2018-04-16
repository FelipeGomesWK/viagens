<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MotoristaModel {
	
	public function logar($login, $senha){
		$this->db->where(array("login" => $login, "senha" => $senha));
		$result = $this->db->get("motoristas")->result();
		if ($result['motorista_id']) {
			$this->session->set('motorista_id', $result['motorista_id']);			
		}
	}
	
	public function logout(){
		$this->session->destroy();
		return true;
	}
	
	public function iniciarTrajeto($nomeTrajeto){
		$this->db->set('fk_motorista_id', $this->session->get('motorista_id'));
		$this->db->set('nome_trajeto', $nomeTrajeto);
		$result = $this->db->insert('trajetos');
		$id = $this->db->insert_id();
		$this->session->set('trajeto_atual_id', $id);
	}
	
	public function marcar($marca) {
		$this->db->set('fk_trajeto_id', $marca->getTrajetoId());
		$this->db->set('fk_tipo_marcacao_id', $marca->getTipoMarcacaoId());
		$this->db->set('lat_long',$marca->getLatLong(), false);
		return $this->db->insert('marcacao');
	}
	
	public function finalizarTrajeto(){
		$this->session->set('trajeto_atual_id', "");
	}


}

