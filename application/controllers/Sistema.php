<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {
	
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

	public function menu(){
		$dados['titulo'] = 'Menu';
		$this->load->view('header',$dados);
		$this->load->view('menu');

	}

	public function formulas(){
		$dados['titulo'] = 'Fórmulas';
		$this->load->view('header',$dados);
		
		$this->form_validation->set_rules('PERCENTUAL_VENDEDOR','PERCENTUAL VENDEDOR', 'trim|required|max_length[3]|less_than_equal_to[100]');
		$this->form_validation->set_rules('MARGEM','MARGEM', 'trim|required|max_length[3]|less_than_equal_to[100]');

		if($this->input->post()){

			if($this->form_validation->run() == false){
				if( validation_errors() ){
					set_msg( validation_errors() );
				}
			}else{				
				$dados_upd = $this->input->post();

				$dados_form = array(
					'percentual_vendedor' => $dados_upd['PERCENTUAL_VENDEDOR'],
					'margem' => $dados_upd['MARGEM']
				);

				$this->sistema->cadastrarFormulas($dados_form);

				set_msg_ok( 'Fórmulas alteradas com sucesso.' );
			}

			$dados_form = $this->input->post();
		}else{
			$qrFormula = $this->sistema->getFormulas();


			$dados_form = array(
				'PERCENTUAL_VENDEDOR' => $qrFormula->percentual_vendedor,
				'MARGEM' => $qrFormula->margem
			);
		}

		

		$this->load->view('sistema/formulas',$dados_form);
	}

	public function condicoes_pagamento(){
		$dados['titulo'] = 'Condições de Pagamento';
		$this->load->view('header',$dados);
		$dados_form = $this->input->post();

		if($dados_form['condicao_1'] != null){
			$this->sistema->cadastrarCondicoesPagamento($dados_form);
			set_msg_ok( 'Condições de pagamento alteradas com sucesso.' );
		}

		$qrCondPagto = $this->sistema->getCondicoesPagamento($id);
			
		$dados_query = array('qrCondPagto' => $qrCondPagto);

		$this->load->view('sistema/condicoes_pagamento',$dados_query);
	}


	public function materiais(){
		$dados['titulo'] = 'Importar Materiais';
		$this->load->view('header',$dados);
		
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors',1);
		if(isset($_FILES['ARQUIVO']) && $_FILES['ARQUIVO'] != null){
			
			if( $this->getExtensaoArquivo($_FILES['ARQUIVO']['name']) != 'csv'){
				set_msg('Somente são aceitos arquivos csv.');
			}else{
				$path = FCPATH.'uploads/';
				$filename = md5(time()).'csv';
				$fullPath = $path.$filename;
				
				copy( $_FILES['ARQUIVO']['tmp_name'], $fullPath  );
				$pFile = fopen($fullPath ,'r');
				
				$count=0;
				while (!feof ($pFile)) {
					$linha = fgets($pFile, 4096);

					//cabeçalho
					if(++$count == 1)
						continue;
					else{
						if(trim($linha)){
							$columns = explode(';',utf8_encode($linha));
							
							$dados = array(
								'cod' => $this->removerAspas($columns[0]),
								'descricao' => $this->removerAspas($columns[1]),
								'unidade_medida' => $this->removerAspas($columns[5]),
								'custo' => $this->tratarCampoNumerico( $this->removerAspas($columns[9]) )
							);
							
							$this->sistema->cadastrarMaterial($dados);
						}
					}
				}


				set_msg_ok( 'Materiais importados com sucesso.' );
			}
		}

		

		$dados_query = array();

		$this->load->view('sistema/materiais/importar',$dados_query);
	}

	public function listaMateriais(){
		$linhas = 20;
		$inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");
		$qrMateriais = $this->sistema->getListaMateriais( array('linhas' => $linhas, 'inicio' => $inicio) );
		$linha = $qrMateriais->row();
		
		include_once(FCPATH .'application/views/sistema/paginacao.php');
		$config['total_rows'] = $linha->total;
		$config['per_page'] = $linhas;
		$config['base_url'] = base_url('sistema/materiais/lista');

		$this->pagination->initialize($config);
		$param["paginacao"] =  $this->pagination->create_links();

		$dados['titulo'] = 'Materiais';
		$this->load->view('header',$dados);

		$param['qrMateriais'] = $qrMateriais;

		$this->load->view('sistema/materiais/lista',$param);
	}

	public function editarMaterial($cod){
		$dados['titulo'] = 'Editar Material';
		$this->load->view('header',$dados);



		$dados_form = $this->input->post();

		if(isset($dados_form['descricao'])){
			//regras de validação
			$this->form_validation->set_rules('COD', 'COD', 'trim|required|');
			$this->form_validation->set_rules('DESCRICAO','DESCRIÇÃO', 'required');
			$this->form_validation->set_rules('UNIDADE_MEDIDA','UNIDADE_MEDIDA', 'trim|required');
			$this->form_validation->set_rules('CUSTO','CUSTO', 'trim|required|numeric');
			

			//verifica a validação
			if($this->form_validation->run() == false){
				if( validation_errors() ){
					set_msg( validation_errors() );
				}
			}else{
				$dados = array(
					'cod' => $dados_form['cod'],
					'descricao' => $dados_form['descricao'],
					'unidade_medida' => $dados_form['unidade_medida'],
					'custo' => $dados_form['custo']
				);

				$resultado = $this->sistema->cadastrarMaterial($dados);

				if($resultado)
					set_msg_ok('Material alterado com sucesso.');
				else
					set_msg('Não foi possível alterar o material.');

			}
		}else{
			$qrMaterial = $this->sistema->getListaMateriais(array('cod' => $cod));

			if($qrMaterial->num_rows() == 0 ){
				set_msg('Material não encontrado.');
				redirect('sistema/materiais/lista');

			}else{

				$qrUnMed = $this->sistema->getUnidadesMedida();

				$dados_query['qrUnMed'] = $qrUnMed;
				$dados_query['qrMaterial'] = $qrMaterial->row();
			}
		}


		


		

		$this->load->view('sistema/materiais/editar',$dados_query);
	}


	private function removerAspas($textos){
		return str_replace('"','',$textos);
	}

	private function getExtensaoArquivo($nome){
		$parts = explode('.',$nome);
		return $parts[count($parts)-1];
	}

	private function tratarCampoNumerico($param){
		$valor = str_replace(',', '.', $param);
		$parts = explode('.',$valor);
		//tratar valores que eram 1.051,56 e ficam como 1.051.56
		if(count($parts) == 2)
			return $valor;
		else{
			$valor_retorno = '';
			for($i=0; $i<count($parts); $i++){
				if($i == count($parts) - 1)
					$valor_retorno .= '.';

				$valor_retorno .= $parts[$i];
			}
		}

	}

public function buscarMaterial(){
	$data = $this->input->get();
	$qrMateriais = $this->sistema->getListaMateriais(array('descricao' => $data['query']));
	$dados = array('qrMateriais' => $qrMateriais );
	$this->load->view('sistema/materiais/buscarMaterial', $dados);
}



}
