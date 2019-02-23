<?php

class EditUserModel extends Model
{
	private $userid;
	
	public function SetUser( $userid )
	{
		$this->userid = $userid;
	}
	
	public function GetUserType()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT GameMasterLevel FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			if( $pSQL->GetData('GameMasterLevel') > 0 )
				return 'Game Master';
			else
				return 'Normal User';
		}
		
		return '';
	}
	
	public function GetUserIsActive()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Flag FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			$flag = $pSQL->GetData('Flag');
			
			if( ($flag & 2) == 2 )
				return 'True';
			else
				return 'False';
		}
		
		return '';
	}
	
	public function GetUserWarningLevel()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT WarningLevel FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('WarningLevel');
		}
		
		return '';
	}
	
	public function GetUserVotePoints()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT VotePoints FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('VotePoints');
		}
		
		return '';
	}
	
	public function GetUserCredits()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Coins FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('Coins');
		}
		
		return '';
	}
	
	public function GetUserEmail()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Email FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('Email');
		}
		
		return '';
	}
	
	public function GetUserPassword()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Password FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('Password');
		}
		
		return '';
	}
	
	public function GetUserRegisteredDay()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT RegisDay FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			return $pSQL->GetData('RegisDay');
		}
		
		return '';
	}
	
	public function GetUserIsBanned()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT BanStatus FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			$ban = $pSQL->GetData('BanStatus');
			
			if( ($ban == 1) || ($ban == 2) )
				return 'True';
			else
				return 'False';
		}
		
		return '';
	}
	
	public function GetUserIsOnline()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');
		
		if( $pSQL->Prepare('SELECT * FROM UsersOnline WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			if( $pSQL->GetRecordCount() > 0 )
				return TRUE;
		}
		
		return FALSE;
	}
	
	public function GetUserCharacters()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CharacterInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{		
				$claninfo = array();	
				$claninfo = $this->GetCharacterClanInfo($pSQL->GetData('Name'));	
				$clanicon = '';	
				$clanname = '';
				
				if( !empty($claninfo))
				{
					$clanicon = $claninfo[6];
					$clanname = $claninfo[1];
				}
				
				$elements = array('name' => $pSQL->GetData('Name'), 'classname' => $this->GetCharacterClassString($pSQL->GetData('Name')), 'class' => $this->GetCharacterClass($pSQL->GetData('Name')), 
				'icon' => $clanicon, 'clname' => $clanname, 'level' => $pSQL->GetData('Level'), 'exp' => $pSQL->GetData('Experience'), 
				'lastdate' => $pSQL->GetData('LastSeenDate'));
				array_push($list,$elements);
			
			}
			
			return $list;
		}
	}
	
	public function GetAccountLogs()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT TOP 1000 * FROM AccountLog WHERE AccountName=? ORDER BY ID DESC'))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{
				array_push($list,array($pSQL->GetData('IP'),$pSQL->GetData('LogID'),$pSQL->GetData('Description'),$pSQL->GetData('Date')));
			}
			
			return $list;
		}
	}

	public function GetCheatLogs()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT TOP 1000 * FROM CheatLog WHERE AccountName=? ORDER BY ID DESC'))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{
				array_push($list,array($pSQL->GetData('IP'),$pSQL->GetData('Action'),$pSQL->GetData('LogID'),$pSQL->GetData('Description'),$pSQL->GetData('Date')));
			}
			
			return $list;
		}
	}
	
	public function GetGameMasterLogs()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();

		$query = "SELECT TOP 1000 * FROM GameMasterLogs WHERE Description LIKE '%AccountName[[]".$userid."]%' ORDER BY ID DESC;";
		
		if( $pSQL->Prepare($query))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				array_push($list,array($pSQL->GetData('OperatorIP'),$pSQL->GetData('Description'),$pSQL->GetData('Date')));
			}
			
			return $list;
		}

		return $list;
	}
	
	public function GetChangeEmailLogs()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();

		$query = "SELECT TOP 1000 * FROM UserPanelLog WHERE (Type=2) AND (Value1=?) ORDER BY ID DESC;";
		
		if( $pSQL->Prepare($query))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{
				$v = 'No';
				
				if ( $pSQL->GetData('Value5') == 2 )
					$v = 'Yes';
				
				array_push($list,array($pSQL->GetData('Value1'),$pSQL->GetData('Value2'),$pSQL->GetData('Value3'),$v));
			}
			
			return $list;
		}

		return $list;
	}
	
	public function GetChangePasswordLogs()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();

		$query = "SELECT TOP 1000 * FROM UserPanelLog WHERE ((Type=20) OR (Type=1)) AND (Value1=?) ORDER BY ID DESC;";
		
		if( $pSQL->Prepare($query))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{
				$v = 'No';
				
				if ( $pSQL->GetData('Value5') == 2 )
					$v = 'Yes';
				
				array_push($list,array($pSQL->GetData('Value1'),$pSQL->GetData('Value2'),$pSQL->GetData('Value3'),$v));
			}
			
			return $list;
		}

		return $list;
	}
	
	public function GetAccountNotification()
	{
		$userid = $this->userid;
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$list = array();

		$query = "SELECT TOP 1000 * FROM NotificationData WHERE AccountName=? ORDER BY ID DESC;";
		
		if( $pSQL->Prepare($query))
		{
			$pSQL->Execute(array($userid));
			
			while ($pSQL->Fetch())
			{
				$v = 'No';
				
				if ( $pSQL->GetData('Checked') == 1 )
					$v = 'Yes';
				
				array_push($list,array($pSQL->GetData('AccountName'),$pSQL->GetData('Message'),$v, $pSQL->GetData('Date')));
			}
			
			return $list;
		}

		return $list;
	}
	
	public function SetBanUser( $reason, $bantype, $unbandate )
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT BanStatus FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			$ban = $pSQL->GetData('BanStatus');
			
			if( ($ban == 1) || ($ban == 2) )
			{
				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE UserInfo SET BanStatus=0, UnbanDate=NULL WHERE AccountName=?'))
					$pSQL->Execute(array($userid));	

				//Close SQL
				$pSQL->CloseConnection();

				//Write Log
				$pSQL->CreateConnection('LogDB');
				if( $pSQL->Prepare('INSERT INTO GameMasterLogs (OperatorIP,Description,Date) VALUES (?,?,?)'))
				{
					$ip = $this->GetClientIP();
					$description = 'Unbanned AccountName['.$userid.'] Reason['.$reason.']';
					$data = date('m/d/y H:i:s');

					$pSQL->Execute(array($ip,$description,$data)); 
				}
					
				UI::ShowSuccess('The account '.$userid.' has been unbanned with success!');
			}
			else
			{				
				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE UserInfo SET BanStatus=?,UnbanDate=CONVERT(datetime,\''.$unbandate.'\',101) WHERE AccountName=?'))
					$pSQL->Execute(array($bantype, $userid));	

				//Close SQL
				$pSQL->CloseConnection();

				//Write Log
				$pSQL->CreateConnection('LogDB');
				if( $pSQL->Prepare('INSERT INTO GameMasterLogs (OperatorIP,Description,Date) VALUES (?,?,?)'))
				{
					$ip = $this->GetClientIP();
					$description = 'Banned AccountName['.$userid.'] Reason['.$reason.'] UnbanDate['.$unbandate.']';
					$data = date('m/d/y H:i:s');

					$pSQL->Execute(array($ip,$description,$data)); 
				}
					
				UI::ShowSuccess('The account '.$userid.' has been banned with success!');
			}
		}
		
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function ChangeAccountName( $accname )
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT ID FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			if( $pSQL->GetData('ID') > 0 )
			{
				$pSQL->Free();
				if( $pSQL->Prepare('SELECT ID FROM UserInfo WHERE AccountName=?'))
					$pSQL->Execute(array($accname));

				if( $pSQL->GetData('ID') > 0 )
				{
					UI::ShowError('This account already exist. Try again!');
					return;
				}

				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE UserInfo SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));

				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE CharacterInfo SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	

				$pSQL->Free();
				if( $pSQL->Prepare('SELECT Name FROM CharacterInfo WHERE AccountName=?'))
				{
					$pSQL->Execute(array($accname));
					if( $pSQL->GetRecordCount() > 0 )
					{
						$pHex = new HEX();
						while ( $pSQL->Fetch() )
						{
							$name = $pSQL->GetData('Name');

							$pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$name.'.chr');
							$pHex->writeString(0x2C0,$accname,0x20);
						}
					}
				}


				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE CharacterInfoDelete SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	

				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE CharacterQuest SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	

				//Close SQL
				$pSQL->CloseConnection();
				$pSQL->CreateConnection('ClanDB');

				if( $pSQL->Prepare('UPDATE ClanList SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	

				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE BellatraTeamScore SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	


				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE BellatraPersonalScore SET AccountName=? WHERE AccountName=?'))
					$pSQL->Execute(array($accname, $userid));	

				$pSQL->CloseConnection();

				//Write Log
				$pSQL->CreateConnection('LogDB');
				if( $pSQL->Prepare('INSERT INTO GameMasterLogs (OperatorIP,Description,Date) VALUES (?,?,?)'))
				{
					$ip = $this->GetClientIP();
					$description = 'Change Account Name AccountName['.$userid.'] NewAccountName['.$accname.']';
					$data = date('m/d/y H:i:s');

					$pSQL->Execute(array($ip,$description,$data)); 
				}
					
				UI::ShowSuccess('The account '.$userid.' has been changed with success!');
			}
		}
		
		UI::RedirectPage('?page=user&edituser='.$accname.'',1);
	}
	
	public function SetActiveUser()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Flag FROM UserInfo WHERE AccountName=?'))
		{
			$pSQL->Execute(array($userid));
			
			$flag = $pSQL->GetData('Flag');
			
			if( ($flag & 2) == 2 )
			{
				$flag -= 2;
				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE UserInfo SET Flag=? WHERE AccountName=?'))
					$pSQL->Execute(array($flag, $userid));	
					
				UI::ShowSuccess('The account '.$userid.' has been deactivated with success!');
			}
			else
			{
				$flag |= 2;
				$pSQL->Free();
				if( $pSQL->Prepare('UPDATE UserInfo SET Flag=? WHERE AccountName=?'))
					$pSQL->Execute(array($flag, $userid));	
					
				UI::ShowSuccess('The account '.$userid.' has been activated with success!');
			}
		}
		
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function SetEmailUser()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('UPDATE UserInfo SET Email=? WHERE AccountName=?'))
			$pSQL->Execute(array(Request::getForm('emailname'),$userid));	
					
		UI::ShowSuccess('The account '.$userid.' has been changed email with success!');
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function SetGameMasterLevel()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$gmtype = 1;
		$gmlevel = Request::getForm('gmlevel');
		
		if ($gmlevel <= 1)
			$gmtype = 0;
		
		if( $pSQL->Prepare('UPDATE UserInfo SET GameMasterType=?, GameMasterLevel=? WHERE AccountName=?'))
			$pSQL->Execute(array($gmtype, $gmlevel, $userid));	
					
		UI::ShowSuccess('The account '.$userid.' has been changed GM Level with success!');
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function SetAccountPassword()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$pwuser = Request::getForm('pwuser');
		
		if ($gmlevel <= 1)
			$gmtype = 0;
		
		if( $pSQL->Prepare('UPDATE UserInfo SET Password=? WHERE AccountName=?'))
			$pSQL->Execute(array($pwuser, $userid));	
					
		UI::ShowSuccess('The account '.$userid.' has been changed Password with success!');
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function SetAccountNotification()
	{
		$userid = $this->userid;
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$notify = Request::getForm('notify');

		if( $pSQL->Prepare('INSERT INTO NotificationData([AccountName],[Message],[Checked],[Date]) VALUES(?,?,0, GETDATE())'))
			$pSQL->Execute(array($userid, $notify));	
					
		UI::ShowSuccess('The account '.$userid.' has been received a new notification with success!');
		UI::RedirectPage('?page=user&edituser='.$userid.'',1);
	}
	
	public function AddCreditToAccount()
	{
		$addto = Request::getForm('by');
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$coins = 0;

		switch( $addto )
		{
			case 1:
				if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE ID=?'))
				{
					$pSQL->Execute(array(Request::getForm('user')));
					
					if( $pSQL->GetRecordCount() == 0 )
					{
						UI::ShowError('This account not exist. Try again!');
						UI::RedirectPage('?page=user&addcredits',1);
						return;
					}
				}
					
				$userid = $pSQL->GetData('AccountName');
					
				$coins = $pSQL->GetData('Coins') + Request::getForm('value');
				
				if( $pSQL->Prepare('UPDATE UserInfo SET Coins=? WHERE ID=?'))
					$pSQL->Execute(array($coins,Request::getForm('user')));
					
				$pSQL->CreateConnection('LogDB');
				$log = 'Added Credits(ID['.Request::getForm('user').'] AccountName['.$userid.'] Coins['.Request::getForm('value').'] CoinAmount['.$coins.'])';
				if( $pSQL->Prepare('INSERT INTO CoinLog([AccountName],[Description],[Date]) VALUES (?,?,GETDATE())'))
					$pSQL->Execute(array($userid, $log));
					
				UI::ShowSuccess('The credits has been added! ID: '.Request::getForm('user').' AccountName: '.$userid.' Credits: '.$coins);
				UI::RedirectPage('?page=user&addcredits',1);					
				break;
			case 2:
				if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE AccountName=?'))
				{
					$pSQL->Execute(array(Request::getForm('user')));
					
					if( $pSQL->GetRecordCount() == 0 )
					{
						UI::ShowError('This account not exist. Try again!');
						UI::RedirectPage('?page=user&addcredits',1);
						return;
					}
				}
				
				$IDPT = $pSQL->GetData('ID');
					
				$coins = $pSQL->GetData('Coins') + Request::getForm('value');
				
				if( $pSQL->Prepare('UPDATE UserInfo SET Coins=? WHERE AccountName=?'))
					$pSQL->Execute(array($coins,Request::getForm('user')));
					
				$pSQL->CreateConnection('LogDB');
				$log = 'Added Credits(ID['.$IDPT.'] AccountName['.Request::getForm('user').'] Coins['.Request::getForm('value').'] CoinAmount['.$coins.'])';
				if( $pSQL->Prepare('INSERT INTO CoinLog([AccountName],[Description],[Date]) VALUES (?,?,GETDATE())'))
					$pSQL->Execute(array(Request::getForm('user'), $log));
					
					
				UI::ShowSuccess('The credits has been added! ID: '.$IDPT.' AccountName: '.Request::getForm('user').' Credits: '.$coins);
				UI::RedirectPage('?page=user&addcredits',1);
				break;
		}
	}
	
	public function GetLogsCredits()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT TOP 50 * FROM CoinLog WHERE Description LIKE ? ORDER BY Date DESC'))
		{
			$pSQL->Execute(array('%Added Credits(%'));
			
			while ($pSQL->Fetch())
			{
				array_push($list,array($pSQL->GetData('AccountName'),$pSQL->GetData('Description'),$pSQL->GetData('Date')));
			}
			
			return $list;
		}
	}
	
	public function SendItemToAccount()
	{
		$addto = Request::getForm('by');
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$coins = Request::getForm('credits');
		if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE (AccountName=?)'))
		{
			$pSQL->Execute(array(Request::getForm('user')));
			
			if( $pSQL->GetRecordCount() == 0 )
			{
				UI::ShowError('This account not exist. Try again!');
				UI::RedirectPage('?page=user&addcredits',1);
				return;
			}
			
			$coinsSQL = $pSQL->GetData('Coins');
			
			if ( $coinsSQL < $coins )
			{
				UI::ShowError('This account don\'t have sufficient credits! Credits: '.$coinsSQL.' Price: '.$coins);
				UI::RedirectPage('?page=user&addcredits',1);
				return;
			}
		}
		
		$ncoins = $coinsSQL - $coins;
		if( $pSQL->Prepare('UPDATE UserInfo SET Coins=? WHERE (AccountName=?)'))
			$pSQL->Execute(array($ncoins,Request::getForm('user')));
			
		$pSQL->CreateConnection('LogDB');
		
		$count = Request::getForm('itemcount');
		$itemname = strtoupper(Request::getForm('itemname'));
		$itemspec = Request::getForm('itemspec');
		$i = 0;
		
		
		// Potions??
		if ( $itemname[0] == 'P' && ($itemname[1] == 'M' || $itemname[1] == 'L' || $itemname[1] == 'S') )
		{
			if( $pSQL->Prepare('INSERT INTO ItemBox([AccountName],[ItemCode],[ItemSpec],[DateReceived]) VALUES (?,?,?,NULL)'))
				$pSQL->Execute(array(Request::getForm('user'), $itemname, 0));
		}
		else
		{
		
			for( $i = 0; $i < $count; $i++ )
			{
				if( $pSQL->Prepare('INSERT INTO ItemBox([AccountName],[ItemCode],[ItemSpec],[DateReceived]) VALUES (?,?,?,NULL)'))
					$pSQL->Execute(array(Request::getForm('user'), $itemname, $itemspec));
			}
		}
		
		$pSQL->CreateConnection('LogDB');
		$log = 'Send Item to ItemBox(AccountName['.Request::getForm('user').'] ItemCode['.$itemname.'] ItemSpec['.$itemspec.'] ItemCount['.$count.'] Coins['.$coins.'])';
		if( $pSQL->Prepare('INSERT INTO CoinLog([AccountName],[Description],[Date]) VALUES (?,?,GETDATE())'))
			$pSQL->Execute(array(Request::getForm('user'), $log));
		
		UI::ShowSuccess('The Item has been sent! Credits: '.$ncoins);
		UI::RedirectPage('?page=user&addcredits',1);
	}
}

?>