<?php

class SupportModel extends Model
{
	private $ticketID;
	
	public function GetCountOpenTickets()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM TicketList WHERE State=0') )
			$pSQL->Execute();
		
		return $pSQL->GetRecordCount();
	}
	
	public function GetListAllTickets()
	{
		$listTickets = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM TicketList ORDER BY ID DESC') )
			$pSQL->Execute();
		
		while( $pSQL->Fetch() )
		{
			$time = strtotime($pSQL->GetData(6));
			array_push($listTickets,array($pSQL->GetData(2),$pSQL->GetData(3),$pSQL->GetData(4),$pSQL->GetData(5),$this->GetTimeAgo($time),$pSQL->GetData(1)));
		}
		
		return $listTickets;
	}
	
	public function GetListOpenTickets()
	{
		$listTickets = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM TicketList WHERE State=0 ORDER BY ID DESC') )
			$pSQL->Execute();
		
		while( $pSQL->Fetch() )
		{
			array_push($listTickets,array($pSQL->GetData(2),$pSQL->GetData(3),$pSQL->GetData(4),$pSQL->GetData(5),$pSQL->GetData(6),$pSQL->GetData(1)));
		}
		
		return $listTickets;
	}
	
	public function GetListClosedTickets()
	{
		$listTickets = array();
		
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM TicketList WHERE State=1 ORDER BY ID DESC') )
			$pSQL->Execute();
		
		while( $pSQL->Fetch() )
		{
			array_push($listTickets,array($pSQL->GetData(2),$pSQL->GetData(3),$pSQL->GetData(4),$pSQL->GetData(5),$pSQL->GetData(6),$pSQL->GetData(1)));
		}
		
		return $listTickets;
	}
	
	public function SetTicketID($id)
	{
		$this->ticketID = $id;
	}
	
	public function GetSubjectTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Title FROM TicketList WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			return $pSQL->GetData('Title');
		}
			
		return '';
	}
	
	public function GetAuthorTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Author FROM TicketList WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			return $pSQL->GetData('Author');
		}
			
		return '';
	}
	
	public function GetDateTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Date FROM TicketList WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			$date = date_create($pSQL->GetData('Date'));
			return date_format($date,'d M. Y h:i A');
		}
		
		return '';
	}
	
	public function GetStateTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT State FROM TicketList WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			return $pSQL->GetData('State');
		}
			
		return '';
	}
	
	public function GetMessageTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Message FROM TicketData WHERE TicketID=? AND Type=0') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			$message = $this->ReplaceTags($pSQL->GetData('Message'));
			return $message;
		}	
		
		return '';
	}
	
	public function GetTypeTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT Type FROM TicketList WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			switch( $pSQL->GetData('Type') )
			{
				case 0:
					$type = 'Account';
					break;
				case 1:
					$type = 'Technical';
					break;
				case 2:
					$type = 'Lost & Found';
					break;
				case 3:
					$type = 'Report User';
					break;
				case 4:
					$type = 'Request Unban';
					break;
			}	
			
			return $type;
		}
			
		return '';
	}
	
	public function GetMessagesTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		$messages = array();
		
		if( $pSQL->Prepare('SELECT * FROM TicketData WHERE TicketID=? AND (Type=1 OR Type=2) ORDER BY ID ASC') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			while( $pSQL->Fetch() )
			{
				$time = strtotime($pSQL->GetData('Date'));
				
				if( $pSQL->GetData('Type') == 2 )
					array_push($messages,array('staff','fPT Staff',$this->GetTimeAgo($time),$this->ReplaceTags($pSQL->GetData('Message'))));
				else
					array_push($messages,array('user',$this->GetAuthorTicket(),$this->GetTimeAgo($time),$this->ReplaceTags($pSQL->GetData('Message'))));
			}
			
			return $messages;
		}
		
		return '';
	}
	
	public function SendMessageTicket($text)
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('INSERT INTO TicketData (TicketID,Message,Type,Date) VALUES (?,?,?,?)') )
		{
			$pSQL->Execute(array($this->ticketID,$text,2,date('m/d/y h:i:s A')));
			
			UI::ShowSuccess('Reply has been sent!');
		}
		
		UI::RedirectPage('?page=support&reply='.$this->ticketID.'',1);
	}
	
	public function DeleteTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('DELETE FROM TicketData WHERE TicketID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			if( $pSQL->Prepare('DELETE FROM TicketList WHERE ID=?') )
				$pSQL->Execute(array($this->ticketID));
			
			UI::ShowSuccess('The ticket has been deleted!');
		}
		
		UI::RedirectPage('?page=support',1);
	}
	
	public function CloseTicket()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('UPDATE TicketList SET State=1 WHERE ID=?') )
		{
			$pSQL->Execute(array($this->ticketID));
			
			UI::ShowSuccess('The ticket has been closed!');
		}
		
		UI::RedirectPage('?page=support&reply='.$this->ticketID.'',1);
	}
}

?>