<?php

class CoinModel extends Model
{
	public function GetTabs()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CoinShopTab ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$elements = array( $pSQL->GetData('ID'), $pSQL->GetData('Name'), $pSQL->GetData('CoinShopID'),$pSQL->GetData('ParentID'),$pSQL->GetData('Discount'),$pSQL->GetData('Bulk'), $pSQL->GetData('MaxBulk'), $pSQL->GetData('ListOrder') );
				array_push($list,$elements);
			}
			
			$pSQL->Free();
			$pSQL->CloseConnection();
			
			return $list;
		}
	}
	
	public function AddItem()
	{
		if( Request::getForm('itemname') == '' || Request::getForm('description') == '' )
		{
			UI::ShowError('Fill the all fields to add item!');
			return;
		}
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('INSERT INTO CoinShopItem (TabID,Name,Description,Code,Image,Value,Discount,[Bulk],MaxBulk,IsSpec,IsQuantity,Disabled,ListOrder) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)'))
		{
			$pSQL->Execute(array(Request::getForm('tab'),Request::getForm('itemname'),Request::getForm('description'),Request::getForm('itemcode'),Request::getForm('imgpath'),Request::getForm('price'),Request::getForm('discount'),Request::getForm('bulk'),Request::getForm('maxbulk'),Request::getForm('spec'),Request::getForm('quantity'),Request::getForm('disabled'),Request::getForm('order')));
			UI::ShowSuccess('The item has been added with success!');
		}
	}
	
	public function AddTab()
	{
		if( Request::getForm('tabname') == '' || Request::getForm('csid') == '' )
		{
			UI::ShowError('Fill the all fields to add item!');
			return;
		}
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('INSERT INTO CoinShopTab (CoinShopID,Name,ParentID,Discount,[Bulk],MaxBulk,ListOrder) VALUES (?,?,?,?,?,?,?)'))
		{
			$pSQL->Execute(array(Request::getForm('csid'),Request::getForm('tabname'),Request::getForm('pid'),Request::getForm('discount'),Request::getForm('bulk'),Request::getForm('maxbulk'),Request::getForm('listorder')));
			UI::ShowSuccess('The tab has been added with success!');
		}
	}
	
	public function SaveItem($id)
	{		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('UPDATE CoinShopItem SET TabID=?,Name=?,Description=?,Code=?,Image=?,Value=?,Discount=?,[Bulk]=?,MaxBulk=?,IsSpec=?,IsQuantity=?,Disabled=?,ListOrder=? WHERE ID=?'))
		{
			$pSQL->Execute(array(Request::getForm('tab'),Request::getForm('itemname'),Request::getForm('description'),Request::getForm('itemcode'),Request::getForm('imgpath'),Request::getForm('price'),Request::getForm('discount'),Request::getForm('bulk'),Request::getForm('maxbulk'),Request::getForm('spec'),Request::getForm('quantity'),Request::getForm('disabled'),Request::getForm('order'),$id));
			UI::ShowSuccess('The item has been edited with success!');
		}
	}
	
	public function SaveTab($id)
	{		
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('UPDATE CoinShopTab SET CoinShopID=?,Name=?,ParentID=?,Discount=?,[Bulk]=?,MaxBulk=?,ListOrder=? WHERE ID=?'))
		{
			$pSQL->Execute(array(Request::getForm('csid'),Request::getForm('tabname'),Request::getForm('pid'),Request::getForm('discount'),Request::getForm('bulk'),Request::getForm('maxbulk'),Request::getForm('listorder'),$id));
			UI::ShowSuccess('The tab has been edited with success!');
		}
	}
	
	public function GetTabByID( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT * FROM CoinShopTab WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			
			return $pSQL->GetData('Name');
		}
		
		return ''; 
	}
	
	public function GetItem( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CoinShopItem WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			
			while( $pSQL->Fetch() )
			{
				$list = array( $pSQL->GetData('ID'), $pSQL->GetData('TabID'), $pSQL->GetData('Name'),$pSQL->GetData('Description'),$pSQL->GetData('Code'),$pSQL->GetData('Image'),$pSQL->GetData('Value'),$pSQL->GetData('Discount'),$pSQL->GetData('Bulk'),$pSQL->GetData('MaxBulk'),$pSQL->GetData('IsSpec'),$pSQL->GetData('IsQuantity'),$pSQL->GetData('Disabled'),$pSQL->GetData('ListOrder') );
			}
			
			$pSQL->Free();
			$pSQL->CloseConnection();
			
			return $list;
		}
		
		return ''; 
	}
	
	public function GetTab( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CoinShopTab WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			
			while( $pSQL->Fetch() )
			{
				$list = array( $pSQL->GetData('ID'), $pSQL->GetData('CoinShopID'), $pSQL->GetData('Name'),$pSQL->GetData('ParentID'),$pSQL->GetData('Discount'),$pSQL->GetData('Bulk'),$pSQL->GetData('MaxBulk'),$pSQL->GetData('ListOrder') );
			}
			
			$pSQL->Free();
			$pSQL->CloseConnection();
			
			return $list;
		}
		
		return ''; 
	}
	
	public function DeleteItem( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT ID FROM CoinShopItem WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			
			if( $pSQL->GetRecordCount() > 0 )
			{
				if( $pSQL->Prepare('DELETE FROM CoinShopItem WHERE ID=?'))
					$pSQL->Execute(array($id));
					
				UI::ShowSuccess('The item has been deleted with success!');
			}
		}
		
		UI::RedirectPage('?page=coin&itemlist',1);
	}
	
	public function DeleteTab( $id )
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		if( $pSQL->Prepare('SELECT ID FROM CoinShopTab WHERE ID=?'))
		{
			$pSQL->Execute(array($id));
			
			if( $pSQL->GetRecordCount() > 0 )
			{
				if( $pSQL->Prepare('DELETE FROM CoinShopTab WHERE ID=?'))
					$pSQL->Execute(array($id));
					
				UI::ShowSuccess('The tab has been deleted with success!');
			}
		}
		
		UI::RedirectPage('?page=coin&tab',1);
	}
	
	public function GetListItems()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CoinShopItem ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$elements = array( $pSQL->GetData('ID'), $pSQL->GetData('Name'), $this->GetTabByID($pSQL->GetData('TabID')),$pSQL->GetData('Disabled') );
				array_push($list,$elements);
			}
			
			return $list;
		}	
	}
	public function GetListCoinShop()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('GameDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT * FROM CoinShop WHERE Active=1 ORDER BY ID ASC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$elements = array( $pSQL->GetData('ID'), $pSQL->GetData('Name'), $pSQL->GetData('Message'), $pSQL->GetData('Discount') );
				array_push($list,$elements);
			}
			
			return $list;
		}	
	}
}

?>