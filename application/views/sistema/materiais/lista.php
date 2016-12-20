<div class="subContent">
	
	<div class="tituloConteudo fD">Lista de Materiais</div>

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
				<td width="10%">C&oacute;d</td>
				<td width="45%">Descri&ccedil;&atilde;o</td>
				<td width="10%">Un. Med.</td>
				<td width="10%">Custo</td>
				<td width="15%">Data Modif.</td>
				<td width="10%">Operações</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($qrMateriais->result() as $qrMaterial){ ?>
			<tr>
				<td><?php echo $qrMaterial->cod; ?></td>
				<td style="text-align:left"><?php echo $qrMaterial->descricao; ?></td>
				<td><?php echo $qrMaterial->unidade_medida; ?></td>
				<td style="text-align:right"><nobr><?php echo 'R$ '. number_format($qrMaterial->custo, 2, ',','.'); ?></nobr></td>
				<td><?php echo $qrMaterial->data_modificacao; ?></td>
				<td>
					<nobr>
						<button onClick="window.location = '<?php echo base_url('/sistema/materiais/editar/'.$qrMaterial->cod); ?>'"><img src="<?php echo base_url('assets/imgs/icon/pencil.png'); ?>" class="icon">Editar</button>
					</nobr>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<hr class="mb15">
	<?php echo $paginacao; ?>
	
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar ao menu</button>
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('sistema/materiais/importar'); ?>'">Importar</button>
	
</div>