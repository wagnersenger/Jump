<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orcamento extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('usuario_model','usuario');
	}

	public function index(){
		redirect('login');
	}

	public function cadastrarSolicitacao($id = null){
		$dados['titulo'] = 'Orçamentos';
		$this->load->view('header',$dados);


		$this->load->view('orcamento/cadastrarSolicitacao');
	}

	public function cadastro($id=null){
		//verifica se esta entrando em modo de edição
		if($id != null){
			$qrUsuario = $this->usuario->getUsuario($id);
			
			if($qrUsuario != null){
				
				$dados_form = array(
					'ID' 			=> $qrUsuario->id,
					'NOME' 			=> $qrUsuario->nome,
					'CATEGORIA_ID' 	=> $qrUsuario->categoria_id,
					'EMAIL' 		=> $qrUsuario->email,
					'LOGIN' 		=> $qrUsuario->login
				);

			}

		}else{
			$dados_form = $this->input->post();
		}

		//regras de validação
		$this->form_validation->set_rules('NOME','NOME', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('CATEGORIA_ID','CATEGORIA', 'required');
		$this->form_validation->set_rules('EMAIL','EMAIL', 'trim|valid_email');
		$this->form_validation->set_rules('LOGIN','LOGIN', 'trim|required|min_length[5]');

		if($this->input->post()['ID'] == ''){
			$this->form_validation->set_rules('SENHA','SENHA', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('RESENHA','RESENHA', 'trim|required|min_length[6]|matches[SENHA]');
		}

		//verifica a validação
		if($this->form_validation->run() == false){
			if( validation_errors() ){
				set_msg( validation_errors() );
			}
		}else{
			//validação OK, verificar se o usuário ainda não existe

			$dados_form = $this->input->post();

			$dados = array(
				'id' 			=> $dados_form['ID'],
				'nome' 			=> $dados_form['NOME'],
				'categoria_id' 	=> $dados_form['CATEGORIA_ID'],
				'email' 		=> $dados_form['EMAIL'],
				'login' 		=> $dados_form['LOGIN']
			);

			if($dados_form['SENHA'] != ''){
				$dados['senha'] = password_hash( $dados_form['SENHA'], PASSWORD_DEFAULT );
			}

			if( $dados['id'] == '')
				unset($dados['id']);

			$this->usuario->cadastrar($dados);

			set_msg_ok( 'Operação efetuada com sucesso.' );
			
			redirect('usuario/lista');
		}

		$dados['titulo'] = 'Usuários';
		$this->load->view('header',$dados);
		$this->load->view('usuario/cadastro',$dados_form);
	}

	public function lista(){
		$dados['titulo'] = 'Usuários';
		$this->load->view('header',$dados);

		$dados_query['qrUsuarios'] = $this->usuario->getUsuarioLista();

		$this->load->view('usuario/lista',$dados_query);
	}

	public function bloqueio($id, $bloqueio){
		$dados['id'] = $id;
		$dados['bloqueado'] = $bloqueio;
		if( $this->usuario->bloquear($dados) ){
			set_msg_ok('Usuário desbloqueado com sucesso.');
		}else{
			set_msg('Não foi possível efetuar o desbloqueio.');
		}
		redirect('usuario/lista');
	}


	public function updateBloqueio($id, $bloqueio){
		
		$this->db->set('bloqueado',$bloqueio);
		$this->db->where('id',$id);
		$this->db->update('jump.usuarios');

	}





}
