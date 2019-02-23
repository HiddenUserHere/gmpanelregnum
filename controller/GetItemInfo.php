<?php

	include_once '../../library/hex.php';
	include_once '../model/Model.php';
	
	//Get Data from Item
	$itemcode = $_POST['itemcode'];
	$pHex = new HEX();
	$pModel = new Model();
	$pHex->readFile('D:\\Server\\Login\\Data\\Item\\'.$itemcode.'.dat');
	$data = $pHex->getDataFromFile();
	$itemInfo = $pModel->GetItemInfo($data);
	
	$html = '<table style="margin-top:-20px">';
	
	foreach($itemInfo as $info):
		$keys = array_keys($info);
		$value = array_values($info);
		
		for ($i = 0; $i < sizeof($info); $i++)
		{
			$style = '';
			
			if( $value[$i] == '' )
				continue;
				
			//Styles Item Info
			if( $i == 0 )
				$style = 'font-weight: bold;';
			if( $i > 24 && $i < 31 )
				$style = 'color: #685a43;';
				
			$html.= '<tr><td width="200px" style="'.$style.'">'.$keys[$i].':</td><td style="font-weight:bold;'.$style.'">'.$value[$i].'</td></tr>';
		}
			
	endforeach;
	
	$html.= '</table>';
	
	echo $html;
		
?>