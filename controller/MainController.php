<?php

class MainController extends Controller
{
	public function index()
	{
		$this->setModel('MainModel');
		
		$this->view->set('title','Dashboard');
		$this->view->set('description','Version 2.0');
		$this->view->set('userson',$this->MainModel->GetUsersOnline());
		$this->view->set('accountsregistred',$this->MainModel->GetUsersRegistered());
		$this->view->set('totaltickets',$this->MainModel->GetCountTickets());
		$this->view->set('totalnewusers',$this->MainModel->GetTotalNewUsers());
		
		//New Users
		$listNewUsers = array();
		$this->view->bind('listnewusers',$listNewUsers);
		$listNewUsers = $this->MainModel->GetListNewUsers();

		$caixaAmount = 0.0;
		$this->view->bind('caixaAmount',$caixaAmount);
		$caixaAmount = $this->MainModel->GetAmountCaixaLogs();
		
		$dolarValue = 0.0;
		$this->view->bind('dolarValue',$dolarValue);
		$dolarValue = $this->MainModel->GetDolar();
		
		$this->view->render('Main');
	}
}

?>