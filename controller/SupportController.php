<?php

class SupportController extends Controller
{
	public function index()
	{
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','All Tickets');
		
		//List All Tickets
		$listTickets = array();
		$this->view->bind('listalltickets',$listTickets);
		
		$listTickets = $this->SupportModel->GetListAllTickets();
		
		$this->view->render('Support');
	}
	
	public function Open()
	{
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','Open Tickets');
		
		//List All Tickets
		$listTickets = array();
		$this->view->bind('listalltickets',$listTickets);
		
		$listTickets = $this->SupportModel->GetListOpenTickets();
		
		$this->view->render('Support');
	}
	
	public function Closed()
	{
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','Closed Tickets');
		
		//List All Tickets
		$listTickets = array();
		$this->view->bind('listalltickets',$listTickets);
		
		$listTickets = $this->SupportModel->GetListClosedTickets();
		
		$this->view->render('Support');
	}
	
	public function Reply()
	{
		$ticketID = Request::get('reply');
		if( $ticketID == '' )
			return;
			
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','Read Ticket');
		
		$this->SupportModel->SetTicketID($ticketID);
		$this->view->set('subject',$this->SupportModel->GetSubjectTicket());
		$this->view->set('author',$this->SupportModel->GetAuthorTicket());
		$this->view->set('date',$this->SupportModel->GetDateTicket());
		$this->view->set('message',$this->SupportModel->GetMessageTicket());
		$this->view->set('messages',$this->SupportModel->GetMessagesTicket());
		$this->view->set('state',$this->SupportModel->GetStateTicket());
		$this->view->set('type',$this->SupportModel->GetTypeTicket());
		
		$this->view->render('ReplySupport');
	}
	
	public function Send()
	{
		$ticketID = Request::get('reply');
		if( $ticketID == '' )
			return;
			
		if( Request::getFormCount() > 0 )
		{
			$this->setModel('SupportModel');
		
			$this->view->set('title','Support Tickets');
			$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
			$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
			$this->view->set('title2','Read Ticket');
			
			$this->SupportModel->SetTicketID($ticketID);
			$this->view->set('subject',$this->SupportModel->GetSubjectTicket());
			$this->view->set('author',$this->SupportModel->GetAuthorTicket());
			$this->view->set('date',$this->SupportModel->GetDateTicket());
			$this->view->set('message',$this->SupportModel->GetMessageTicket());
			$this->view->set('messages',$this->SupportModel->GetMessagesTicket());
			$this->view->set('state',$this->SupportModel->GetStateTicket());
			$this->view->set('type',$this->SupportModel->GetTypeTicket());
			
			$this->SupportModel->SendMessageTicket(Request::getForm('text'));
			
			$this->view->render('ReplySupport');
		}
	}
	
	public function Delete()
	{
		$ticketID = Request::get('reply');
		if( $ticketID == '' )
			return;
			
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','Read Ticket');
		
		$this->SupportModel->SetTicketID($ticketID);
		$this->view->set('subject',$this->SupportModel->GetSubjectTicket());
		$this->view->set('author',$this->SupportModel->GetAuthorTicket());
		$this->view->set('date',$this->SupportModel->GetDateTicket());
		$this->view->set('message',$this->SupportModel->GetMessageTicket());
		$this->view->set('messages',$this->SupportModel->GetMessagesTicket());
		$this->view->set('state',$this->SupportModel->GetStateTicket());
		$this->view->set('type',$this->SupportModel->GetTypeTicket());
		
		$this->SupportModel->DeleteTicket();
		
		$this->view->render('ReplySupport');
	}
	
	public function Close()
	{
		$ticketID = Request::get('reply');
		if( $ticketID == '' )
			return;
			
		$this->setModel('SupportModel');
		
		$this->view->set('title','Support Tickets');
		$this->view->set('description',$this->SupportModel->GetCountOpenTickets().' new tickets');
		$this->view->set('opentickets',$this->SupportModel->GetCountOpenTickets()); 
		$this->view->set('title2','Read Ticket');
		
		$this->SupportModel->SetTicketID($ticketID);
		$this->view->set('subject',$this->SupportModel->GetSubjectTicket());
		$this->view->set('author',$this->SupportModel->GetAuthorTicket());
		$this->view->set('date',$this->SupportModel->GetDateTicket());
		$this->view->set('message',$this->SupportModel->GetMessageTicket());
		$this->view->set('messages',$this->SupportModel->GetMessagesTicket());
		$this->view->set('state',$this->SupportModel->GetStateTicket());
		$this->view->set('type',$this->SupportModel->GetTypeTicket());
		
		$this->SupportModel->CloseTicket();
		
		$this->view->render('ReplySupport');
	}
}

?>