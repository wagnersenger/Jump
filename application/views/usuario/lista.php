<div class="subContent">
	
	<div class="tituloConteudo fD">Cadastro de Usuário</div>

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
				<td width="30%">Nome</td>
				<td width="20%">Login</td>
				<td width="20%">Categoria</td>
				<td width="29%">E-mail</td>
				<td width="1%">Operações</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($qrUsuarios->result() as $qrUsuario){ 
			$bloqueio = $qrUsuario->bloqueado ? 0 : 1;
			?>
			<tr>
				<td><?php echo $qrUsuario->nome; ?></td>
				<td><?php echo $qrUsuario->login; ?></td>
				<td><?php 
					switch($qrUsuario->categoria_id){
						case '1': $cat = 'Administrador'; break;
						case '2': $cat = 'Vendedor'; break;
						case '3': $cat = 'Orçamentista'; break;
						case '4': $cat = 'Layoutista'; break;
					}

				 	echo $cat; ?>
				 </td>
				<td><?php echo $qrUsuario->email; ?></td>
				<td>
					<nobr>
						<button onClick="window.location = '<?php echo base_url('/usuario/cadastro/'.$qrUsuario->id); ?>'"><img src="<?php echo base_url('assets/imgs/icon/pencil.png'); ?>" class="icon">Editar</button>
						<button onClick="window.location = '<?php echo base_url('usuario/bloqueio/'.$qrUsuario->id.'/'.$bloqueio); ?>'">
							<img src="<?php echo base_url('assets/imgs/icon/'.($qrUsuario->bloqueado ? 'unlock' : 'lock').'.png'); ?>" class="icon">
							<?php echo $qrUsuario->bloqueado ? 'Desbloquear' : 'Bloquear'; ?>
						</button>
					</nobr>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar</button>
	<button type="button" class="btn fR fD" onClick="window.location='<?php echo base_url('usuario/cadastro'); ?>'">Inserir Novo</button>
	
</div>