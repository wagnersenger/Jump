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
		$this->load->model('produto_model','produto');

		ini_set('error_reporting',E_ALL);
	}

	public function index(){

	}

	public function cadastrar($id=null){
		$dados['titulo'] = 'Produto';
		$this->load->view('header',$dados);

		$qrUnMed = $this->sistema->getUnidadesMedida();

		$dados['qrUnMed'] = $qrUnMed;

		if(strlen(trim($id))){
			$qrProduto = $this->produto->getProduto($id);
			$qrMaterial = $this->produto->getProdutoMaterial($id);

			$dados['qrProduto'] = $qrProduto;
			$dados['qrMateriais'] = $qrMaterial;
		}

		if($this->input->post()){
			$this->form_validation->set_rules('NOME','PRODUTO', 'trim|required|max_length[300]');

			$dados['form'] = $this->input->post();

			if($this->form_validation->run() == false){
				if( validation_errors() ){
					set_msg( validation_errors() );
				}
				
			}else{
				$materiais_ok = true;
				$msg_errors = '';
				$material = $dados['form']['MATERIAL'];
				$material_id = $dados['form']['MATERIAL_ID'];
				$quantidade = $dados['form']['QUANTIDADE'];
				$unidade_medida = $dados['form']['UNIDADE_MEDIDA'];

				for($i=0; $i<count($material); $i++){
					if( strlen(trim($material[$i])) ){
						if( !strlen(trim($quantidade[$i]))  ){
							$materiais_ok = false;
							$msg_errors = '<p>O campo QUANTIDADE é obrigatório.</p>';
						}elseif(!is_numeric($quantidade[$i])){
							$materiais_ok = false;
							$msg_errors = '<p>O campo QUANTIDADE deve ser numérico.</p>';
						}
					}
				}
				if(!$materiais_ok){
					set_msg( $msg_errors );
				}else{

					$dados_produto = array( 'nome' 	=> $dados['form']['NOME']);

					if($id != null)
						$dados_produto['id'] = $id;
					
					$this->db->trans_start();
					if($id = $this->produto->cadastrarProdutoPadrao($dados_produto)) {
						$this->produto->removerProdutoMateriais(array('produto_id' => $id));

						for($i=0; $i<count($material); $i++){
							$dados_material = array( 'produto_id'		=> $id
												   , 'material'			=> $material[$i]
												   , 'quantidade'		=> $quantidade[$i]
												   , 'unidade_medida' 	=> $unidade_medida[$i]
												   );

							if(strlen(trim($material_id[$i])))
								$dados_material['cod_material'] = $material_id[$i];

							$this->produto->cadastrarProdutoMaterial($dados_material);
						}
						$this->db->trans_complete();
						set_msg_ok( 'Dados cadastrados com sucesso.' );
						redirect('produto/lista');

					}else{
						$this->db->trans_rollback();
						set_msg('Não foi possível registrar os dados do produto.');
					}
					
				}
			}

		}

		$this->load->view('produto/cadastrar',$dados);
	}

	
	public function lista(){
		$qrProdutos = $this->produto->getProdutoLista();
		$dados['titulo'] = 'Produto Padrão';

		$this->load->view('header',$dados);

		$dados['qrProdutos'] = $qrProdutos;
		$this->load->view('produto/lista',$dados);
	}

	public function ativar($id, $ativo){
		if( $this->produto->ativarProduto($id,$ativo) )
			set_msg_ok('Produto alterado com sucesso.');
		else
			set_msg_ok('Não foi possível alterar o produto');

		redirect('produto/lista');
	}

}
