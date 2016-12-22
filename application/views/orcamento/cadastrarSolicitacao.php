<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); 
?>
<div class="subContent">
	<div class="tituloConteudo fD">Solicitação de Layout/Orçamento</div>
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
				<td class="fD">Cliente</td>
				<td colspan="5"><input type="text" name="CLIENTE" id="CLIENTE" value="<?php echo $CLIENTE; ?>" class="w500 fL " ></td>
			</tr>
			<tr>
				<td class="fD">Contato</td>
				<td colspan="2"><input type="text" name="CONTATO" id="CONTATO" value="<?php echo $CONTATO; ?>" class="w300 fL " ></td>
				<td class="fD">Fone</td>
				<td><input type="text" name="DDD" class="w30"></td>
				<td><input type="text" name="FONE" style="width:130px"></td>
			</tr>
			<tr>
				<td class="fD">E-mail</td>
				<td><input type="text" name="EMAIL" class="w300" ></td>
				<td class="fD" colspan="3">Vendedor</td>
				<td><select style="width:100%">

					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">Fazer Layout</td>
				<td>
					<select name="LAYOUT">
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">ACM Faturado</td>
				<td>
					<select name="ACMFATURADO">
						<option value="1">Sim</option>
						<option value="0">Não</option>
						<option value="2">Os dois</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">Condi&ccedil;&atilde;o de Pagamento</td>
				<td>
					<select name="CONDICAO_PAGAMENTO">
						<option value="SIM">SIM</option>
						<option value="Não">Não</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">Observações</td>
				<td colspan="5"><textarea name="OBSERVACAO" class="w500" style="height:100px;"></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
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