<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); 
?>
<div class="subContent">
	<div class="tituloConteudo fD">Cadastro de Fórmulas</div>
	<hr>
	<?php
	if($msg = get_msg()){
		echo '<div class="msg-box">'.$msg.'</div>';
	}
	if($msg = get_msg_ok()){
		echo '<div class="msg-box-ok">'.$msg.'</div>';
	}
	?>

	<form name="frmCadastro" method="post" >
		<table >
			<tr>
				<td class="fD">Percentual Vendedor</td>
				<td><input type="text" name="PERCENTUAL_VENDEDOR" id="PERCENTUAL_VENDEDOR" value="<?php echo $PERCENTUAL_VENDEDOR; ?>" class="w50 fL tac" onKeyUp="corrigirCampo(this)">&nbsp;<span class="fD fs14" >%</span></td>
			</tr>			
			<tr>
				<td class="fD">Margem</td>
				<td><input type="text" name="MARGEM" id="MARGEM" value="<?php echo $MARGEM; ?>" class="w50 fL tac" onKeyUp="corrigirCampo(this)">&nbsp;<span class="fD fs14" >%</span></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">
					<button type="submit" class="btn fL fD">Salvar</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>

<script>
	$('#PERCENTUAL_VENDEDOR').mask('##0', {reverse: true});
	$('#MARGEM').mask('##0', {reverse: true});

</script>