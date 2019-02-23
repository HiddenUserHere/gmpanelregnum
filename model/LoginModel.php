<?php

class LoginModel extends Model
{
	public function LogUserPanel($account,$password,$ip,$accesslevel,$token)
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB',TRUE);
		
		if ( $pSQL->Prepare("INSERT INTO GameMasterLogin (Account,Password,IP,AccessLevel,Token,Date) VALUES (?,?,?,?,?,GETDATE())") )
		{
			$pSQL->Execute(array($account,$password,$ip,$accesslevel,$token));
		}
	}

	public function SaveToken($account)
	{
		$token = md5(uniqid());
		Request::setSession('token',$token);

		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB',TRUE);

		if( $pSQL->Prepare("DELETE FROM GameMasterSession WHERE Account=?") )
		{
			$pSQL->Execute(array($account));
		}
		
		if ( $pSQL->Prepare("INSERT INTO GameMasterSession (Account,Token) VALUES (?,?)") )
		{
			$pSQL->Execute(array($account,$token));
		}
	}

	public function HandleLogout($account)
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('WebDB',TRUE);

		if( $pSQL->Prepare("DELETE FROM GameMasterSession WHERE Account=?") )
		{
			$pSQL->Execute(array($account));
		}

		Request::deleteSession('account');
		Request::deleteSession('token');
	}
	
	public function HandleLogin( $userid, $password )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB',TRUE);
		
		//Find for GameMaster Account Data in SQL
		if( $pSQL->Prepare('SELECT * FROM GameMaster WHERE (AccountName=?) AND (Password=?)'))
		{
			$pSQL->Execute(array($userid,$password));

			//Results was found?
			if( $pSQL->GetRecordCount() > 0 )
			{
				Request::setSession('account',$userid);
				Request::setSession('level',$pSQL->GetData('AccessLevel'));

				$this->SaveToken($userid);
				$this->LogUserPanel($userid,$password,$this->GetClientIP(),4,Request::getSession('token'));

				UI::ShowSuccess('Login successful! We are redirecting you...');
				UI::RedirectPage('?page=Login',2);
			}
			else
			{
				UI::ShowError('Account Invalid. Try again!');
				UI::RedirectPage('?page=Login',2);
			}
		}
	}
}

?>