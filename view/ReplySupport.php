<?php

	$newTickets = $opentickets > 0 ? $opentickets : '';
	$stateTicket = $state == 0 ? '<span class="label label-success" style="margin-left:10px;font-size:10px">Open</span>' : '<span class="label label-danger" style="margin-left:10px;font-size:10px">Closed</span>';

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
			
	//Reply Ticket
	echo '<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">'.$title2.'</h3></div>
                <div class="box-body no-padding">
					<div class="mailbox-read-info">
                    	<h3>'.$subject.''.$stateTicket.'</h3>
                    	<h5>From: <a href="?page=user&edituser='.$author.'">'.$author.'</a><span class="mailbox-read-time pull-right">'.$date.'</span></h5>
                  	</div>
					
					<div class="mailbox-read-message">
						'.$message.'
					</div>
				</div>
				<div class="box-footer">
					<div class="pull-right">
                   	 	<button onclick="location.href=\'?page=support&reply='.Request::get('reply').'&action=close\'" class="btn btn-default"><i class="fa fa-lock"></i> Close</button>
                    	<button onclick="location.href=\'?page=support&reply='.Request::get('reply').'&action=delete\'" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                  	</div>
				</div>
			</div>
			
			<div class="box box-warning">
                <div style="margin-bottom: 10px;" class="box-header with-border"><h3 class="box-title">Progress of Ticket</h3></div>
                <div class="box-body chat" id="chat-box">';
				
					foreach($messages as $message):
					echo'
					<div class="item" style="margin-bottom:0">
						<img src="view/imgs/'.$message[0].'.png" alt="user image" class="online">
						<p class="message">
						  <a href="" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.$message[2].'</small>
							'.$message[1].'
						  </a>
						  '.$message[3].'
						</p>
                  	</div>';
					endforeach;
										
				echo '</div>';
				
				if( $state == 0 )
				echo'
				<form name=replyticket method=post action="?page=support&reply='.Request::get('reply').'&action=send">
					<div class="box-footer">
					  <div class="input-group">
						<input name="text" id="text" type="text" class="form-control" placeholder="Type message...">
						<div class="input-group-btn">
						  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
						</div>
					  </div>
					</div>
				</form>';
				
			echo'
			</div>
		</div>';
	
	//End
    echo'</div></section></div>';
?>