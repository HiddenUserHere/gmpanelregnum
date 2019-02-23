<?php

class MainModel extends Model
{
	public function GetUsersOnline()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('ServerDB');
		
		if( $pSQL->Prepare('SELECT * FROM UsersOnline') )
			$pSQL->Execute();
			
		return $pSQL->GetRecordCount();
	}
	
	public function GetBalance()
	{
		$paypal = new Paypal('sonshadowfax_api1.gmail.com', 'R97UBNAJAP2CWDKW', 'A-ANNLL4X9C-WmT3Scbjdilc-d.YA.pjMzu2tNMrXYE0MU0SngktRcmY');
		$response = $paypal->call('GetBalance');

		$balance = array();

		array_push($balance,($response['L_AMT0'] * $this->GetDolar()) + $response['L_AMT1']);
		array_push($balance,$response['L_AMT0']);
		array_push($balance,$response['L_AMT1']);

		return $balance;
	}

	public function GetUsersRegistered()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM UserInfo') )
			$pSQL->Execute();
		
		return $pSQL->GetRecordCount();
	}
	
	public function GetCountTickets()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT * FROM TicketList WHERE State=0') )
			$pSQL->Execute();
		
		return $pSQL->GetRecordCount();
	}
	
	public function GetTotalNewUsers()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		if( $pSQL->Prepare('SELECT TOP 50 * FROM UserInfo ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			if ($pSQL->GetRecordCount() > 0)
			{
				$i = 0;
				while ($pSQL->Fetch())
				{
					if( $this->GetDateIntervalInt( $pSQL->GetData('RegisDay')) < -7)
						break;
						
					$i++;
				}
			}
			return $i;
		}
		
		return 0;
	}
	
	public function GetListNewUsers()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('UserDB');
		
		$list = array();
		
		if( $pSQL->Prepare('SELECT TOP 50 * FROM UserInfo ORDER BY ID DESC'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				if( $this->GetDateIntervalInt( $pSQL->GetData('RegisDay')) < -7)
					break;
					
					
				$elements = array('userid' => $pSQL->GetData('AccountName'), 'date' => $this->GetDateIntervalStringToday($pSQL->GetData('RegisDay')));
				array_push($list,$elements);
			}
			
			return $list;
		}	
	}
	
	public function GetAmountCaixaLogs()
	{
		$pSQL = new SQL();
		$pSQL->CreateConnection('LogDB');
		
		$value = 0.0;
		
		if( $pSQL->Prepare('SELECT Value FROM CaixaLog WHERE MONTH([Date]) = MONTH(GETDATE()) AND YEAR([Date]) = YEAR(GETDATE()) AND Confirmed=1'))
		{
			$pSQL->Execute();
			
			while ($pSQL->Fetch())
			{
				$ret = $pSQL->GetData('Value');
				
				$ret = str_replace('r', '', $ret);
				$ret = str_replace('R', '', $ret);
				$ret = str_replace('$', '', $ret);
				$ret = str_replace(',', '.', $ret);				
				$ret = trim($ret);
				
				$value += floatval($ret);
			}
		}	
		
		return $value;
	}
	
	public function GetDolar()
	{
		$dolar = 0.0;
		return $dolar;
	}
	
}

?>