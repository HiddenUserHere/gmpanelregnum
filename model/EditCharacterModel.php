<?php


class EditCharacterModel extends Model
{
	private $characterName;

	private function GetEXPTable()
	{
		$EXPTable = array(
			[0, 0, 0],
[1000, 0, 1000],
[2500, 0, 2500],
[5000, 0, 5000],
[9500, 0, 9500],
[17100, 0, 17100],
[29925, 0, 29925],
[51471, 0, 51471],
[87500, 0, 87500],
[140001, 0, 140001],
[212801, 0, 212801],
[306434, 0, 306434],
[416750, 0, 416750],
[537608, 0, 537608],
[672010, 0, 672010],
[833293, 0, 833293],
[1024950, 0, 1024950],
[1250439, 0, 1250439],
[1515533, 0, 1515533],
[1824702, 0, 1824702],
[2182343, 0, 2182343],
[2592624, 0, 2592624],
[3059296, 0, 3059296],
[3591614, 0, 3591614],
[4195005, 0, 4195005],
[4874596, 0, 4874596],
[5635033, 0, 5635033],
[6480288, 0, 6480288],
[7413449, 0, 7413449],
[8443919, 0, 8443919],
[9575404, 0, 9575404],
[10820207, 0, 10820207],
[12194373, 0, 12194373],
[13706475, 0, 13706475],
[15378665, 0, 15378665],
[17224105, 0, 17224105],
[19273774, 0, 19273774],
[21548079, 0, 21548079],
[24069204, 0, 24069204],
[26861232, 0, 26861232],
[29950274, 0, 29950274],
[33364605, 0, 33364605],
[37134805, 0, 37134805],
[41293904, 0, 41293904],
[45836233, 0, 45836233],
[50878219, 0, 50878219],
[56474823, 0, 56474823],
[62687054, 0, 62687054],
[69582630, 0, 69582630],
[77236719, 0, 77236719],
[85809995, 0, 85809995],
[95334904, 0, 95334904],
[105917079, 0, 105917079],
[117673875, 0, 117673875],
[130735675, 0, 130735675],
[145312702, 0, 145312702],
[161515069, 0, 161515069],
[179523999, 0, 179523999],
[199540925, 0, 199540925],
[221789738, 0, 221789738],
[246630189, 0, 246630189],
[274252770, 0, 274252770],
[304969080, 0, 304969080],
[339125617, 0, 339125617],
[377107687, 0, 377107687],
[419532302, 0, 419532302],
[466729685, 0, 466729685],
[519236775, 0, 519236775],
[577650912, 0, 577650912],
[642636640, 0, 642636640],
[715254581, 0, 715254581],
[796078348, 0, 796078348],
[886035202, 0, 886035202],
[986157179, 0, 986157179],
[1097592941, 0, 1097592941],
[1222169740, 0, 1222169740],
[1360886005, 0, 1360886005],
[1515346567, 0, 1515346567],
[1687338402, 0, 1687338402],
[1878851311, 0, 1878851311],
[2104313468, 0, 2104313468],
[-1938136212, 0, 2356831084],
[-1655316481, 0, 2639650815],
[-1338558384, 0, 2956408912],
[-983789314, 0, 3311177982],
[-586447956, 0, 3708519340],
[-141425635, 0, 4153541661],
[356999364, 1, 4651966660],
[915235363, 1, 5210202659],
[1957275895, 1, 6252243191],
[-1087242763, 1, 7502691829],
[413295603, 2, 9003230195],
[-2081025654, 2, 10803876234],
[79749593, 3, 12964651481],
[-1622287406, 3, 15557581778],
[1489228950, 4, 18669098134],
[928081280, 5, 22402917760],
[1113697537, 6, 26883501313],
[-2099536793, 7, 32260201575],
[57536226, 9, 38712241890],
[-789949988, 10, 46454690268],
[-88946526, 12, 55745628322],
[-1824722749, 15, 66894753987],
[-1330673840, 18, 80273704784],
[1839165229, 22, 96328445741],
[-369982102, 26, 115594134890],
[1274008396, 32, 138712961868],
[-1048170303, 38, 166455554241],
[-2116797822, 46, 199746665090],
[-822170468, 55, 239695998108],
[-127611103, 66, 287635197729],
[1564853595, 80, 345162237275],
[1877824314, 96, 414194684730],
[-1182584660, 115, 497033621676],
[-560108132, 138, 596440346012],
[-1531123218, 166, 715728415214],
[-119360943, 199, 858874098257],
[-143233132, 239, 1030648917908],
[-171879758, 287, 1236778701490],
[-1924242628, 345, 1484134441788],
[-1450097694, 414, 1780961330146],
[-1740117233, 497, 2137153596175],
[488839698, 597, 2564584315410],
[-1990372740, 716, 3077501178492],
[-670460370, 859, 3693001414190],
[-804552444, 1031, 4431601697028],
[752523986, 1238, 5317922036434],
[-814958135, 1485, 6381506443721],
[-118956303, 1782, 7657807732465],
[-1860734482, 2139, 9189369278958],
[2062085918, 2567, 11027243134750],
[-102477276, 3080, 13232691761700],
[736020728, 3697, 15879230114040],
[-1693755504, 4436, 19055076136848],
[-314519686, 5323, 22866091364218],
[-1236417082, 6388, 27439309637062],
[1952273338, 7666, 32927171564474],
[-1093245831, 9199, 39512605877369],
[-1311894997, 11039, 47415127052843],
[-1574273996, 13247, 56898152463412],
[-1017016392, 15786, 67803631685560]
			);
		return $EXPTable;
	}

	public function GetEXPByPercent($lvl, $percent)
	{
		if ($lvl <= 140 && $lvl > 0 && $percent != 0)
		{
			$expcur 	= $this->GetEXPTable()[$lvl-1][2];
			$expnext 	= $this->GetEXPTable()[$lvl][2];
			$exp 		= (($expnext - $expcur) * $percent) / 100;
			return ($exp+$expcur);

		}
		return 0;
	}
	
	public function GetPercentByEXP($lvl, $expp)
	{
		if ($lvl <= 140 && $lvl > 0)
		{
			$expn 		= $this->GetEXPTable()[$lvl-1][2];
			$expcur 	= $expp - $expn;
			$expnext 	= $this->GetEXPTable()[$lvl][2] - $expn;
			if ($expnext == 0)
				return 0;

			$percent 	= ($expcur * 100) / $expnext;
			return $percent;
		}
		return 0;
	}

	public function GetLowI64($i)
	{
		$i = ($i & 0xFFFFFFFF);
		return $i;
	}

	public function GetHighI64($i)
	{
		$i = $i >> 32;
		return $i;
	}
	
	public function SetCharacterName($str)
	{
		$this->characterName = $str;
	}
	
	public function SaveCharacterData()
	{
		//Open Character Data
		$pHex = new HEX();
		$pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$this->characterName.'.chr');

		$bReset = FALSE;
		$bNewNick = FALSE;
		
		//Get Variables
		$bodymodel = Request::getForm('bodymodel');
		$headmodel = Request::getForm('headmodel');
		$money = Request::getForm('money');
		$rankup = Request::getForm('rankup');
		$class = Request::getForm('chclass');
		$chname = Request::getForm('chname');
		$chlvl = Request::getForm('chlvl');
		
		//Verify if is to Reset
		if( $pHex->getInt(0xC4) != $class || $pHex->getInt(0x184) != $rankup )
			$bReset = TRUE;
			
		if( $chname != $pHex->getString(0x10,0x20) )
			$bNewNick = TRUE;
		
		//Save Character Data
		$pHex->writeString(0x30,$bodymodel,0x40);
		$pHex->writeString(0x70,$headmodel,0x3C);
		$pHex->writeInt(0x154,$money);
		$pHex->writeInt(0x184,$rankup);
		
		if ( $pHex->getInt(0xC4) != $class )
		{
			$this->ChangeCharacterClass($chname, $pHex->getInt(0xC4), $class);
			$pHex->writeInt(0xC4,$class);
		}

		if ( $pHex->getInt(0xC8) != $chlvl )
		{
			$pHex->writeInt(0xC8,$chlvl);
			$pHex->writeInt(0x14C, $this->GetEXPTable()[$chlvl-1][0]);
			$pHex->writeInt(0x194, $this->GetEXPTable()[$chlvl-1][1]);
			$exp = $this->GetEXPTable()[$chlvl-1][2];

			$pSQL = new SQL();
			$pSQL->CreateConnection('UserDB');

			if( $pSQL->Prepare('UPDATE CharacterInfo SET [Level]=?, [Experience]=? WHERE Name=?') )
				$pSQL->Execute(array($chlvl, $exp, $this->characterName));
		}

		$pHex->closeFile();
		
		if( $bReset )
		{
			$this->ResetCharacterHead($this->characterName);
			$this->ResetCharacterStats($this->characterName);
		}

		UI::ShowSuccess('The character data has been updated!');
		
		if( $bNewNick )
		{
			if( $this->ChangeCharacterName($this->characterName,$chname) )
				UI::RedirectPage('?page=user&characterinfo='.$chname.'',1);
			else
				UI::RedirectPage('?page=user&characterinfo='.$this->characterName.'',1);
		}
		else
			UI::RedirectPage('?page=user&characterinfo='.$this->characterName.'',1);
	}
	
	public function GetRaceNum($class)
	{
		if ( $class == 1 || $class == 2 || $class == 3 || $class == 4 || $class == 9 )
			return 1;
		
		return 2;
	}
	
	public function ChangeCharacterClass( $chname, $class, $nclass )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		$pSQL2 = new SQL();
		$pSQL2->CreateConnection('GameDB');
		
		$qr1 = 'QuestRace'.$this->GetRaceNum($nclass);
		$qr2 = 'QuestRace'.$this->GetRaceNum($class);
		
		if ( $pSQL2->Prepare('SELECT '.$qr1.', '.$qr2.' FROM QuestSwapList') )
		{		
			$pSQL2->Execute();
			
			while( $pSQL2->Fetch() )
			{
				if ( $pSQL->Prepare('UPDATE CharacterQuest2 SET QuestID=? WHERE (CharacterName=?) AND (QuestID=?)') )
				{
					$pSQL->Execute(array($pSQL2->GetData($qr1), $chname, $pSQL2->GetData($qr2)));
				}
			}
		}
	}

	public function UpdateItemPremium( $chname, $type, $id, $left, $total, $oldtype, $oldid, $oldleft, $oldtotal )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');

		if( $pSQL->Prepare('UPDATE CharacterItemTimer SET ItemTimerType=?,ItemID=?,TimeLeft=?,TimeTotal=? WHERE CharacterName=? AND ItemTimerType=? AND ItemID=? AND TimeLeft=? AND TimeTotal=?'))
		{
			$pSQL->Execute(array($type,$id,$left,$total,$chname,$oldtype,$oldid,$oldleft,$oldtotal));

			UI::ShowSuccess('The Item Premium has been updated!');
			UI::RedirectPage('?page=user&characterinfo='.$chname,1);
		}
	}

	public function InsertItemPremium( $chname, $type, $id, $left, $total )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');

		if( $pSQL->Prepare('INSERT INTO CharacterItemTimer VALUES(?,?,?,?,?)'))
		{
			$pSQL->Execute(array($chname,$type,$id,$left,$total));

			UI::ShowSuccess('The Item Premium has been inserted!');
			UI::RedirectPage('?page=user&characterinfo='.$chname,1);
		}
	}

	public function DeleteItemPremium( $chname, $type, $id, $left, $total )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');

		if( $pSQL->Prepare('DELETE FROM CharacterItemTimer WHERE CharacterName=? AND ItemTimerType=? AND ItemID=? AND TimeLeft=? AND TimeTotal=?'))
		{
			$pSQL->Execute(array($chname,$type,$id,$left,$total));

			UI::ShowSuccess('The Item Premium has been deleted!');
			UI::RedirectPage('?page=user&characterinfo='.$chname,1);
		}
	}
}

?>