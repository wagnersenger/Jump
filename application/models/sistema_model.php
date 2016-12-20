<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('sistema_model','sistema');
	}

	public function getFormulas(){
		$qrUsuario = $this->db->get('jump.formulas');

		if($qrUsuario->num_rows() == 1){
			return $qrUsuario->row();
		}else{
			return null;
		}

	}

	public function cadastrarFormulas($dados){
		$this->db->update('jump.formulas',$dados);

		//if($this->db->)
	}

	public function getCondicoesPagamento(){
		$qrCondPagto = $this->db->get('jump.condicoes_pagamento');
		
		return $qrCondPagto->row();
		

	}

	public function cadastrarCondicoesPagamento($dados){
		$this->db->update('jump.condicoes_pagamento',$dados);
		$ar = $this->db->affected_rows();

		return $ar;
	}

	public function cadastrarMaterial($dados){
		
		$this->db->where('cod',$dados['cod']);
		$this->db->update('jump.materiais',$dados);

		if( $this->db->affected_rows() == 0 ){
			$this->db->insert('jump.materiais',$dados);
		}

		return $this->db->affected_rows();
	}


	public function getListaMateriais($params){
		$search = array();
		$sql = 'select cod
					 , descricao
					 , custo
					 , unidade_medida
					 , to_char(date_insert,\'dd/mm/yyyy hh24:mi:ss\') as data_modificacao
					 , count(*) over() as total
				  from jump.materiais
				 where 1=1 ';
		
		if( isset($params['cod']) && strlen(trim($params['cod']))){
			$sql .= ' and cod = ?';
			array_push($search, $params['cod']);
		}
		if( isset($params['descricao']) && strlen(trim($params['descricao']))){
			$sql .= ' and descricao ilike  ?';
			array_push($search, '%'.$params['descricao'].'%');
		}

		if( isset($params['inicio']) && strlen(trim($params['inicio']))){
			$sql .= ' offset ?';
			array_push($search, $params['inicio']);
		}
		if( isset($params['linhas']) && strlen(trim($params['linhas']))){
			$sql .= ' limit ?';
			array_push($search, $params['linhas']);
		}

		$qrMateriais = $this->db->query( $sql, $search );
		return $qrMateriais;
	}

	public function getUnidadesMedida(){
		$sql = 'select distinct unidade_medida
				  from jump.materiais
				 order by unidade_medida';

		$qrUnMed = $this->db->query( $sql );
		return $qrUnMed;
	}

	public function getTotalMateriais(){
		$this->db->count_all_results('jump.materiais');
	}



}
