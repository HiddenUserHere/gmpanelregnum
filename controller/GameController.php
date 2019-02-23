<?php

class GameController extends Controller
{
	public function index()
	{
		UI::ShowError('The access request is invalid!');
	}
	
	//Aging List
	public function AgingList()
	{
		//Isnt handler
		if( Request::getFormCount() == 0 )
		{
			$this->setModel('GameModel');
			
			$this->view->set('title','Aging List');
			$this->view->set('description','');
			
			//Get Aging List
			$listAging = array();
			$this->view->bind('listage',$listAging);
			
			$listAging = $this->GameModel->GetAgingList();
			
			//Render View
			$this->view->render('AgingList');
		}
		else
		{
			//Handler
			$this->setModel('GameModel');
			
			$this->view->set('title','Aging List');
			$this->view->set('description','');
			
			//Get Aging List
			$listAging = array();
			$this->view->bind('listage',$listAging);
			
			$listAging = $this->GameModel->GetAgingList();
			
			//Render View
			$this->view->render('AgingList');
			
			$this->GameModel->SetAgingList();
		}
	}

	//DropList
	public function DropList()
	{
		$this->setModel('GameModel');
		
		$this->view->set('title','Drop List');
		$this->view->set('description','');
		
		//Get Drp[ List
		$listDrops = array();
		$this->view->bind('listdrop',$listDrops);
		
		$listDrops = $this->GameModel->GetDropList();
		
		//Render View
		$this->view->render('DropList');
	}


	//QuestList
	public function QuestList()
	{
		if( Request::getFormCount() == 0 )
		{
			//Handler
			$this->setModel('GameModel');
			
			$this->view->set('title','Quest List');
			$this->view->set('description','');

			$ListQuest = array();
			$LastQuestID = 0;
			$MapList = array();
			$MonsterIDList = array();
			$NPCIDList = array();
			$this->view->bind('listquest',$ListQuest);
			$this->view->bind('lastquestid',$LastQuestID);
			$this->view->bind('maplist',$MapList);
			$this->view->bind('monsteridlist',$MonsterIDList);
			$this->view->bind('npcidlist',$NPCIDList);
			$ListQuest = $this->GameModel->GetQuestList();
			$LastQuestID = $this->GameModel->GetLastQuestListID();
			$MapList = $this->GameModel->GetMapList();
			$MonsterIDList = $this->GameModel->GetMonsterIDList();
			$NPCIDList = $this->GameModel->GetNPCIDList();


			$this->view->render('QuestList');

		}
		else
		{
			//Handler
			$this->setModel('GameModel');
			
			$this->view->set('title','Quest List');
			$this->view->set('description','');

			$ListQuest = array();
			$LastQuestID = 0;
			$MapList = array();
			$MonsterIDList = array();
			$NPCIDList = array();
			$this->view->bind('listquest',$ListQuest);
			$this->view->bind('lastquestid',$LastQuestID);
			$this->view->bind('maplist',$MapList);
			$this->view->bind('monsteridlist',$MonsterIDList);
			$this->view->bind('npcidlist',$NPCIDList);
			$ListQuest = $this->GameModel->GetQuestList();
			$LastQuestID = $this->GameModel->GetLastQuestListID();
			$MapList = $this->GameModel->GetMapList();
			$MonsterIDList = $this->GameModel->GetMonsterIDList();
			$NPCIDList = $this->GameModel->GetNPCIDList();


			$this->view->render('QuestList');

			$this->GameModel->UpdateQuestList();
		}
	}

	public function QuestReward()
	{
		if( Request::getFormCount() == 0 )
		{
			//Handler
			$this->setModel('GameModel');
			
			$this->view->set('title','Quest Reward List');
			$this->view->set('description','');

			$QuestReward = array();
			$LastQuestID = 0;

			$this->view->bind('lastquestid',$LastQuestID);
			$this->view->bind('questreward', $QuestReward);

			$QuestReward = $this->GameModel->GetQuestRewardList();
			$LastQuestID = $this->GameModel->GetLastQuestRewardListID();

			$this->view->render('QuestReward');

		}
		else
		{
			//Handler
			$this->setModel('GameModel');
			
			$this->view->set('title','Quest Reward List');
			$this->view->set('description','');

			$QuestReward = array();
			$LastQuestID = 0;

			$this->view->bind('lastquestid',$LastQuestID);
			$this->view->bind('questreward', $QuestReward);

			$QuestReward = $this->GameModel->GetQuestRewardList();
			$LastQuestID = $this->GameModel->GetLastQuestRewardListID();

			$this->view->render('QuestReward');
		}
	}

}

?>