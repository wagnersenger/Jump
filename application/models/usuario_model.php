<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	public function getUsuario($id){
		$this->db->where('id',$id);
		$qrUsuario = $this->db->get('jump.usuarios');

		if($qrUsuario->num_rows() == 1){
			return $qrUsuario->row();
		}else{
			return null;
		}

	}


	public function cadastrar($dados){
		if($dados['id'] != null){		
			//usuário, atualizar
			$this->db->where('id', $dados['id']);
			$this->db->update('jump.usuarios',$dados);

			return $this->db->affected_rows();
		}else{
			$this->db->insert('jump.usuarios',$dados);
			
			return $this->db->insert_id();
		}
	}

	public function bloquear($dados){
		
		//usuário, atualizar
		$this->db->where('id', $dados['id']);
		$this->db->update('jump.usuarios',$dados);

		return $this->db->affected_rows();
		
	}

	public function getUsuarioLogin($login){
		$this->db->where('login',$login);
		$qrUsuario = $this->db->get('jump.usuarios');
		
		if($qrUsuario->num_rows() == 1){
			return $qrUsuario->row();
		}else{
			return null;
		}
	}

	public function getUsuarioLista($login){
		$this->db->order_by('nome');
		$qrUsuario = $this->db->get('jump.usuarios');
		
		if($qrUsuario->num_rows() > 0){
			return $qrUsuario;
		}else{
			return null;
		}
	}

	

}
