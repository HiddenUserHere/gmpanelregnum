<?php

class GameModel extends Model
{
	public function GetAgingList()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM AgeList ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				array_push($list,array($pSQL->GetData(2),$pSQL->GetData(3),$pSQL->GetData(4),$pSQL->GetData(5),$pSQL->GetData(6),$pSQL->GetData(7),$pSQL->GetData(8)));
			}
			
			return $list;
		}
	}
	
	public function SetAgingList()
	{
		$agecount = 0;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM AgeList'))
		{
			$pSQL->Execute();
			$agecount = $pSQL->GetRecordCount();
			
			for ($i = 1; $i <= $agecount; $i++)
			{
				if( $pSQL->Prepare('UPDATE AgeList SET FailChance=?,Plus2Chance=?,Minus2Chance=?,Minus1Chance=?,BrokenChance=?,AgeStone=? WHERE AgeNumber=?'))
				{
					$pSQL->Execute(array(Request::getForm('failch'.$i),Request::getForm('2ch'.$i),Request::getForm('m2ch'.$i),Request::getForm('m1ch'.$i),Request::getForm('bch'.$i),Request::getForm('agest'.$i),$i));
					
				UI::ShowSuccess('The Aging List has been updated!');
				}
			}
		}
		
		UI::RedirectPage('?page=game&aginglist',1);
	}

	
	public function GetDropList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM DropList'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$elements = array($pSQL->GetData('ID'),$pSQL->GetData('MonsterName'),$pSQL->GetData('PublicDrop'),$pSQL->GetData('Quantity')); 
				array_push($list,$elements);
			}
			
			return $list;
		}
		
		return 0;
	}

	public function GetMapList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM MapList ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$elements = array(
					$pSQL->GetData('ID'),					//0
					$pSQL->GetData('Name'),					//1
					$pSQL->GetData('ShortName'),			//2
					$pSQL->GetData('TypeMap'),				//3
					$pSQL->GetData('LevelReq'),				//4
					$pSQL->GetData('Pvp'),					//5
					$pSQL->GetData('StageFile'),			//6
					); 
				array_push($list,$elements);
			}
			
			return $list;
		}
		
		return 0;
	}

	public function GetQuestList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM QuestList ORDER BY MinLevel ASC'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$elements = array(
					$pSQL->GetData('ID'),					//0
					$pSQL->GetData('Name'),					//1
					$pSQL->GetData('ShortDescription'),		//2
					$pSQL->GetData('Description'),			//3
					$pSQL->GetData('ProgressText'),			//4
					$pSQL->GetData('ConclusionText'),		//5
					$pSQL->GetData('Party'),				//6
					$pSQL->GetData('Multiple'),				//7
					$pSQL->GetData('PVP'),					//8
					$pSQL->GetData('MinLevel'),				//9
					$pSQL->GetData('MaxLevel'),				//10
					$pSQL->GetData('MaxDuration'),			//11
					$pSQL->GetData('DurationType'),			//12
					$pSQL->GetData('MapID'),				//13
					$pSQL->GetData('MonsterID'),			//14
					$pSQL->GetData('RequiredItems'),		//15
					$pSQL->GetData('QuestType'),			//16
					$pSQL->GetData('RequiredQuestIDs'),		//17
					$pSQL->GetData('InclusionQuestIDs'),	//18
					$pSQL->GetData('NPCID'),				//19
					$pSQL->GetData('ProgressNPCID'),		//20
					$pSQL->GetData('ConclusionNPCID'),		//21
					$pSQL->GetData('AutoStartQuestID'),		//22
					$pSQL->GetData('ClassRestriction'),		//23
					$pSQL->GetData('AreaType'),				//24
					$pSQL->GetData('MinX'),					//25
					$pSQL->GetData('MaxX'),					//26
					$pSQL->GetData('MinZ'),					//27
					$pSQL->GetData('MaxZ'),					//28
					$pSQL->GetData('Radius')				//29
					); 
				array_push($list,$elements);
			}
			
			return $list;
		}
		
		return 0;
	}

	public function UpdateQuestList()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT ID FROM QuestList WHERE ID=?'))
		{
			$pSQL->Execute(array(Request::getForm('questid')));
			if ( $pSQL->Fetch() )
			{
				$pSQL->Free();

				//Update Existing Quest
				if( $pSQL->Prepare('UPDATE QuestList SET Name=?,ShortDescription=?,Description=?,ProgressText=?,ConclusionText=?,Party=?,Multiple=?,PVP=?,MinLevel=?,MaxLevel=?,MaxDuration=?,DurationType=?,MapID=?,MonsterID=?,RequiredItems=?,QuestType=?,RequiredQuestIDs=?,InclusionQuestIDs=?,NPCID=?,ProgressNPCID=?,ConclusionNPCID=?,AutoStartQuestID=?,ClassRestriction=?,AreaType=?,MinX=?,MaxX=?,MinZ=?,MaxZ=?,Radius=? WHERE ID=?'))
				{
					$pSQL->Execute(array(
					Request::getForm('name'),					//1
					Request::getForm('shortdescription'),		//2
					Request::getForm('description'),			//3
					Request::getForm('progresstext'),			//4
					Request::getForm('conclusiontext'),			//5
					Request::getForm('party'),					//6
					Request::getForm('multiple'),				//7
					Request::getForm('pvp'),					//8
					Request::getForm('minlevel'),				//9
					Request::getForm('maxlevel'),				//10
					Request::getForm('maxduration'),			//11
					Request::getForm('durationtype'),			//12
					Request::getForm('mapid'),					//13
					Request::getForm('monsterid'),				//14
					Request::getForm('requireditems'),			//15
					Request::getForm('questtype'),				//16
					Request::getForm('requiredquestids'),		//17
					Request::getForm('inclusionquestids'),		//18
					Request::getForm('npcid'),					//19
					Request::getForm('progressnpcid'),			//20
					Request::getForm('conclusionnpcid'),		//21
					Request::getForm('autostartquestid'),		//22
					Request::getForm('classrestriction'),		//23
					Request::getForm('areatype'),				//24
					Request::getForm('minx'),					//25
					Request::getForm('maxx'),					//26
					Request::getForm('minz'),					//27
					Request::getForm('maxz'),					//28
					Request::getForm('radius'),					//29
					Request::getForm('questid')					//0
						));
				}

				UI::ShowSuccess('The Quest has been updated!');
			}
			else
			{
				$pSQL->Free();

				if( $pSQL->Prepare('INSERT INTO QuestList(ID,Name,ShortDescription,Description,ProgressText,ConclusionText,Party,Multiple,PVP,MinLevel,MaxLevel,MaxDuration,DurationType,MapID,MonsterID,RequiredItems,QuestType,RequiredQuestIDs,InclusionQuestIDs,NPCID,ProgressNPCID,ConclusionNPCID,AutoStartQuestID,ClassRestriction,AreaType,MinX,MaxX,MinZ,MaxZ,Radius) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'))
				{
					$pSQL->Execute(array(
					Request::getForm('questid'),				//0
					Request::getForm('name'),					//1
					Request::getForm('shortdescription'),		//2
					Request::getForm('description'),			//3
					Request::getForm('progresstext'),			//4
					Request::getForm('conclusiontext'),			//5
					Request::getForm('party'),					//6
					Request::getForm('multiple'),				//7
					Request::getForm('pvp'),					//8
					Request::getForm('minlevel'),				//9
					Request::getForm('maxlevel'),				//10
					Request::getForm('maxduration'),			//11
					Request::getForm('durationtype'),			//12
					Request::getForm('mapid'),					//13
					Request::getForm('monsterid'),				//14
					Request::getForm('requireditems'),			//15
					Request::getForm('questtype'),				//16
					Request::getForm('requiredquestids'),		//17
					Request::getForm('inclusionquestids'),		//18
					Request::getForm('npcid'),					//19
					Request::getForm('progressnpcid'),			//20
					Request::getForm('conclusionnpcid'),		//21
					Request::getForm('autostartquestid'),		//22
					Request::getForm('classrestriction'),		//23
					Request::getForm('areatype'),				//24
					Request::getForm('minx'),					//25
					Request::getForm('maxx'),					//26
					Request::getForm('minz'),					//27
					Request::getForm('maxz'),					//28
					Request::getForm('radius')					//29
						));

					UI::ShowSuccess('The Quest has been insertted!');
				}			
			}
		}

		UI::RedirectPage('?page=game&questlist',1);
	}

	public function GetQuestRewardList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM QuestRewardList ORDER BY QuestID ASC'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$elements = array(
					$pSQL->GetData('ID'),						//0
					$pSQL->GetData('QuestID'),					//1
					$pSQL->GetData('Name'),						//2
					$pSQL->GetData('MonsterQuantities'),		//3
					$pSQL->GetData('RequiredDropQuantities'),	//4
					$pSQL->GetData('EXPReward'),				//5
					$pSQL->GetData('EXPPotBonus'),				//6
					$pSQL->GetData('EXPLevelDifference'),		//7
					$pSQL->GetData('ItemRewardSelect'),			//8
					$pSQL->GetData('ItemsReward'),				//9
					$pSQL->GetData('ItemsRewardQuantities'),	//10
					$pSQL->GetData('ExtraRewardType'),			//11
					$pSQL->GetData('ExtraRewardValues'),		//12
					$pSQL->GetData('TimeMultiplier'),			//13
					); 
				array_push($list,$elements);
			}
			
			return $list;
		}
		
		return 0;
	}


	public function GetLastQuestListID()
	{
		$ID = 0;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT TOP 1 ID FROM QuestList ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			if( $pSQL->Fetch() )
			{
				$ID = $pSQL->GetData('ID');
			}
			
			return $ID;
		}
		
		return 0;
	}

	public function GetLastQuestRewardListID()
	{
		$ID = 0;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT TOP 1 ID FROM QuestRewardList ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			if( $pSQL->Fetch() )
			{
				$ID = $pSQL->GetData('ID');
			}
			
			return $ID;
		}
		
		return 0;
	}

	public function GetMonsterIDList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT Name, MonsterID FROM MonsterList WHERE (MonsterID != 0) ORDER BY Level ASC'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$elements = array(
					$pSQL->GetData('Name'),					//0
					$pSQL->GetData('MonsterID'),			//1
					
					); 
				array_push($list,$elements);
			}
			
			return $list;
		}
		
		return 0;
	}

	public function GetNPCIDList()
	{
		$list = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		$pSQL2 = new SQL();
		$pSQL2->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT IDNPC, Stage FROM MapNPC WHERE (Enabled = 1) ORDER BY Stage ASC'))
		{
			$pSQL->Execute();
			
			while( $pSQL->Fetch() )
			{
				$ID = $pSQL->GetData('IDNPC');
				$MapID = $pSQL->GetData('Stage');

				if( $pSQL2->Prepare('SELECT Name FROM NPCList WHERE ID=?'))
				{
					$pSQL2->Execute(array($ID));

					if ( $pSQL2->Fetch() )
					{

						$elements = array(
							$ID,
							$pSQL2->GetData('Name'),				//0		
							$MapID					
							); 
						array_push($list,$elements);
					}
				}
			}
			
			return $list;
		}
		
		return 0;
	}
}

?>