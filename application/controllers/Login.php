<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('usuario_model','usuario');
	}

	public function index(){

		if($this->session->userdata('user_login'))
			redirect('sistema/menu');

		$this->form_validation->set_rules('LOGIN','LOGIN', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('SENHA','SENHA', 'trim|required|min_length[6]');

		$dados_form = $this->input->post();

		if($this->form_validation->run() == false){
			if( validation_errors() ){
				set_msg( validation_errors() );
			}

		}else{
			$qrUsuario = $this->usuario->getUsuarioLogin($dados_form['LOGIN']);

			if($qrUsuario != null){
				//usuário existe, então verifica senha
				if( password_verify($dados_form['SENHA'], $qrUsuario->senha)){
					//senha confere com a do banco de dados, verificar se não está bloqueado
					if( !$qrUsuario->bloqueado ){
						//usuario liberado
						$this->session->set_userdata('user_logged',true);
						$this->session->set_userdata('user_nome',$qrUsuario->nome);
						$this->session->set_userdata('user_login',$qrUsuario->login);
						$this->session->set_userdata('user_categoria_id',$qrUsuario->categoria_id);
						$this->session->set_userdata('user_email',$qrUsuario->email);
						
						//redirecionar para o menu
						redirect('sistema/menu');
					}else{
						//usuário bloqueado
						set_msg('Usuário bloqueado.');
					}

				}else{
					//senha inválida
					set_msg('Senha inválida.');
				}
			}else{
				//usuário não existe
				set_msg('Usuário inválido.');
			}

		}

		$dados['titulo'] = 'Login';
		$dados_pagina['LOGIN'] = $dados_form['LOGIN'];
		$dados_pagina['SENHA'] = $dados_form['SENHA'];

		$this->load->view('header',$dados);
		$this->load->view('login', $dados_pagina);
		$this->load->view('footer');
		
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect('');
	}
}
