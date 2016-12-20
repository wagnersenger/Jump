<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( !function_exists('set_msg')){
	//seta uma mensagem via session para ser lida posteriormente
	function set_msg($msg=null){
		$ci = & get_instance();
		$ci->session->set_userdata('aviso','<p>'.$msg.'</p>');
	}
}

if( !function_exists('get_msg')){
	//retorna uma mensagem definida pela função set_msg

	function get_msg($destroy=true){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso');

		if($destroy)
			$ci->session->unset_userdata('aviso');

		return $retorno;
	}
}


if( !function_exists('set_msg_ok')){
	//seta uma mensagem via session para ser lida posteriormente
	function set_msg_ok($msg=null){
		$ci = & get_instance();
		$ci->session->set_userdata('aviso_ok','<p>'.$msg.'</p>');
	}
}

if( !function_exists('get_msg_ok')){
	//retorna uma mensagem definida pela função set_msg

	function get_msg_ok($destroy=true){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso_ok');

		if($destroy)
			$ci->session->unset_userdata('aviso_ok');

		return $retorno;
	}
}