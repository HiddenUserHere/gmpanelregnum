<?php

class WebSiteModel extends Model
{
	public function GetListNotices()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM LatestNews ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$type = '';
				switch( $pSQL->GetData('Type') )
				{
					case 0:
						$type = 'Notice';
						break;
					case 1:
						$type = 'Event';
						break;	
					case 2:
						$type = 'Patch Log';
						break;	
					case 3:
						$type = 'Maintenance';
						break;
				}
				
				$elements = array( $pSQL->GetData('ID'), $pSQL->GetData('Title'), $pSQL->GetData('Date'), $type );
				array_push($list,$elements);
			}
			
			return $list;
		}	
	}

	public function GetListQuests()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM Quests ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$elements = array( $pSQL->GetData('ID'), $pSQL->GetData('QuestName'), $pSQL->GetData('ReqLevel') );
				array_push($list,$elements);
			}
			
			return $list;
		}	
	}
	
	public function DeleteNotice($noticeid)
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('SELECT ID FROM LatestNews WHERE ID=?'))
		{
			$pSQL->Execute(array($noticeid));
			
			if( $pSQL->GetRecordCount() > 0 )
			{
				if( $pSQL->Prepare('DELETE FROM LatestNews WHERE ID=?'))
					$pSQL->Execute(array($noticeid));
					
				UI::ShowSuccess('The notice has been deleted with success!');
			}
		}
		
		UI::RedirectPage('?page=website&listnotices',1);
	}

	public function DeleteQuest($questid)
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('SELECT ID FROM Quests WHERE ID=?'))
		{
			$pSQL->Execute(array($questid));
			
			if( $pSQL->GetRecordCount() > 0 )
			{
				if( $pSQL->Prepare('DELETE FROM Quests WHERE ID=?'))
					$pSQL->Execute(array($questid));
					
				UI::ShowSuccess('The quest has been deleted with success!');
			}
		}
		
		UI::RedirectPage('?page=website&listquests',1);
	}
	
	public function InsertNotice()
	{
		if( Request::getForm('title') == '' || Request::getForm('message') == '' )
		{
			UI::ShowError('Fill the all fields to insert a notice!');
			return;
		}
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('INSERT INTO LatestNews (Title,Message,Date,Type) VALUES (?,?,?,?)'))
		{
			$date = date('m/d/Y');
			
			$pSQL->Execute(array(Request::getForm('title'),Request::getForm('message'),$date,Request::getForm('category')));
			UI::ShowSuccess('The notice has been added with success!');
		}
		
		UI::RedirectPage('?page=website&listnotices',1);
	}

	public function InsertQuest()
	{
		if( Request::getForm('title') == '' || Request::getForm('description') == '' )
		{
			UI::ShowError('Fill the all fields to insert a notice!');
			return;
		}
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('INSERT INTO Quests (QuestName,ReqLevel,ReqQuests,QuestReward,Description,Exclusive, QuestType) VALUES (?,?,?,?,?,?,?)'))
		{
			$pSQL->Execute(array(Request::getForm('title'),Request::getForm('questlevel'),'None',Request::getForm('reward'),Request::getForm('description'),Request::getForm('exclusive'), Request::getForm('questtype')));
			UI::ShowSuccess('The quest has been added with success!');
		}
		
		UI::RedirectPage('?page=website&listquests',1);
	}
	
	public function GetNotice($id)
	{
		$noticeInfo = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('SELECT * FROM LatestNews WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			$noticeInfo = array($pSQL->GetData('ID'),$pSQL->GetData('Title'),$pSQL->GetData('Message'),$pSQL->GetData('Date'),$pSQL->GetData('Type'));
			return $noticeInfo;
		}
		
		return 0;
	}
	
	public function EditNotice($id)
	{
		if( Request::getForm('title') == '' || Request::getForm('message') == '' )
		{
			UI::ShowError('Fill the all fields to insert a notice!');
			return;
		}
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB');
		
		if( $pSQL->Prepare('UPDATE LatestNews SET Title=?,Message=?,Type=? WHERE ID=?'))
		{
			$pSQL->Execute(array(Request::getForm('title'),Request::getForm('message'),Request::getForm('category'),$id));
			UI::ShowSuccess('The notice has been updated with success!');
		}
		
		UI::RedirectPage('?page=website&editnotice='.$id.'',1);
	}
}

?>