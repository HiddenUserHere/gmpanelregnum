<?php

class WebSiteController extends Controller
{
	public function index()
	{
		UI::ShowError('The access request is invalid!');
	}
	
	//List All Notices
	public function ListNotices()
	{
		$this->view->set('title','Edit Notices');
		$this->view->set('description','');
		$this->setModel('WebSiteModel');
		
		//Characters List
		$listNotices = array();
		$this->view->bind('listnotices',$listNotices);
		
		$listNotices = $this->WebSiteModel->GetListNotices();
		
		//Render View
		$this->view->render('ListNotices');
	}
	
	//List All Pages from WebSite
	public function ListQuests()
	{
		$this->view->set('title','Edit Quests');
		$this->view->set('description','');
		$this->setModel('WebSiteModel');
		
		//Characters List
		$listQuests = array();
		$this->view->bind('listquests',$listQuests);
		
		$listQuests = $this->WebSiteModel->GetListQuests();
		
		//Render View
		$this->view->render('ListQuests');
	}
	
	//Delete Notice
	public function DelNotice()
	{
		$this->setModel('WebSiteModel');
		$this->WebSiteModel->DeleteNotice(Request::get('delnotice'));
		
		$this->ListNotices();
	}

	//Delete Quest
	public function DelQuest()
	{
		$this->setModel('WebSiteModel');
		$this->WebSiteModel->DeleteQuest(Request::get('delquest'));
		
		$this->ListQuests();
	}
	
	//Add Notice
	public function AddNotice()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('WebSiteModel');
			$this->WebSiteModel->InsertNotice();
		}
		
		$this->ListNotices();
	}

	//Add Quest
	public function AddQuest()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('WebSiteModel');
			$this->WebSiteModel->InsertQuest();
		}
		
		$this->ListQuests();
	}
	
	//Edit Notice
	public function EditNotice()
	{
		$this->view->set('title','Edit Notice');
		$this->view->set('description','<a href="?page=website&listnotices">Back to List Notices</a>');
		$this->setModel('WebSiteModel');
		
		//Get Notice Info
		$noticeInfo = array();
		$this->view->bind('noticeinfo',$noticeInfo);
		
		$noticeInfo = $this->WebSiteModel->GetNotice(Request::get('editnotice'));
		
		if( Request::getFormCount() > 0 )
		{
			$this->WebSiteModel->EditNotice(Request::get('editnotice'));
		}
		
		//Render View
		$this->view->render('EditNotice');
	}
}

?>