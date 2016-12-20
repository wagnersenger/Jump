<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {
	
	function __construct(){
		parent::__construct();

		if( !$this->session->userdata('user_logged') )
			redirect('');

		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('sistema_model','sistema');

		ini_set('error_reporting',E_ALL);
	}

	public function index(){

	}

	public function cadastrar(){
		$dados['titulo'] = 'Produto';
		$this->load->view('header',$dados);

		$qrUnMed = $this->sistema->getUnidadesMedida();

		$dados_query['qrUnMed'] = $qrUnMed;

		$this->load->view('produto/cadastrar',$dados_query);
	}

	


}
