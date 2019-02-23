<?php

	$newTickets = $opentickets > 0 ? $opentickets : '';

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';
	
	//Menu Side
	echo '<div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li id="alltct"><a href="?page=support"><i class="fa fa-inbox"></i> All Tickets</a></li>
                    <li id="opentct"><a href="?page=support&open"><i class="fa fa-envelope-o"></i> Open <span class="label label-success pull-right">'.$newTickets.'</span></a></li>
                    <li id="closetct"><a href="?page=support&closed"><i class="fa fa-file-text-o"></i> Closed Tickets</a></li>
                  </ul>
                </div>
              </div>
            </div>';
			
	//List Tickets
	echo '<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">'.$title2.'</h3></div>
                <div class="box-body">
					<table id="dataTables" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Author</th>
								<th>Title</th>
								<th>State</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>';
							
						$i = 1;
						foreach($listalltickets as $ticket):
							
							$type = '';
							switch( $ticket[2] )
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
							
							$stateTicket = $ticket[3] == 0 ? '<span class="label label-success" style="margin-top:3px">Open</span>' : '<span class="label label-danger" style="margin-top:3px">Closed</span>';
						
							echo '<tr><td>'.$i.'</td><td><a href="?page=user&edituser='.$ticket[1].'">'.$ticket[1].'</a></td><td><span class="label label-success pull-left bg-light-blue-active color-palette" style="margin-right:10px;margin-top:3px">'.$type.'</span> <a href="?page=support&reply='.$ticket[5].'">'.$ticket[0].'</a></td><td>'.$stateTicket.'</td><td>'.$ticket[4].'</td></tr>';
							$i++;
						endforeach;
							
						echo '</tbody></table>
				</div>
			</div>
		</div>';
	
	//End
    echo'</div></section></div>';
?>