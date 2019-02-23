<script>
var table = $('#dataTables').DataTable();
table.destroy();
table.ajax.reload();
</script>

<?php

	$searchmode = Request::get('by');
	$searchvalue = Request::get('search');
	
	if( $searchmode == 'ID' && $searchvalue == 'ID' )
		$searchvalue = 0;

	//Create Connection
	$pSQL = new SQL();
	$pSQL->CreateConnection('UserDB');
	
	$pSQL2 = new SQL();
	$pSQL2->CreateConnection('UserDB');

	$pSQL3 = new SQL();
	$pSQL3->CreateConnection('LogDB');
	
	echo '<div style="width: 100%; background: #fff; margin-top: -20px;">';
	
	//Search Mode
	switch( $searchmode )
	{
		case 'Account Name':

			if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE AccountName LIKE ?'))
			{
				$pSQL->Execute(array('%'.$searchvalue.'%'));
				
				if( $pSQL->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';
									
					while ( $pSQL->Fetch() )
					{
						$isActivated = $pSQL->GetData('Active') == 1 ? "True" : "False";
						$isBanned = $pSQL->GetData('Banned') == 1 ? "True" : "False";
						
						echo '<tr>';
						echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';	
						echo '<td>'.$pSQL->GetData('Email').'</td>';	
						echo '<td>'.$pSQL->GetData('Password').'</td>';	
						echo '<td>'.$isActivated.'</td>';	
						echo '<td>'.$isBanned.'</td>';	
						echo '</tr>';
					}
					
					echo '</tbody></table></div>';
				}
				else
				{
					return;
				}
			}
		break;
		case 'ID':
			if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE ID=?'))
			{
				$pSQL->Execute(array($searchvalue));
				
				if( $pSQL->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';
									
					while ( $pSQL->Fetch() )
					{
						$isActivated = $pSQL->GetData('Active') == 1 ? "True" : "False";
						$isBanned = $pSQL->GetData('Banned') == 1 ? "True" : "False";
						
						echo '<tr>';
						echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';	
						echo '<td>'.$pSQL->GetData('Email').'</td>';	
						echo '<td>'.$pSQL->GetData('Password').'</td>';	
						echo '<td>'.$isActivated.'</td>';	
						echo '<td>'.$isBanned.'</td>';	
						echo '</tr>';
					}
					
					echo '</tbody></table></div>';
				}
				else
				{
					return;
				}
			}
		break;
		case 'Character Name':

			if( $pSQL->Prepare('SELECT * FROM CharacterInfo WHERE Name LIKE ?'))
			{
				$pSQL->Execute(array('%'.$searchvalue.'%'));
				
				if( $pSQL->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>Nick</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';
									
					while ( $pSQL->Fetch() )
					{
						$nick = $pSQL->GetData('Name');
						$id = Model::GetAccountByNick($pSQL->GetData('Name'));

						if( $pSQL2->Prepare('SELECT * FROM UserInfo WHERE AccountName=?'))
						{
							$pSQL2->Execute(array($id));
							
							$isActivated = $pSQL2->GetData('Active') == 1 ? "True" : "False";
							$isBanned = $pSQL2->GetData('Banned') == 1 ? "True" : "False";
							
							echo '<tr>';
							echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';							echo '<td>'.$nick.'</td>';
							echo '<td>'.$pSQL2->GetData('Email').'</td>';	
							echo '<td>'.$pSQL2->GetData('Password').'</td>';	
							echo '<td>'.$isActivated.'</td>';	
							echo '<td>'.$isBanned.'</td>';	
							echo '</tr>';
						}
					}
					
					echo '</tbody></table></div>';
				}
				else
				{
					return;
				}
			}	
		break;
		case 'Email':

			if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE Email LIKE ?'))
			{
				$pSQL->Execute(array('%'.$searchvalue.'%'));
				
				if( $pSQL->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';
									
					while ( $pSQL->Fetch() )
					{
						$isActivated = $pSQL->GetData('Active') == 1 ? "True" : "False";
						$isBanned = $pSQL->GetData('Banned') == 1 ? "True" : "False";
						
						echo '<tr>';
						echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';	
						echo '<td>'.$pSQL->GetData('Email').'</td>';	
						echo '<td>'.$pSQL->GetData('Password').'</td>';	
						echo '<td>'.$isActivated.'</td>';	
						echo '<td>'.$isBanned.'</td>';	
						echo '</tr>';
					}
					
					echo '</tbody></table></div>';
				}
				else
				{
					return;
				}
			}
		break;
		case 'IP':

			if( $pSQL3->Prepare('SELECT TOP 1000 * FROM AccountLog WHERE IP LIKE ? ORDER BY ID DESC'))
			{
				$pSQL3->Execute(array($searchvalue.'%'));

				if( $pSQL3->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>IP</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';

					$dataFind = array();

					while ( $pSQL3->Fetch() )
					{
						$accountSearch = $pSQL3->GetData('AccountName');
						$accountIP = $pSQL3->GetData('IP');
						$next = false;

						for( $i = 0; $i < sizeof($dataFind); $i++ ) 
						{ 
							//Conta existente na array?
							if( $dataFind[$i]['Account'] === $accountSearch )
							{
								if( $dataFind[$i]['IP'] === $accountIP )
								{
									$next = true;
									break;
								}
							}
						}

						if( $next == true )
							continue;

						if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE AccountName=?'))
						{
							$pSQL->Execute(array($accountSearch));

							if( $pSQL->GetRecordCount() > 0 )
							{
								$isActivated = $pSQL->GetData('Active') == 1 ? "True" : "False";
								$isBanned = $pSQL->GetData('Banned') == 1 ? "True" : "False";
								
								echo '<tr>';
								echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';	
								echo '<td>'.$accountIP.'</td>';	
								echo '<td>'.$pSQL->GetData('Email').'</td>';	
								echo '<td>'.$pSQL->GetData('Password').'</td>';	
								echo '<td>'.$isActivated.'</td>';	
								echo '<td>'.$isBanned.'</td>';	
								echo '</tr>';

								array_push($dataFind, array('Account' => $pSQL->GetData('AccountName'), 'IP' => $accountIP) );
							}

							$pSQL->Free();
						}
					}
					
					echo '</tbody></table></div>';
				}
				else
					return;
			}

		break;
		case 'Password':

			if( $pSQL->Prepare('SELECT * FROM UserInfo WHERE Password LIKE ?'))
			{
				$pSQL->Execute(array('%'.$searchvalue.'%'));
				
				if( $pSQL->GetRecordCount() > 0 )
				{
					echo '<div class="box-body table-responsive no-padding dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>Account</th>
								<th>Email</th>
								<th>Password</th>
								<th>Activated</th>
								<th>Banned</th>
							  </tr>
							</thead>
							<tbody>';
									
					while ( $pSQL->Fetch() )
					{
						$isActivated = $pSQL->GetData('Active') == 1 ? "True" : "False";
						$isBanned = $pSQL->GetData('Banned') == 1 ? "True" : "False";
						
						echo '<tr>';
						echo '<td><a href="?page=user&edituser='.$pSQL->GetData('AccountName').'">'.$pSQL->GetData('AccountName').'</a></td>';	
						echo '<td>'.$pSQL->GetData('Email').'</td>';	
						echo '<td>'.$pSQL->GetData('Password').'</td>';	
						echo '<td>'.$isActivated.'</td>';	
						echo '<td>'.$isBanned.'</td>';	
						echo '</tr>';
					}
					
					echo '</tbody></table></div>';
				}
				else
				{
					return;
				}
			}
		break;
	}
	
	//End
	echo '</div>';
?>