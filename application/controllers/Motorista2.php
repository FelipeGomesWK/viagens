<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista extends CI_Controller
{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('MotoristaModel', 'motorista');
        $this->load->helper('form');
        //$this->output->set_header('Access-Control-Allow-Origin: *');  
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
    }
    
    
    public function index(){
        echo "Funciona Mesmo";
    }
    
    public function teste(){
        echo "funciona tambem";
    }
    
    
    public function login() {
       
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');
        
        $resposta = $this->motorista->logar( $login,$senha);
       
        echo json_encode($resposta);
        
    }
    
    public function logout() {
       $this->motorista->logout();
    }
    
    public function marcar() {
        
        $this->load->model('MarcacaoModel', 'marcacao');
            $this->marcacao->setTrajetoId("1");
            $this->marcacao->setTipoMarcacao("1");
            $this->marcacao->setLatLong('-23.506405229783162, 1-46.47776850344428');            
            $resposta = $this->motorista->marcar($this->marcacao);            
            echo json_encode($resposta);
    }
    
    public function listarTrajetos() {
        $array = $this->uri->uri_to_assoc();
        $id = $array['id']; //$this->uri->segment(4);
        $lista = $this->motorista->listarTrajetos($id);        
        echo json_encode($lista);
    }
    
    
    
}

