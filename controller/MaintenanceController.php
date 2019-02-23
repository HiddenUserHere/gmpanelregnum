<?php

class MaintenanceController extends Controller
{
	public function index()
	{
		$this->setModel('MaintenanceModel');
		
		$this->view->set('title','Maintenance');
		$this->view->set('description','');

		$this->view->set('status',$this->MaintenanceModel->GetServerStatus());

		//Server Info
		$info = array();
		$this->view->bind('info',$info);
		$info = $this->MaintenanceModel->GetServerInfo();

		//Messages Login
		$alogin = array();
		$this->view->bind('alogin',$alogin);
		$alogin = $this->MaintenanceModel->GetMessagesLogin();

		//Maintenance Login
		$mlogin = array();
		$this->view->bind('mlogin',$mlogin);
		$mlogin = $this->MaintenanceModel->GetMaintenanceLogin();
		
		$this->view->render('Maintenance');
	}

	public function SetMaint()
	{
		$this->setModel('MaintenanceModel');
		$this->MaintenanceModel->UpdateServerStatus();

		$this->index();
	}

	public function UpdateMsgLogin()
	{
		$this->setModel('MaintenanceModel');

		if( Request::getFormCount() > 0 )
			$this->MaintenanceModel->UpdateMessageLogin( Request::getForm('id'), Request::getForm('message') );

		$this->index();
	}

	public function UpdateLogin()
	{
		$this->setModel('MaintenanceModel');

		if( Request::getFormCount() > 0 )
			$this->MaintenanceModel->UpdateMaintenaceLogin( Request::getForm('id'), Request::getForm('mode'), Request::getForm('ip'), Request::getForm('name'));

		$this->index();
	}

	public function InsertLogin()
	{
		$this->setModel('MaintenanceModel');

		if( Request::getFormCount() > 0 )
			$this->MaintenanceModel->InsertMaintenanceLogin( Request::getForm('mode'), Request::getForm('ip'), Request::getForm('name'));

		$this->index();
	}

	public function InsertMsgLogin()
	{
		$this->setModel('MaintenanceModel');

		if( Request::getFormCount() > 0 )
			$this->MaintenanceModel->InsertMessageLogin( Request::getForm('message') );

		$this->index();
	}

	public function DeleteLogin()
	{
		$this->setModel('MaintenanceModel');

		$this->MaintenanceModel->DeleteLogin( Request::get('deletelogin'));

		$this->index();
	}

	public function DeleteMsgLogin()
	{
		$this->setModel('MaintenanceModel');

		$this->MaintenanceModel->DeleteMessageLogin( Request::get('deletemsglogin'));

		$this->index();
	}
}

?>