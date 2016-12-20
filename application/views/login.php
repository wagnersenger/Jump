<script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
<div class="jGrande">
	<img src="<?php echo base_url('/assets/imgs/jGrande.png'); ?>">
</div>

<div class="dvLogin">
	<?php
	if($msg = get_msg()){
		echo '<div class="msg-box">'.$msg.'</div>';
	}

	?>
	<form method="post">
		<table>
			<tr>
				<td class="fD">Login</td>
				<td><input type="text" name="LOGIN" id="LOGIN" style="width:300px" value="<?php echo $LOGIN; ?>"></td>
			</tr>
			<tr>
				<td class="fD">Senha</td>
				<td><input type="password" name="SENHA" id="SENHA" style="width:300px" value="<?php echo $SENHA; ?>"></td>
			</tr>
			<tr>
				<td colspan="2" text-align="right">
					<button class="btn" >Entrar</button>
				</td>
			</tr>	
		</table>
	</form>
</div>