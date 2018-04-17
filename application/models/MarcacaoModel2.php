<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarcacaoModel
{
    var $marcacao_id;
    var $fk_trajeto_id;
    var $lat_long;
    var $fk_tipo_marcacao_id;
    /**
     * @return mixed
     */
        
    public function getMarcacaoId()
    {
        return $this->marcacao_id;
    }
    
    /**
     * @return mixed
     */
    public function getTrajetoId()
    {
        return $this->fk_trajeto_id;
    }
    
    /**
     * @return mixed
     */
    public function getLatLong()
    {
        return $this->lat_long;
    }
    
    /**
     * @return mixed
     */
    public function getTipoMarcacao()
    {
        return $this->fk_tipo_marcacao;
    }
    
    /**
     * @param mixed $marcacao_id
     */
    public function setMarcacaoId($marcacaoId)
    {
        $this->marcacao_id = $marcacaoId;
    }
    
    /**
     * @param mixed $fk_trajeto_id
     */
    public function setTrajetoId($trajetoId)
    {
        $this->fk_trajeto_id = $trajetoId;
    }
    
    /**
     * @param mixed $lat_long
     */
    public function setLatLong($latLong)
    {
        $this->lat_long = $latLong;
    }
    
    /**
     * @param mixed $fk_tipo_marcacao
     */
    public function setTipoMarcacao($tipoMarcacao)
    {
        $this->fk_tipo_marcacao = $tipoMarcacao;
    }
    
    
    
    
}

