<?php ini_set('error_reporting','E_ALL & ^E_NOTICE'); ?>
<script src="<?php echo base_url('assets/js/jquery.autocomplete.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.autocomplete.css'); ?>">
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

	<form name="frmCadastro" method="post" >
		<table >
			<tr>
				<td class="fD" width="1%"><nobr>Produto</nobr></td>
				<td>
					<input type="text" name="NOME" id="NOME" value="<?php echo $NOME; ?>" class="w500 fL" >
				</td>
			</tr>			
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table>
						<tr class="subTableHead" >
							<td></td>
							<td>Matéria Prima</td>
							<td>Quant</td>
							<td>Un. Med</td>
						</tr>
						<tbody id="tbMateriais">
							<tr id="tr_material1">
								<input type="hidden" name="MATERIAL_ID[]" id="MATERIAL_ID1" >
								<td class="fD" >1</td>
								<td><input type="text" name="MATERIAL[]" id="MATERIAL1"  class="w300 material" ></td>
								<td><input type="text"  name="QUANTIDADE[]" id="QUANTIDADE1" class="w50" ></td>
								<td><select name="UNIDADE_MEDIDA[]" id="UNIDADE_MEDIDA1" class="w50">
									<?php foreach($qrUnMed->result() as $qrUnidade){ ?>
										<option value="<?php echo $qrUnidade->unidade_medida; ?>" <?php if($qrUnidade->unidade_medida == $qrMaterial->unidade_medida) echo 'selected'; ?>><?php echo $qrUnidade->unidade_medida; ?></option>
									<?php } ?>
									</select>
								</td>
								<td><button type="button" onClick="removerMaterial(1)" class="btnVazio fRed">
										<img src="<?php echo base_url('assets/imgs/icon/remove.jpg'); ?>" width="16px"  align="absmiddle"> Remover item
									</button>
								</td>
							</tr>
						</tbody>
					</table>
					<button class="btnVazio fD" type="button" onClick="addMateria()" >
						<img src="<?php echo base_url('assets/imgs/icon/add.jpg'); ?>" style="width:12px;" > Adicionar matéria prima
					</button>
				</td>
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
<script type="text/javascript">
	$(".material").autocomplete("<?php echo base_url('sistema/materiais/buscar'); ?>");


	var itens = 1;
	unidades_medida = "";
	<?php foreach($qrUnMed->result() as $qrUnidade){ ?>
		unidades_medida += "<option value=\"<?php echo $qrUnidade->unidade_medida; ?>\" <?php if($qrUnidade->unidade_medida == $qrMaterial->unidade_medida) echo 'selected'; ?>><?php echo $qrUnidade->unidade_medida; ?></option>";
	<?php } ?>

	function addMateria(){
		
		itens++;
		
		linha  = "<tr id=\"tr_material"+itens+"\">";
		linha += "	<input type=\"hidden\" name=\"MATERIAL_ID[]\" id=\"MATERIAL_ID"+itens+"\" >";
		linha += "	<td class=\"fD\" >"+itens+"</td>";
		linha += "	<td><input type=\"text\" name=\"MATERIAL[]\" id=\"MATERIAL"+itens+"\"  class=\"w300\" ></td>";
		linha += "	<td><input type=\"text\"  name=\"QUANTIDADE[]\" id=\"QUANTIDADE"+itens+"\" class=\"w50\" ></td>";
		linha += "	<td><select name=\"UNIDADE_MEDIDA[]\" id=\"UNIDADE_MEDIDA"+itens+"\" class=\"w50\"> ";
		linha += unidades_medida;
		linha += "		</select>";
		linha += "	</td>";
		linha += "  <td><button type=\"button\" onClick=\"removerMaterial("+itens+")\" class=\"btnVazio fRed\">";
		linha += "			<img src=\"<?php echo base_url('assets/imgs/icon/remove.jpg'); ?>\" width=\"16px\"  align=\"absmiddle\"> Remover item";
		linha += "		</button>";
		linha += "	</td>";
		linha += "</tr>";

		v_obj = document.getElementById('tbMateriais');
		v_obj.innerHTML = v_obj.innerHTML+linha;

	}

	function removerMaterial(v_item){
		document.getElementById('tr_material'+v_item).remove();
	}
</script>