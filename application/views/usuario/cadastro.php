<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); 
?>
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

	<form name="frmCadastro" method="post" >
		<input type="hidden" name="ID" value="<?php echo $ID; ?>">
		<table >
			<tr>
				<td class="fD">Nome</td>
				<td><input type="text" name="NOME" value="<?php echo $NOME; ?>" class="w300"></td>
			</tr>
			<tr>
				<td class="fD">Login</td>
				<td><input type="text" name="LOGIN" value="<?php echo $LOGIN; ?>" class="w300"></td>
			</tr>
			<tr>
				<td class="fD">Categoria</td>
				<td><select name="CATEGORIA_ID" class="w300" >
						<option value="1" <?php if($CATEGORIA_ID == 1) echo 'selected'; ?>>Administrador</option>
						<option value="2" <?php if($CATEGORIA_ID == 2) echo 'selected'; ?>>Vendedor</option>
						<option value="3" <?php if($CATEGORIA_ID == 3) echo 'selected'; ?>>Orçamentista</option>
						<option value="4" <?php if($CATEGORIA_ID == 4) echo 'selected'; ?>>Layoutista</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fD">E-mail</td>
				<td><input type="text" name="EMAIL" value="<?php echo $EMAIL; ?>" class="w300"></td>
			</tr>
			<tr>
				<td class="fD">Senha</td>
				<td><input type="password" name="SENHA" value="<?php echo $SENHA; ?>" class="w300"></td>
			</tr>
			<tr>
				<td class="fD">Repita a Senha</td>
				<td><input type="password" name="RESENHA" value="<?php echo $RESENHA; ?>" class="w300"></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:20px">
					<button type="submit" class="btn fL fD">Salvar</button>
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('usuario/lista'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>