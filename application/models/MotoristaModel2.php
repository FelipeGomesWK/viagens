<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MotoristaModel extends CI_Model
{
    
    public function marcar($marcacao){
       return $this->db->insert('marcacoes', $marcacao);       
      
    }

    public function logar($login, $senha){
        $condicao = array('login'=> $login, 'senha' => $senha);
        $this->db->where($condicao);
        $motorista = $this->db->get('motoristas')->result();
       
        if($motorista[0]['login'] == $login){
                echo "foi!";       
         }else{
            
         }
                
        return $motorista;
    }
}

