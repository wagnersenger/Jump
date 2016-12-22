<div class="subContent">
	
	<div class="tituloConteudo fD">Cadastro de Produto Padrão</div>

	<hr>
	<?php
	if($msg = get_msg()){
		echo '<div class="msg-box">'.$msg.'</div>';
	}
	if($msg = get_msg_ok()){
		echo '<div class="msg-box-ok">'.$msg.'</div>';
	}
	?>

	<table class="tblDados" cellpadding="2" cellspacing="3">
		<thead>
			<tr>
				<td width="5%">Id</td>
				<td width="79%" style="text-align:left">Nome</td>
				<td width="15%" style="text-align:center">Ativo</td>
				<td width="1%">Operações</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($qrProdutos->result() as $qrProduto){ 
			$ativo = $qrProduto->ativo ? 0 : 1;
			?>
			<tr>
				<td><?php echo $qrProduto->id; ?></td>
				<td style="text-align:left"><?php echo $qrProduto->nome; ?></td>
				<td style="text-align:center"><?php echo $qrProduto->ativo ? 'Sim' : 'Não'; ?></td>
				<td>
					<nobr>
						<button onClick="window.location = '<?php echo base_url('/produto/cadastrar/'.$qrProduto->id); ?>'"><img src="<?php echo base_url('assets/imgs/icon/pencil.png'); ?>" class="icon">Editar</button>
						<button onClick="window.location = '<?php echo base_url('produto/ativar/'.$qrProduto->id.'/'.$ativo); ?>'">
							<img src="<?php echo base_url('assets/imgs/icon/'.($qrProduto->ativado ? 'unlock' : 'lock').'.png'); ?>" class="icon">
							<?php echo $qrProduto->ativo ? 'Ativar' : 'Desativar'; ?>
						</button>
					</nobr>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar</button>
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('produto/cadastrar'); ?>'">Inserir Novo</button>
	
</div>