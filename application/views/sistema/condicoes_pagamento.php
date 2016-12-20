<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); 
?>
<div class="subContent">
	<div class="tituloConteudo fD">Cadastro de Condições de Pagamento</div>
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
			<?php for($i=1; $i<=20; $i++){ ?>
				<tr>
					<td class="fD">Condi&ccedil;&atilde;o <?php echo $i; ?></td>
					<?php 
					$field = 'CONDICAO_'.$i;
					$valueField = 'condicao_'.$i;
					 ?>
					<td><input type="text" name="condicao_<?php echo $i; ?>" value="<?php echo $qrCondPagto->$valueField; ?>" class="w300"></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2" style="padding-top:20px">
					<button type="submit" class="btn fL fD">Salvar</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('sistema/menu'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>