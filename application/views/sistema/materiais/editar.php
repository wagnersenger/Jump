<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); ?>
<div class="subContent">
	<div class="tituloConteudo fD">Editar Material</div>
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
				<td class="fD">Cód</td>
				<td><input type="text" name="COD" id="COD" value="<?php echo $qrMaterial->cod; ?>" class="w50 fL" readonly></td>
			</tr>
			<tr>
				<td class="fD">Descrição</td>
				<td><input type="text" name="DESCRICAO" id="DESCRICAO" value="<?php echo $qrMaterial->descricao; ?>" class="w500 fL" ></td>
			</tr>
			<tr>
				<td class="fD">Un. Med.</td>
				<td><select name="UNIDADE_MEDIDA">
					<?php foreach($qrUnMed->result() as $qrUnidade){ ?>
						<option value="<?php echo $qrUnidade->unidade_medida; ?>" <?php if($qrUnidade->unidade_medida == $qrMaterial->unidade_medida) echo 'selected'; ?>><?php echo $qrUnidade->unidade_medida; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">Custo</td>
				<td><input type="text" name="CUSTO" value="<?php echo $qrMaterial->custo; ?>"></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">
					<button type="submit" class="btn fL fD">Salvar</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('sistema/materiais/lista'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>

<script>
	$('#PERCENTUAL_VENDEDOR').mask('##0', {reverse: true});
	$('#MARGEM').mask('##0', {reverse: true});

</script>