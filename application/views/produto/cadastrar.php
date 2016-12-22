<?php ini_set('error_reporting','E_ALL & ^E_NOTICE & ^E_WARNING' ); ?>
<script src="<?php echo base_url('assets/js/jquery.autocomplete.min.js'); ?>" type="text/javascript"></script>
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

	if( !$this->input->post() ){
		if(isset($qrMateriais)){
			$mat_id  = array();
			$material = array();
			$quant = array();
			$un_med = array();
			$itens = array();
			$count = 0;
			foreach($qrMateriais->result() as $qrMaterial){
				array_push($mat_id, $qrMaterial->cod_material);
				array_push($material, $qrMaterial->material);
				array_push($quant, $qrMaterial->quantidade);
				array_push($un_med, $qrMaterial->unidade_medida);
				array_push($itens, ++$count);
			}

			$form['MATERIAL_ID'] = $mat_id;
			$form['ITEM'] = $itens;
			$form['MATERIAL'] = $material;
			$form['QUANTIDADE'] = $quant;
			$form['UNIDADE_MEDIDA'] = $un_med;
			$form['NOME'] = $qrProduto->nome;

			$idx_materiais = $count;
		}
	}
	
	?>

	<form name="frmCadastro" method="post" >
		<input type="hidden" name="ID" value="<?php echo $qrProduto->id; ?>">
		<table >
			<tr>
				<td class="fD" width="1%"><nobr>Produto</nobr></td>
				<td>
					<input type="text" name="NOME" id="NOME"  class="w500 fL" value="<?php echo $form['NOME']; ?>" >
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
							<?php 
							$idx_materiais = count($form['MATERIAL']) ? count($form['MATERIAL']) : 1;
							$idx = 1;

							if( !$this->input->post() && isset($qrMateriais)){
								$idx_materiais = $count;
							}

							for($i=0; $i<$idx_materiais; $i++){ ?>
								<tr id="tr_material<?php echo $idx; ?>">
									<input type="hidden" name="MATERIAL_ID[]" id="MATERIAL_ID<?php echo $idx; ?>" value="<?php echo $form['MATERIAL_ID'][$i]; ?>">
									<input type="hidden" name"ITEM[]" value="<?php echo $idx; ?>" value="<?php echo $form['ITEM'][$i]; ?>">
									<td class="fD" ><?php echo $idx; ?></td>
									<td><input type="text" name="MATERIAL[]" id="MATERIAL<?php echo $idx; ?>" item="<?php echo $idx; ?>" class="w400 material"  value="<?php echo $form['MATERIAL'][$i]; ?>"></td>
									<td><input type="text"  name="QUANTIDADE[]" id="QUANTIDADE<?php echo $idx; ?>" class="w50"  value="<?php echo $form['QUANTIDADE'][$i]; ?>"></td>
									<td><select name="UNIDADE_MEDIDA[]" id="UNIDADE_MEDIDA<?php echo $idx; ?>" class="w50">
										<?php foreach($qrUnMed->result() as $qrUnidade){ ?>
											<option value="<?php echo $qrUnidade->unidade_medida; ?>" <?php if($qrUnidade->unidade_medida == $form['UNIDADE_MEDIDA'][$i]) echo 'selected'; ?>><?php echo $qrUnidade->unidade_medida; ?></option>
										<?php } ?>
										</select>
									</td>
									<td><button type="button" onClick="removerMaterial(<?php echo $idx; ?>)" class="btnVazio fRed">
											<img src="<?php echo base_url('assets/imgs/icon/remove.jpg'); ?>" width="16px"  align="absmiddle"> Remover item
										</button>
									</td>
								</tr>
								<script>
									$("#MATERIAL<?php echo $idx; ?>").autocomplete({
											serviceUrl: "<?php echo base_url('sistema/buscarMaterial'); ?>",
										    onSelect: function (suggestion) {
										    	item = $(this).attr('item');
										    	$('#MATERIAL_ID'+item).val(suggestion.data);
										    	
										    },
										    onSearchComplete: function (query, suggestions) {
										    	item = $(this).attr('item');
										    	if(suggestions.length == 1){
										    		$('#MATERIAL_ID'+item).val(suggestions[0].data);
										    	}else{
													$('#MATERIAL_ID'+item).val("");
										    	}
										    }
										});
								</script>
							<?php 
								$idx++;
							} ?>
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
					<button type="button" class="btn fL fD" onClick="window.location='<?php echo base_url('produto/lista'); ?>'">Voltar</button>

				</td>
			</tr>

		</table>
	</form>
</div>
<script type="text/javascript">

	var itens = <?php echo count($form['MATERIAL']) ? count($form['MATERIAL']) : 1; ?>;
	unidades_medida = "";
	<?php foreach($qrUnMed->result() as $qrUnidade){ ?>
		unidades_medida += "<option value=\"<?php echo $qrUnidade->unidade_medida; ?>\" <?php if($qrUnidade->unidade_medida == $qrMaterial->unidade_medida) echo 'selected'; ?>><?php echo $qrUnidade->unidade_medida; ?></option>";
	<?php } ?>

	function addMateria(){
		
		itens++;
		
		linha  = "<tr id=\"tr_material"+itens+"\">";
		linha += "	<input type=\"hidden\" name=\"MATERIAL_ID[]\" id=\"MATERIAL_ID"+itens+"\"  >";
		linha += "  <input type=\"hidden\" name\"ITEM[]\" value=\""+itens+"\">";
		linha += "	<td class=\"fD\" >"+itens+"</td>";
		linha += "	<td><input type=\"text\" name=\"MATERIAL[]\" id=\"MATERIAL"+itens+"\"  class=\"w400\" item=\""+itens+"\" ></td>";
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

		linha += "<script type=\"text/javascript\">";
		linha += "$(\"#MATERIAL"+itens+"\").autocomplete({";
		linha += "	serviceUrl: \"<?php echo base_url('sistema/buscarMaterial'); ?>\",";
		linha += "    onSelect: function (suggestion) { ";
		linha += "    	item = $(this).attr('item'); ";
		linha += "    	$('#MATERIAL_ID'+item).val(suggestion.data); ";
		linha += "    }, ";
		linha += "    onSearchComplete: function (query, suggestions) {";
	    linha += "	item = $(this).attr('item'); ";
	    linha += "	if(suggestions.length == 1){ ";
	    linha += "		$('#MATERIAL_ID'+item).val(suggestions[0].data);";
	    linha += "	}else{ ";
		linha += "		$('#MATERIAL_ID'+item).val(''); ";
	    linha += "	}";
	    linha += " }";
		linha += "}); ";
		linha += "<\/script>";

		$('#tbMateriais').append(linha);

		//v_obj = document.getElementById('tbMateriais');
		//v_obj.innerHTML = v_obj.innerHTML+linha;

	}

	function removerMaterial(v_item){
		document.getElementById('tr_material'+v_item).remove();
	}
</script>