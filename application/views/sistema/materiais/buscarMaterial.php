<?php 
$total = $qrMateriais->num_rows();

if($total > 0 ){
	foreach($qrMateriais->result() as $qrMaterial){
		//echo $qrMaterial->cod.'-'.$qrMaterial->descricao.'|'.$qrMaterial->cod.chr(13).chr(10);
		echo $qrMaterial->descricao.chr(13).chr(10);
	}
}
