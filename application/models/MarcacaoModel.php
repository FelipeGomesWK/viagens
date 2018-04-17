<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarcacaoModel  extends CI_Model {

	private $marcacao_id;
	private $fk_tipo_marcacao_id;
	private $fk_trajeto_id;
	private $lat_long;
	
	public function getMarcacaoId() {

		return $this->marcacao_id;
	}

	public function getTipoMarcacaoId() {

		return $this->fk_tipo_marcacao_id;
	}

	public function getTrajetoId() {

		return $this->fk_trajeto_id;
	}

	public function getLatLong() {

		return $this->lat_long;
	}
	
	public function setMarcacaoId($marcacaoId) {

		$this->marcacao_id = $marcacaoId;
	}

	public function setTipoMarcacaoId($tipoMarcacaoId) {

		$this->fk_tipo_marcacao_id = $tipoMarcacaoId;
	}

	public function setTrajetoId($trajetoId) {

		$this->fk_trajeto_id = $trajetoId;
	}

	public function setLatLong($latLong) {

		$this->lat_long = "POINT(".$latLong.")";
	}
	
}

