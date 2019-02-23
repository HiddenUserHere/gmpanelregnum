<?php

class CoinController extends Controller
{
	public function index()
	{
		UI::ShowError('The access request is invalid!');
	}
	
	public function ItemList()
	{
		$this->view->set('title','Edit Coin Shop');
		$this->view->set('description','');
		$this->setModel('CoinModel');

		//Item List
		$listTabs = array();
		$listItems = array();
		$this->view->bind('listtabs',$listTabs);
		$this->view->bind('listitems',$listItems);
		
		$listTabs = $this->CoinModel->GetTabs();
		$listItems = $this->CoinModel->GetListItems();

		//Render View
		$this->view->render('CoinItemList');
	}
	
	public function EditItem()
	{
		$this->view->set('title','Edit Coin Shop');
		$this->view->set('description','Back to Item List');
		$this->setModel('CoinModel');

		//Item List
		$listTabs = array();
		$this->view->bind('listtabs',$listTabs);
		
		$itemInfo = array();
		$this->view->bind('iteminfo',$itemInfo);
		
		$listTabs = $this->CoinModel->GetTabs();
		$itemInfo = $this->CoinModel->GetItem(Request::get('edititem'));

		//Render View
		$this->view->render('CoinEditItem');
	}
	
	public function EditTab()
	{
		$this->view->set('title','Edit Coin Shop');
		$this->view->set('description','Back to Tab List');
		$this->setModel('CoinModel');

		//Tab Info
		$tabInfo = array();
		$this->view->bind('tabinfo',$tabInfo);
		
		$this->view->bind('listtabs',$listTabs);
		
		$listTabs = $this->CoinModel->GetTabs();
		
		$tabInfo = $this->CoinModel->GetTab(Request::get('edittab'));

		//Render View
		$this->view->render('CoinEditTab');
	}
	
	public function AddItem()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('CoinModel');
			$this->CoinModel->AddItem();
		}
		
		$this->ItemList();
	}
	
	public function AddTab()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('CoinModel');
			$this->CoinModel->AddTab();
		}
		
		$this->Tab();
	}
	
	public function SaveItem()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('CoinModel');
			$this->CoinModel->SaveItem(Request::get('saveitem'));
		}
		
		$this->ItemList();
	}
	
	public function SaveTab()
	{
		//Handler Form
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('CoinModel');
			$this->CoinModel->SaveTab(Request::get('savetab'));
		}
		
		$this->ItemList();
	}
	
	public function DelItem()
	{
		$this->setModel('CoinModel');
		$this->CoinModel->DeleteItem(Request::get('delitem'));
		
		$this->ItemList();
	}
	
	public function DelTab()
	{
		$this->setModel('CoinModel');
		$this->CoinModel->DeleteTab(Request::get('deltab'));
		
		$this->Tab();
	}
	
	public function Tab()
	{
		$this->view->set('title','Edit Coin Shop');
		$this->view->set('description','');
		$this->setModel('CoinModel');

		//Item List
		$listTabs = array();
		$this->view->bind('listtabs',$listTabs);
		
		$listTabs = $this->CoinModel->GetTabs();

		//Render View
		$this->view->render('CoinTabs');
	}
}

?>