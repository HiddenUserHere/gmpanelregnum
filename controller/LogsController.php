<?php

class LogsController extends Controller
{
	public function index()
	{
		UI::ShowError('The access request is invalid!');
	}
	
	public function Search()
	{
		$this->setModel('LogsModel');
		
		$this->view->set('title','Search Logs');
		$this->view->set('description','');
		
		$showResults = false;
		$this->view->bind('showr',$showResults);
		
		$itemLog = false;
		$this->view->bind('itemlog',$itemLog);
		
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$showResults = true;
			
			//Get Logs result
			$listLogs = array();
			$this->view->bind('listlogs',$listLogs);
			
			//If is Item Log
			if( Request::getForm('category') == 'Item' )	
				$itemLog = true;
			
			$listLogs = $this->LogsModel->GetLogs();
			
			//Get table Head Names
			$tableName = array();
			$this->view->bind('tablename',$tableName);
			
			$tableName = $this->LogsModel->GetTableArray();
		}
		
		//Render View
		$this->view->render('SearchLogs');	
	}
}

?>