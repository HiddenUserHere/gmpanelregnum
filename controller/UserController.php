<?php

class UserController extends Controller
{
	public function index()
	{
		UI::ShowError('The access request is invalid!');
	}
	
	//Editing User
	public function EditUser()
	{
		$userid = Request::get('edituser');
		$this->setModel('EditUserModel');
		$this->EditUserModel->SetUser($userid);
		
		$this->view->set('title','Edit User');
		$this->view->set('description','You are editing the account '.$userid.'');
		$this->view->set('userid',$userid);
		
		//Basic Informations
		$this->view->set('bstate', $this->EditUserModel->GetUserIsOnline());
		$this->view->set('usrtype',$this->EditUserModel->GetUserType());
		$this->view->set('active',$this->EditUserModel->GetUserIsActive());
		$this->view->set('warnlevel',$this->EditUserModel->GetUserWarningLevel());
		$this->view->set('votepoints',$this->EditUserModel->GetUserVotePoints());
		$this->view->set('credits',$this->EditUserModel->GetUserCredits());
		$this->view->set('flagban',$this->EditUserModel->GetUserIsBanned());
		
		//About User
		$this->view->set('email',$this->EditUserModel->GetUserEmail());
		$this->view->set('regisday',$this->EditUserModel->GetUserRegisteredDay());
		$this->view->set('passwd',$this->EditUserModel->GetUserPassword());
		$this->view->set('lastip',$this->EditUserModel->GetLatestAccountIP($userid));
		$this->view->set('localization',$this->EditUserModel->GetLocalizationIP($this->EditUserModel->GetLatestAccountIP($userid)));
		
		//Characters List
		$listCharacters = array();
		$this->view->bind('listchrs',$listCharacters);
		
		$listCharacters = $this->EditUserModel->GetUserCharacters();
		
		//GameMaster Logs
		$gmLogs = array();
		$this->view->bind('gmLogs',$gmLogs);		
		$gmLogs = $this->EditUserModel->GetGameMasterLogs();

		//Account Logs
		$accountLogs = array();
		$this->view->bind('accountLogs',$accountLogs);		
		$accountLogs = $this->EditUserModel->GetAccountLogs();

		//Cheat Logs
		$cheatLogs = array();
		$this->view->bind('cheatLogs',$cheatLogs);		
		$cheatLogs = $this->EditUserModel->GetCheatLogs();
		
		//Password Logs
		$passwdLogs = array();
		$this->view->bind('passwdLogs',$passwdLogs);		
		$passwdLogs = $this->EditUserModel->GetChangePasswordLogs();
		
		//Email Logs
		$emailLogs = array();
		$this->view->bind('emailLogs',$emailLogs);		
		$emailLogs = $this->EditUserModel->GetChangeEmailLogs();

		//Notifications
		$notificationLogs = array();
		$this->view->bind('notificationLogs', $notificationLogs);
		$notificationLogs = $this->EditUserModel->GetAccountNotification();
		
		//Render View
		$this->view->render('EditUser');
	}
	
	//Search User
	public function Search()
	{
		$str = Request::get('search');
		
		if( $str == '' )
		{
			$this->view->set('title','Search User');
			$this->view->set('description','');
			
			//Render View
			$this->view->render('SearchUser');
		}
		else
		{
			//Render Results
			include 'SearchResult.php';
		}
	}
	
	//Character Info
	public function CharacterInfo()
	{
		$this->view->set('title','Character Info');
		$this->view->set('description',Request::get('characterinfo'));
		
		//Render View
		$this->view->render('CharacterInfo',FALSE);
	}
	
	//Ban User
	public function Ban()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->SetBanUser(Request::getForm('banreason'), Request::getForm('bantype'), Request::getForm('unbandate'));
		}
	}
	
	//Change Name User
	public function ChangeAccountName()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->ChangeAccountName(Request::getForm('accname'));
		}
	}
	//Change Email User
	public function ChangeEmailName()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->SetEmailUser(Request::getForm('emailname'));
		}
	}
	
	//Change GM User
	public function ChangeGameMaster()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->SetGameMasterLevel(Request::getForm('gmlevel'));
		}
	}
	
	//Change Password
	public function ChangePassword()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->SetAccountPassword();
		}
	}
	
	//Notification
	public function NewNotification()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$userid = Request::get('edituser');
			$this->setModel('EditUserModel');
			$this->EditUserModel->SetUser($userid);
			
			$this->EditUser();
			$this->EditUserModel->SetAccountNotification();
		}
	}
	
	//Active User
	public function Active()
	{
		$userid = Request::get('edituser');
		$this->setModel('EditUserModel');
		$this->EditUserModel->SetUser($userid);
		
		$this->EditUser();
		$this->EditUserModel->SetActiveUser();
	}
	
	//Save Character Data
	public function Save()
	{
		$characterName = Request::get('characterinfo');
		
		$this->setModel('EditCharacterModel');
		$this->view->set('title','Character Info');
		$this->view->set('description',$characterName);

		//Render View
		$this->view->render('CharacterInfo',FALSE);
		
		if( Request::getFormCount() > 0 )
		{
			$this->EditCharacterModel->SetCharacterName($characterName);
			$this->EditCharacterModel->SaveCharacterData();
		}
		else
			UI::RedirectPage('?page=user&characterinfo='.$this->characterName.'',1);
	}

	public function UpdatePremium()
	{
		$characterName = Request::get('characterinfo');
		
		$this->setModel('EditCharacterModel');
		$this->view->set('title','Character Info');
		$this->view->set('description',$characterName);

		//Render View
		$this->view->render('CharacterInfo',FALSE);
		
		if( Request::getFormCount() > 0 )
		{
			$this->EditCharacterModel->SetCharacterName($characterName);
			$this->EditCharacterModel->UpdateItemPremium($characterName,Request::getForm('itemtype'),Request::getForm('itemid'),Request::getForm('timeleft'),Request::getForm('timetotal'),Request::get('type'),Request::get('id'),Request::get('left'),Request::get('total'));
		}
		else
			UI::RedirectPage('?page=user&characterinfo='.$this->characterName.'',1);
	}

	public function InsertPremium()
	{
		$characterName = Request::get('characterinfo');
		
		$this->setModel('EditCharacterModel');
		$this->view->set('title','Character Info');
		$this->view->set('description',$characterName);

		//Render View
		$this->view->render('CharacterInfo',FALSE);
		
		if( Request::getFormCount() > 0 )
		{
			$this->EditCharacterModel->SetCharacterName($characterName);

			$timeleft = 0;
			if( empty(Request::getForm('timeleft')))
				$timeleft = Request::getForm('timetotal');
			else
				$timeleft = Request::getForm('timeleft');

			$this->EditCharacterModel->InsertItemPremium($characterName,Request::getForm('itemtype'),Request::getForm('itemid'),$timeleft,Request::getForm('timetotal'));
		}
		else
			UI::RedirectPage('?page=user&characterinfo='.$this->characterName.'',1);
	}

	public function Delete()
	{
		$characterName = Request::get('characterinfo');
		
		$this->setModel('EditCharacterModel');
		$this->view->set('title','Character Info');
		$this->view->set('description',$characterName);

		//Render View
		$this->view->render('CharacterInfo',FALSE);
		
		$this->EditCharacterModel->SetCharacterName($characterName);
		$this->EditCharacterModel->DeleteItemPremium($characterName,Request::get('type'),Request::get('id'),Request::get('left'),Request::get('total'));
	}
	
	//Users Online
	public function UsersOnline()
	{
		$this->view->set('title','Users Online');
		$this->view->set('description','');
		
		$this->setModel('EditUserModel');
		
		$listUserson = array();
		$this->view->bind('listuseron',$listUserson);
		
		$listUserson = $this->EditUserModel->GetUsersOnlineList();
			
		//Render View
		$this->view->render('UsersOnline');
	}
	
	//Add Credits
	public function AddCredits()
	{
		$this->view->set('title','Add Credits');
		$this->view->set('description','');
		
		$this->setModel('EditUserModel');
		
		$logs = array();
		$this->view->bind('logs',$logs);
		
		$logs = $this->EditUserModel->GetLogsCredits();
		
		if( Request::getFormCount() > 0 )
			$this->EditUserModel->AddCreditToAccount();
		
		//Render View
		$this->view->render('AddCredits');
	}

	public function PostBox()
	{
		$this->view->set('title','Add Credits');
		$this->view->set('description','');
		
		$this->setModel('EditUserModel');
		
		if( Request::getFormCount() > 0 )
			$this->EditUserModel->SendItemToAccount();
		
		//Render View
		$this->view->render('AddCredits');
	}
}

?>