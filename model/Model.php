<?php

class Model
{

	private static $apiUrl = "http://api.promasters.net.br/cotacao/v1/valores?moedas=USD&alt=json";
	private static $content;

	public static function CheckToken($account,$token) 
	{
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('WebDB');
		if( $pSQL->Prepare('SELECT Account FROM GameMasterSession WHERE Account=? AND Token=?'))
		{
			$pSQL->Execute(array($account,$token));

			if( $pSQL->GetRecordCount() > 0 )
				return true;
		}

		return false;
    }

	public function GetDateIntervalInt( $date1 )
	{
		$timestamp = $date1;
		
		$date = new DateTime();
		$match_date = new DateTime($date1);
		
		$interval = $date->diff($match_date);
		
		return $interval->format('%R%a');
	}

	public function GetLatestAccountIP( $account )
	{
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('LogDB');
		if( $pSQL->Prepare('SELECT IP FROM AccountLog WHERE AccountName=?'))
		{
			$pSQL->Execute(array($account));

			return $pSQL->GetData('IP');
		}

		return '';
	}

	public function GetLocalizationIP( $ip )
	{
		return '';
	}

	public function GetDolar()
	{

  		return '0';
	}
	
	public function GetClientIP()
	{
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public function GetDateIntervalStringToday( $date1 )
	{
		$timestamp = $date1;
		
		$date = new DateTime();
		$match_date = new DateTime($date1);
		
		$interval = $date->diff($match_date);
		$interval = $interval->format('%R%a');
		
		switch( $interval )
		{
			case -1:
				return 'Yesterday';
				break;
			case 0:
				return 'Today';
				break;
			case 1:
				return 'Tomorrow';
				break;
			default:
				$date = date_create($timestamp);
				return date_format($date,'d M');
				break;
		}
		
		return '';
	}
	
	public function GetTimeAgo($time)
	{
		$etime = time() - $time;
	
		if ($etime < 1)
		{
			return '0 seconds';
		}
	
		$a = array( 365 * 24 * 60 * 60  =>  'year',
					 30 * 24 * 60 * 60  =>  'month',
						  24 * 60 * 60  =>  'day',
							   60 * 60  =>  'hour',
									60  =>  'minute',
									 1  =>  'second'
					);
		$a_plural = array( 'year'   => 'years',
						   'month'  => 'months',
						   'day'    => 'days',
						   'hour'   => 'hours',
						   'minute' => 'minutes',
						   'second' => 'seconds'
					);
	
		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
			}
		}
	}
	
	public function ReplaceTags($str)
	{
		return str_replace(array('[aspaspt]','[barpt]','[dotpt]','[minuspt]'),array(chr(0x27),'/','.','-'),$str);
	}
	
	static public function GetAccountByNick( $nick )
	{
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('UserDB');
		if( $pSQL->Prepare('SELECT AccountName FROM CharacterInfo WHERE Name=?'))
		{
			$pSQL->Execute(array($nick));
			
			return $pSQL->GetData('AccountName');
		}
		
		return '';
	}
	
	public function GetCharacterClass( $nick )
	{
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('UserDB');
		if( $pSQL->Prepare('SELECT JobCode FROM CharacterInfo WHERE Name=?'))
		{
			$pSQL->Execute(array($nick));
			
			return $pSQL->GetData('JobCode');
		}
		
		return 0;
	}
	
	public function GetAccountIsGameMaster( $userid )
	{
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('UserDB');
		if( $pSQL->Prepare('SELECT GameMasterLevel FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			if( $pSQL->GetData('GameMasterLevel') > 0 )
				return TRUE;
		}
		
		return FALSE;
	}
	
	public function GetCharacterClassString( $nick )
	{
		$jobcode = 0;
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('UserDB');
		if( $pSQL->Prepare('SELECT JobCode FROM CharacterInfo WHERE Name=?'))
		{
			$pSQL->Execute(array($nick));
			
			$jobcode = $pSQL->GetData('JobCode');
		}
		
		return $this->GetClassString( $jobcode );
	}
	
	public function GetClassString( $class )
	{
		switch( $class )
		{
			case 0:
				return 'Undefined';
				break;
			case 1:
				return 'Fighter';
				break;
			case 2: 
				return 'Mechanician';
				break;
			case 3:
				return 'Archer';
				break;
			case 4:
				return 'Pikeman';
				break;
			case 5:
				return 'Atalanta';
				break;
			case 6:
				return 'Knight';
				break;
			case 7:
				return 'Magician';
				break;
			case 8:
				return 'Priestess';
				break;
			case 9:
				return 'Assassin';
				break;
			case 10:
				return 'Shaman';
				break;
			default:
				return 'Undefined';
				break;
		}
	}
	
	public function ClassFlagToCharacterClass( $flag )
	{
		//Fighter
		if( $flag == 2 )
			return 1;
		//Mech
		if( $flag == 1 )
			return 2;
		//Archer
		if( $flag == 4 )
			return 3;
		//Pikeman
		if( $flag == 3 )
			return 4;
		
		//Atalanta
		if( 0x00020000 & $flag )
			return 5;
		//Knight
		if( 0x00010000 & $flag )
			return 6;
		//Magician
		if( 0x00040000 & $flag )
			return 7;
		//Priestess
		if( 0x00030000 & $flag )
			return 8;
		//Assassin
		if( 0x00050100 & $flag )
			return 9;
		//Shaman
		if( 0x00050000 & $flag )
			return 10;
	
		return 0;
	}
	
	public function GetCharacterClanInfo( $nick )
	{
		$clanlist = array();
		$pSQL = new SQL();
		
		$pSQL->CreateConnection('UserDB');
		if( $pSQL->Prepare('SELECT ClanID FROM CharacterInfo WHERE Name=? AND ClanID > 0'))
		{
			$pSQL->Execute(array($nick));
			
			if( $pSQL->GetRecordCount() > 0 )
			{
				$clanid = $pSQL->GetData('ClanID');
				$pSQL->Free();
				
				$pSQL->CreateConnection('ClanDB');
				if( $pSQL->Prepare('SELECT * FROM ClanList WHERE ID=?'))
				{
					$pSQL->Execute(array($clanid));
					for ( $i = 1; $i < $pSQL->GetNumColumns() +1; $i++ )
					{
						array_push($clanlist,$pSQL->GetData($i));
					}
				}
			}
		}
		
		return $clanlist;
	}
	
	public function ResetCharacterHead( $nick )
	{
		$pHex = new HEX();
		$pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$nick.'.chr');
		
		$model = '';
		$class = $pHex->getInt(0xC4);
		
		$tier = '';
		switch ( $pHex->getInt(0x184) )
		{
			case 1:
				$tier = 'a';
				break;
			case 2:
				$tier = 'b';
				break;
			case 3:
				$tier = 'c';
				break;
			case 4:
				$tier = 'd';
				break;
		}
		
		switch ( $class )
		{
			case 1:
				$model = "char\\tmABCD\\tmh-b02".$tier.".inf"; 
				break;
			case 2:
				$model = "char\\tmABCD\\tmh-a02".$tier.".inf"; 
				break;
			case 3:
				$model = "char\\tmABCD\\tfh-D01".$tier.".inf"; 
				break;
			case 4:
				$model = "char\\tmABCD\\tmh-c02".$tier.".inf";
				break;
			case 5:
				$model = "char\\tmABCD\\Mfh-B02".$tier.".inf";
				break;
			case 6:
				$model = "char\\tmABCD\\Mmh-A03".$tier.".inf";
				break;
			case 7:
				$model = "char\\tmABCD\\Mmh-D01".$tier.".inf";
				break;
			case 8:
				$model = "char\\tmABCD\\Mfh-C01".$tier.".inf";
				break;
			case 9:
				$model = "char\\tmABCD\\tfh-e01".$tier.".inf";
				break;
			case 10:
				$model = "char\\tmABCD\\Mmh-E01".$tier.".inf";
				break;
		}
		
		$pHex->writeString(0x70,$model,0x40);
		$pHex->closeFile();
	}
	
	public function ResetCharacterStats( $nick )
	{
		$pHex = new HEX();
		$pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$nick.'.chr');
		
		$class = $pHex->getInt(0xC4);
		
		switch ( $class )
		{
			case 1:
				$pHex->writeInt(0xCC,26);
				$pHex->writeInt(0xD0,6);
				$pHex->writeInt(0xD4,21);
				$pHex->writeInt(0xD8,17);
				$pHex->writeInt(0xDC,27);
				break;
			case 2:
				$pHex->writeInt(0xCC,24);
				$pHex->writeInt(0xD0,8);
				$pHex->writeInt(0xD4,25);
				$pHex->writeInt(0xD8,18);
				$pHex->writeInt(0xDC,24);
				break;
			case 3:
				$pHex->writeInt(0xCC,17);
				$pHex->writeInt(0xD0,11);
				$pHex->writeInt(0xD4,21);
				$pHex->writeInt(0xD8,27);
				$pHex->writeInt(0xDC,23);
				break;
			case 4:
				$pHex->writeInt(0xCC,26);
				$pHex->writeInt(0xD0,9);
				$pHex->writeInt(0xD4,20);
				$pHex->writeInt(0xD8,19);
				$pHex->writeInt(0xDC,25);
				break;
			case 5:
				$pHex->writeInt(0xCC,23);
				$pHex->writeInt(0xD0,15);
				$pHex->writeInt(0xD4,19);
				$pHex->writeInt(0xD8,19);
				$pHex->writeInt(0xDC,23);
				break;
			case 6:
				$pHex->writeInt(0xCC,26);
				$pHex->writeInt(0xD0,13);
				$pHex->writeInt(0xD4,17);
				$pHex->writeInt(0xD8,19);
				$pHex->writeInt(0xDC,24);
				break;
			case 7:
				$pHex->writeInt(0xCC,16);
				$pHex->writeInt(0xD0,29);
				$pHex->writeInt(0xD4,19);
				$pHex->writeInt(0xD8,14);
				$pHex->writeInt(0xDC,21);
				break;
			case 8:
				$pHex->writeInt(0xCC,15);
				$pHex->writeInt(0xD0,28);
				$pHex->writeInt(0xD4,21);
				$pHex->writeInt(0xD8,15);
				$pHex->writeInt(0xDC,20);
				break;
			case 9:
				$pHex->writeInt(0xCC,25);
				$pHex->writeInt(0xD0,10);
				$pHex->writeInt(0xD4,22);
				$pHex->writeInt(0xD8,20);
				$pHex->writeInt(0xDC,22);
				break;
			case 10:
				$pHex->writeInt(0xCC,15);
				$pHex->writeInt(0xD0,27);
				$pHex->writeInt(0xD4,20);
				$pHex->writeInt(0xD8,15);
				$pHex->writeInt(0xDC,22);
				break;
		}
		
		$pHex->closeFile();
	}
	
	public function ChangeCharacterName( $old, $new )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM CharacterInfo WHERE Name=?'))
			$pSQL->Execute(array($new));
			
		if( $pSQL->GetRecordCount() > 0 )
		{
			UI::ShowError('This nick already exists, try again!');
			return FALSE;
		}
		
		//Edit Character Name in dat
		$pHex = new HEX();
		$pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$old.'.chr');
		$pHex->writeString(0x10,$new,0x20);
		$pHex->closeFile();
		
		//Rename File
		rename(DIR_SERVER.'Login\\Data\\Character\\'.$old.'.chr',DIR_SERVER.'Login\\Data\\Character\\'.$new.'.chr');
		
		//Change Name in SQL
		if( $pSQL->Prepare('UPDATE CharacterInfo SET Name=? WHERE Name=?'))
			$pSQL->Execute(array($new,$old));
			
		//Updates SQL
		if( $pSQL->Prepare('UPDATE CharacterItemTimer SET CharacterName=? WHERE CharacterName=?'))
			$pSQL->Execute(array($new,$old));
			
		if( $pSQL->Prepare('UPDATE CharacterPvP SET CharacterName=? WHERE CharacterName=?'))
			$pSQL->Execute(array($new,$old));
			
		if( $pSQL->Prepare('UPDATE CharacterQuest SET CharacterName=? WHERE CharacterName=?'))
			$pSQL->Execute(array($new,$old));
	
		return TRUE;
	}
	
	public function GetItemInfo( $data )
	{
		$itemInfo = array();
		
		$pHex = new HEX();
		$pHex->readData($data);
		
		$elements = array( 
			'Name' => $pHex->getString(0x1C,0x20),
			'AttackPower' => $pHex->getShort(0x64) ? $pHex->getShort(0x64).'-'.$pHex->getShort(0x66) : '',
			'AttackSpeed' => $pHex->getInt(0x6C) ? $pHex->getInt(0x6C) : '',
			'Range' => $pHex->getInt(0x68) ? $pHex->getInt(0x68) : '',
			'Critical' => $pHex->getInt(0x74) ? $pHex->getInt(0x74).'%' : '',
			'Defense' => $pHex->getInt(0x7C) ? $pHex->getInt(0x7C) : '',
			'AttackRating' => $pHex->getInt(0x70) ? $pHex->getInt(0x70) : '',
			'Absorb' => $pHex->getFloat(0x78) ? sprintf('%.1f',$pHex->getFloat(0x78)) : '',
			'Block' => $pHex->getFloat(0x80) ? sprintf('%.1f%%',$pHex->getFloat(0x80)) : '',
			'MovementSpeed' => $pHex->getFloat(0x84) ? sprintf('%.1f',$pHex->getFloat(0x84)) : '',
			'MPRecovery' => $pHex->getShort(0xC0) ? $pHex->getShort(0xC0).'-'.$pHex->getShort(0xC2) : '',
			'HPRecovery' => $pHex->getShort(0xC4) ? $pHex->getShort(0xC4).'-'.$pHex->getShort(0xC6) : '',
			'SPRecovery' => $pHex->getShort(0xC8) ? $pHex->getShort(0xC8).'-'.$pHex->getShort(0xCA) : '',
			'Organic' => $pHex->getInt(0x4C) ? $pHex->getShort(0x4C) : '',
			'Fire' => $pHex->getInt(0x50) ? $pHex->getShort(0x50) : '',
			'Frost' => $pHex->getInt(0x52) ? $pHex->getShort(0x52) : '',
			'Lightning' => $pHex->getInt(0x54) ? $pHex->getShort(0x54) : '',
			'Poison' => $pHex->getInt(0x56) ? $pHex->getShort(0x56) : '',
			'HPRegen' => $pHex->getFloat(0x94) ? sprintf('%.1f',$pHex->getFloat(0x94)) : '',
			'MPRegen' => $pHex->getFloat(0x90) ? sprintf('%.1f',$pHex->getFloat(0x90)) : '',
			'SPRegen' => $pHex->getFloat(0x98) ? sprintf('%.1f',$pHex->getFloat(0x98)) : '',
			'AddHP' => $pHex->getFloat(0x9C) ? sprintf('%.0f',$pHex->getFloat(0x9C)) : '',
			'AddMP' => $pHex->getFloat(0xA0) ? sprintf('%.0f',$pHex->getFloat(0xA0)) : '',
			'AddSP' => $pHex->getFloat(0xA4) ? sprintf('%.0f',$pHex->getFloat(0xA4)) : '',
			'PotCount' => $pHex->getInt(0x88) ? $pHex->getInt(0x88) : '',
			'ReqLevel' => $pHex->getInt(0xA8) ? $pHex->getInt(0xA8) : '',
			'ReqStrenght' => $pHex->getInt(0xAC) ? $pHex->getInt(0xAC) : '',
			'ReqSpirit' => $pHex->getInt(0xB0) ? $pHex->getInt(0xB0) : '',
			'ReqTalent' => $pHex->getInt(0xB4) ? $pHex->getInt(0xB4) : '',
			'ReqAgility' => $pHex->getInt(0xB8) ? $pHex->getInt(0xB8) : '',
			'ReqHealth' => $pHex->getInt(0xBC) ? $pHex->getInt(0xBC) : '',
			'Spec' => $pHex->getDword(0xF4) ? $this->GetClassString($this->ClassFlagToCharacterClass($pHex->getDword(0xF4))) : '',
		);
		
		array_push( $itemInfo, $elements );
		
		return $itemInfo;
	}
	
	public function GetUsersOnlineList()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM UsersOnline'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$clan = $this->GetCharacterClanInfo($pSQL->GetData(2));
				
				$elements = array( $pSQL->GetData(1), $pSQL->GetData(2), $pSQL->GetData(3), $pSQL->GetData(4), $pSQL->GetData(5), $pSQL->GetData(7), $clan );
				array_push($list,$elements);
			}
		}
		
		return $list;
	}

}

?>