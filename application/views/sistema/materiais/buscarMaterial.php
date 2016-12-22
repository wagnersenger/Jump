<?php 
$result = array();
$result['query'] = "Unit";
$result['suggestions'] = "";

$total = $qrMateriais->num_rows();

if($total > 0 ){
	$itens = array();
	foreach($qrMateriais->result() as $qrMaterial){
		//echo $qrMaterial->cod.'-'.$qrMaterial->descricao.'|'.$qrMaterial->cod.chr(13).chr(10);
		array_push($itens, array("value" => $qrMaterial->descricao, "data" => $qrMaterial->cod) );
		//echo $qrMaterial->descricao.chr(13).chr(10);
	}

	$result['suggestions'] = $itens;

	
}
echo json_encode($result);