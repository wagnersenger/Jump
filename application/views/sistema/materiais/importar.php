<?php //ini_set('error_reporting','E_ALL & ^E_NOTICE');
ini_set('error_reporting','E_ALL & ^E_NOTICE'); ?>

<div class="subContent">
	<div class="tituloConteudo fD">Importar Materiais</div>
	<hr>
	<?php
	if($msg = get_msg()){
		echo '<div class="msg-box">'.$msg.'</div>';
	}
	if($msg = get_msg_ok()){
		echo '<div class="msg-box-ok">'.$msg.'</div>';
	}
	?>

	<form name="frmCadastro" method="post" enctype="multipart/form-data" >
		<br />
		<table >
			<tr>
				<td class="fD">Arquivo</td>
				<td><input type="file" name="ARQUIVO" ></td>
			</tr>			
			<tr>
				<td colspan="2" style="padding-top:20px">
					<button type="submit" class="btn fL fD">Importar</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('sistema/materiais/lista'); ?>'">Lista de Materiais</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>
<script>
	$(document).ready(function(){
		$("#file_input").filer( { 
			limit: 1,
			extensions: "text/csv",

		 } );	
	})
	
</script>