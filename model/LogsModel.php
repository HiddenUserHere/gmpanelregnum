<?php

class LogsModel extends Model
{
	public $tableArray = array();
	
	public function GetLogs()
	{
		//Get Parameters from Form
		$logs = array();
		$searchby = Request::getForm('searchby');
		$text = Request::getForm('text');
		$category = Request::getForm('category');
		$date = Request::getForm('date');
		$onlyplayer = Request::getForm('onlyplayer');

		$searchby1 = Request::getForm('searchby1');
		$text1 = Request::getForm('text2');
		
		$selectDB = '';
		$whereQuery = '';
		$andQuery = '';
		$resultArray = array();
		
		//Search By
		switch( $searchby )
		{
			case 'Character Name':				
				$whereQuery = 'WHERE Description LIKE \'%['.$text.'%\' ESCAPE \'[\'';

				//Warehouse Log
				if( $category == 'Warehouse' )
					$whereQuery = 'WHERE CharName=\''.$text.'\'';

				break;
			case 'Item Code':	
				$whereQuery = 'WHERE Description LIKE \'%['.$text.'%\' ESCAPE \'[\'';
				break;
			case 'Item Checksum':
				$code1 = substr($text, 0, strpos($text,'x') - 1);
				$code2 = substr($text, strpos($text,'x') + 2);

				$whereQuery = 'WHERE Code1=\''.$code1.'\' AND Code2=\''.$code2.'\'';
				break;
			case 'Account':				
				$whereQuery = 'WHERE AccountName=\''.$text.'\'';

				//Fury Arena Log
				if( $category == 'Fury Arena' )
					$whereQuery = 'WHERE Description LIKE \'%['.$text.'%\' ESCAPE \'[\'';

				//Warehouse Log
				if( $category == 'Warehouse' )
					$whereQuery = 'WHERE UserID=\''.$text.'\'';

				break;
			case 'IP':				
				$whereQuery = 'WHERE IP LIKE \'%'.$text.'%\'';
				break;
			case 'Item Name':
				$whereQuery = 'WHERE Description LIKE \'%['.$text.'%\' ESCAPE \'[\'';
				break;
			case 'Mac Address':
				$whereQuery = 'WHERE Description LIKE \'%['.$text.'%\' ESCAPE \'[\'';
				break;
			case 'Log ID':
				$whereQuery = 'WHERE LogID=\''.$text.'\'';
				break;
			case 'Action':
				if( $text == 'Ban')
					$whereQuery = 'WHERE Action=2';
				else if( $text == 'DC')
					$whereQuery = 'WHERE Action=1';
				else
					$whereQuery = 'WHERE Action=0';
				break;
		}

		if( $text1 != '' )
		{
			switch( $searchby1 )
			{
				case 'Character Name':				
					$andQuery = 'AND Description LIKE \'%['.$text1.'%\' ESCAPE \'[\'';

					//Warehouse Log
					if( $category == 'Warehouse' )
						$whereQuery = 'AND CharName=\''.$text1.'\'';
					break;
				case 'Item Code':	
					$andQuery = 'AND Description LIKE \'%['.$text1.'%\' ESCAPE \'[\'';
					break;
				case 'Item Checksum':
					$code1 = substr($text, 0, strpos($text1,'x') - 1);
					$code2 = substr($text, strpos($text1,'x') + 2);

					$andQuery = 'AND Code1=\''.$code1.'\' AND Code2=\''.$code2.'\'';
					break;
				case 'Account':				
					$andQuery = 'AND AccountName=\''.$text1.'\'';

					//Fury Arena Log
					if( $category == 'Fury Arena' )
						$andQuery = 'AND Description LIKE \'%['.$text1.'%\' ESCAPE \'[\'';

					//Warehouse Log
					if( $category == 'Warehouse' )
						$andQuery = 'AND UserID=\''.$text1.'\'';

					break;
				case 'IP':				
					$andQuery = 'AND IP LIKE \'%'.$text1.'%\'';
					break;
				case 'Item Name':
					$andQuery = 'AND Description LIKE \'%['.$text1.'%\' ESCAPE \'[\'';
					break;
				case 'Mac Address':
					$andQuery = 'AND Description LIKE \'%['.$text1.'%\' ESCAPE \'[\'';
					break;
				case 'Log ID':
					$andQuery = 'AND LogID=\''.$text1.'\'';
					break;
				case 'Action':
					if( $text == 'Ban')
						$andQuery = 'AND Action=2';
					else if( $text == 'DC')
						$andQuery = 'AND Action=1';
					else
						$andQuery = 'AND Action=0';
					break;
			}
		}
		
		//Category Log
		switch( $category )
		{
			case 'Account':
				$selectDB = 'SELECT TOP 5000 * FROM AccountLog';
				break;
			case 'Character':
				$selectDB = 'SELECT TOP 5000 * FROM CharacterLog';
				break;
			case 'Cheat':
				$selectDB = 'SELECT TOP 5000 * FROM CheatLog';
				break;
			case 'Item':
				$selectDB = 'SELECT TOP 5000 * FROM ItemLog';
				break;
			case 'Coin Shop':
				$selectDB = 'SELECT TOP 5000 * FROM CoinLog';
				break;
			case 'Fury Arena':
				$selectDB = 'SELECT TOP 5000 * FROM FuryArenaLog';
				break;
			case 'Warehouse':
				$selectDB = 'SELECT TOP 5000 * FROM WarehouseLog';
				break;
		}

		//If all fields is empty
		if( $text == '' )
			$whereQuery = '';

		//If have date to get result
		if( $date != '' && $text != '' )
			$whereQuery .= ' AND Date LIKE \'%'.substr_replace($date,'',6,2).'%\'';
		else if( $date != '' && $text == '' )
			$whereQuery .= 'WHERE Date LIKE \'%'.substr_replace($date,'',6,2).'%\'';
					
		//Return Results
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB', FALSE);
		
		echo $selectDB.' '.$whereQuery.' '.$andQuery.' ORDER BY ID DESC';

		if( $pSQL->Prepare($selectDB.' '.$whereQuery.' '.$andQuery.' ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			//Set Table Head 
			for ( $i = 1; $i < $pSQL->GetNumColumns() +1; $i++ )
				array_push($this->tableArray,$pSQL->GetNameColumn( $i ));
			
			//Get Results
			while( $pSQL->Fetch() )
			{
				if( in_array('AccountName',$this->tableArray))
				{
					if( ($this->GetAccountIsGameMaster( $pSQL->GetData('AccountName'))) && ($onlyplayer == 'on') )
						continue;
				}
					
				for ( $i = 1; $i < $pSQL->GetNumColumns() +1; $i++ )
					array_push($resultArray,$pSQL->GetData($i));
			}
		}
		
		return $resultArray;
	}
	
	public function GetTableArray()
	{
		return $this->tableArray;
	}
}

?>