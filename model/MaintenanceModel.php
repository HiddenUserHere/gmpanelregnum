<?php

class MaintenanceModel extends Model
{
	public function GetServerInfo()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT COUNT(*) FROM UserInfo'))
		{
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));
			
			$pSQL->Prepare('SELECT COUNT(*) FROM UserInfo WHERE Banned=1');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM CharacterInfo');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->CloseConnection();
			
			$pSQL->CreateConnection('LogDB');
			$pSQL->Prepare('SELECT COUNT(*) FROM AccountLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM CharacterLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM CheatLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM CoinLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM FuryArenaLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM GameMasterLogs');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));

			$pSQL->Prepare('SELECT COUNT(*) FROM WarehouseLog');
			$pSQL->Execute();		
			array_push($list,$pSQL->GetData(1));
		}

		return $list;
	}

	public function GetServerStatus()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		$bMaintMode = 0;
		
		if( $pSQL->Prepare('SELECT IP FROM Maintenance WHERE ID=2'))
		{
			$pSQL->Execute();

			$bMaintMode = $pSQL->GetData(1);
		}

		return $bMaintMode;
	}

	public function GetMessagesLogin()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		$list = array();

		if( $pSQL->Prepare('SELECT * FROM MessageLogin'))
		{
			$pSQL->Execute();

			while( $pSQL->Fetch() )
			{
				$array = array($pSQL->GetData('ID'),$pSQL->GetData('Message'));
				array_push( $list, $array );
			}
		}

		return $list;
	}

	public function GetMaintenanceLogin()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		$list = array();

		if( $pSQL->Prepare('SELECT * FROM Maintenance WHERE ID!=2'))
		{
			$pSQL->Execute();

			while( $pSQL->Fetch() )
			{
				$array = array($pSQL->GetData('Mode'),$pSQL->GetData('IP'),$pSQL->GetData('Corno'),$pSQL->GetData('ID'));
				array_push( $list, $array );
			}
		}

		return $list;
	}

	public function UpdateServerStatus()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		$bMaintMode = 0;
		
		if( $pSQL->Prepare('SELECT IP FROM Maintenance WHERE ID=2'))
		{
			$pSQL->Execute();

			$bMaintMode = $pSQL->GetData(1);

			if( $bMaintMode == 1 )
			{
				$pSQL->Prepare('UPDATE Maintenance SET IP=0 WHERE ID=2');
				$pSQL->Execute();

				UI::RedirectPage('?page=maintenance',1);
			}
			else
			{
				$pSQL->Prepare('UPDATE Maintenance SET IP=1 WHERE ID=2');
				$pSQL->Execute();

				UI::RedirectPage('?page=maintenance',1);
			}
		}
	}

	public function UpdateMaintenaceLogin( $id, $mode, $ip, $name )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('UPDATE Maintenance SET Mode=?,IP=?,Corno=? WHERE ID=?'))
		{
			$pSQL->Execute(array($mode,$ip,$name,$id));

			UI::ShowSuccess('The data has been updated!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}

	public function UpdateMessageLogin( $id, $message )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('UPDATE MessageLogin SET Message=? WHERE ID=?'))
		{
			$pSQL->Execute(array($message,$id));

			UI::ShowSuccess('The announcement has been updated!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}


	public function InsertMaintenanceLogin( $mode, $ip, $name )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('INSERT INTO Maintenance (Mode,IP,Corno) VALUES (?,?,?)'))
		{
			$pSQL->Execute(array($mode,$ip,$name));

			UI::ShowSuccess('The data has been inserted!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}

	public function InsertMessageLogin( $message )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('INSERT INTO MessageLogin (Message) VALUES (?)'))
		{
			$pSQL->Execute(array($message));

			UI::ShowSuccess('The announcement has been inserted!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}

	public function DeleteLogin( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('DELETE FROM Maintenance WHERE ID=?'))
		{
			$pSQL->Execute(array($id));

			UI::ShowSuccess('The data has been deleted!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}

	public function DeleteMessageLogin( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');

		if( $pSQL->Prepare('DELETE FROM MessageLogin WHERE ID=?'))
		{
			$pSQL->Execute(array($id));

			UI::ShowSuccess('The announcement has been deleted!');
			UI::RedirectPage('?page=maintenance',1);
		}
	}
}

?>