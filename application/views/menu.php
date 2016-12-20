<div class="jGrande jImgMaior">
	<img src="<?php echo base_url('/assets/imgs/jGrande.png'); ?> ">
</div>
<ul class="fD menu">
	<li><a href="<?php echo base_url(); ?>">Solicitação de Layout/Orçamento</a></li>
	<li><a href="">Começar Layout</a></li>
	<li><a href="">Começar Orçamento</a></li>
	<li><a href="">Status</a></li>

	<?php if($this->session->userdata('user_categoria_id') == 1){ ?>
		<li><br /><a href="<?php echo base_url('sistema/formulas'); ?>">Fórmulas</a></li>
		<li><a href="<?php echo base_url('usuario/lista'); ?>">Cadastro de Usuário</a></li>
		<li><a href="<?php echo base_url('produto/cadastrar'); ?>">Cadastro de Produto Padrão</a></li>
		<li><a href="<?php echo base_url('sistema/condicoes_pagamento'); ?>">Cadastro de Condições de Pagamento</a></li>
		<li><a href="<?php echo base_url('sistema/materiais/importar'); ?>">Importar Materiais</a></li>
	<?php } ?>
</ul>