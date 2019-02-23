<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';

	//Content
	
	//Basic Information about User
	echo '<div class="col-md-3">
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center" data-toggle="modal" data-target="#myModal2" title="Change Account Name">'.$userid.'';
				  
				  //Status
				  if( $bstate )
				  	echo'<small style="font-size: 12px; font-weight: normal; margin-top: 5px;" class="label pull-right bg-green">ONLINE</small></h3>';
				  else
					 echo'<small style="font-size: 12px; font-weight: normal; margin-top: 5px;" class="label pull-right bg-red">OFFLINE</small></h3>';	
					
                  echo'<p class="text-muted text-center" data-toggle="modal" data-target="#myModal4">'.$usrtype.'</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Activated</b> <a href="?page=user&edituser='.$userid.'&action=active" data-toggle="tooltip" data-placement="left" title="Set True or False" class="pull-right">'.$active.'</a>
                    </li>
                    <li class="list-group-item">
                      <b>Warning Level</b> <a class="pull-right">'.$warnlevel.'%</a>
                    </li>
                    <li class="list-group-item">
                      <b>Vote Points</b> <a class="pull-right">'.$votepoints.'/10</a>
                    </li>
					<li class="list-group-item">
                      <b>Credits</b> <a class="pull-right">'.$credits.'</a>
                    </li>
                  </ul>';

		if( $flagban == 'True' )
			echo '<button type="button" class="col-sm-12 btn btn-danger btn-small" data-toggle="modal" data-target="#myModal">Banned</button>';
        else
			echo '<button type="button" class="col-sm-12 btn btn-success btn-small" data-toggle="modal" data-target="#myModal">Unbanned</button>';
			
		echo'
                </div>
              </div>';

    //Modal Change Name Account
    echo '  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=banaccount method=post action="?page=user&edituser='.$userid.'&action=changeaccountname">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Change Account Name</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-4">New Account Name</div><div class="col-sm-10"><input name="accname" class="form-control input-sm col-sm-12" placeholder="New Account Name" type="text"></div></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
			  
    //Modal Change Email Account
    echo '  <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=emailaccount method=post action="?page=user&edituser='.$userid.'&action=changeemailname">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Change Account Email</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-4">New Account Email</div><div class="col-sm-10"><input name="emailname" class="form-control input-sm col-sm-12" placeholder="New Account Email" type="text"></div></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
			  
    //Modal Ban/Unban Account
    echo '  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=banaccount method=post action="?page=user&edituser='.$userid.'&action=ban">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Ban Account</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-2">Ban Type</div><div class="col-sm-10">
							<select name="bantype" id="bantype" class="form-control select2" style="width: 100%;">
							  <option value="0">Unban</option>
							  <option value="1">Permanent Ban</option>
							  <option value="2">Temporary Ban</option>
                            </select>
						</div></div>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-2">Unban Date</div><div class="col-sm-10"><input name="unbandate" class="form-control input-sm col-sm-12" placeholder="01/01/2000" type="text"></div></div>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-2">Reason</div><div class="col-sm-10"><input name="banreason" class="form-control input-sm col-sm-12" placeholder="Insert a reason to ban" type="text"></div></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
			  
    //Modal GM Level Account
    echo '  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=gmleveledit method=post action="?page=user&edituser='.$userid.'&action=changegamemaster">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Change GM Level Account</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-2">Level</div><div class="col-sm-10"><input name="gmlevel" class="form-control input-sm col-sm-6" placeholder="Insert GM Level" type="text"></div></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
			  
    //Modal Password Account
    echo '  <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form name=gmleveledit method=post action="?page=user&edituser='.$userid.'&action=changepassword">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Change Password Account</h4>
					</div>
					<div class="modal-body">
						<div class="row" style=""><div class="col-sm-2">Password</div><div class="col-sm-10"><input name="pwuser" class="form-control input-sm col-sm-6" placeholder="New Password" type="password"></div></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>';
		
    //Modal New Notification
    echo '  <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=gmleveledit method=post action="?page=user&edituser='.$userid.'&action=newnotification">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">New Notification</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style=""><div class="col-sm-2">Notification</div><div class="col-sm-10"><input name="notify" class="form-control input-sm col-sm-6" placeholder="New Notification" type="text"></div></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
			  
//About User
	echo '<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About</h3>
                </div>
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Registered Day</strong>
                  <p class="text-muted">'.$regisday.'</p>

				  <hr style="margin-top: 2px; margin-bottom: 2px;">

                  <strong><i class="fa fa-unlock-alt margin-r-5"></i> Password</strong>
                  <p class="text-muted" data-toggle="modal" data-target="#myModal5" title="Change Account Password">'.$passwd.'</p>

                  <hr style="margin-top: 2px; margin-bottom: 2px;">

                  <strong><i class="fa fa-pencil margin-r-5"></i> Email</strong>
                  <p class="text-muted" data-toggle="modal" data-target="#myModal3" title="Change Account Email">'.$email.'</p>

                  <hr style="margin-top: 2px; margin-bottom: 2px;">

                  <strong><i class="fa fa-exclamation margin-r-5"></i> IP</strong>
                  <p class="text-muted">'.$lastip.'</p>

                  <hr style="margin-top: 2px; margin-bottom: 2px;">

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Latest Localization</strong>
                  <p class="text-muted">'.$localization['city'].','.$localization['country_name'].'</p>

                  <hr style="margin-top: 2px; margin-bottom: 2px;">

                  <strong><i class="fa fa-eye margin-r-5"></i> Last Seen Date</strong>
                  <p class="text-muted">Undefined</p>

                </div>
              </div>
            </div>';
			
	//Characters List
	echo '<div class="col-md-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Characters</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Character Name</th>
                      <th></th>
                      <th>Level</th>
                      <th>EXP</th>
                      <th>Last Seen Date</th>
					  <th>Action</th>
                    </tr>';
					
					$i = 1;
					foreach($listchrs as $char):
						echo'
						<tr>
						  <td style="line-height: 28px;">'.$i.'</td>
						  <td style="line-height: 28px;"><a href="#" data-toggle="tooltip" title="'.$char['classname'].'"><img src="view/imgs/'.$char['class'].'.gif"> </a>'.$char['name'].'</td>';
						  
						  if( $char['icon'] != '' )
						 	 echo '<td style="line-height: 28px;"><a href="#" data-toggle="tooltip" title="'.$char['clname'].'"><img src="http://'.WEBSITE_URL.'/ClanImage/'.$char['icon'].'.bmp" height="20px"></a></td>';
						  else	 
							 echo '<td style="line-height: 28px;"></td>';
							 
						  echo'
						  <td style="line-height: 28px;">'.$char['level'].'</td>
						  <td style="line-height: 28px;">'.number_format($char['exp']).'</td>
						  <td style="line-height: 28px;">'.$char['lastdate'].'</td>
						  <td style="line-height: 28px;"><div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm">Action</button>
                      <button aria-expanded="false" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a onclick="characterInfo(this)" data-toggle="modal" data-target="#modal" data-chname="'.$char['name'].'" href="#">Character Info</a></li>
						<li><a onclick="seeLogs(this)" data-toggle="modal" data-target="#modal" data-chname="'.$char['name'].'" href="#">See Logs</a></li>
                        <li class="divider"></li>
                        <li class="disabled"><a href="#">Delete Character</a></li>
                      </ul>
                    </div></td>
						</tr> ';
						$i++;
					endforeach;
                   
				   echo '
                  </table>
                </div>
              </div>
            </div>';
			
	//Modal See Logs
	echo '<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" style="width: 1200px">
        <div class="modal-content">
    		<iframe id="lightbox" width="100%" height="660px" style="padding: 10px;border:none" src=""></iframe>
        </div>
      </div>
    </div>';
	
	echo '<script type="text/javascript">
		function seeLogs(componente){
			var chname = componente.getAttribute("data-chname");
			document.getElementById(\'lightbox\').src = \'?pag=seelogsch&type=0&account=\'+chname;
		}
		function characterInfo(componente){
			var chname = componente.getAttribute("data-chname");
			document.getElementById(\'lightbox\').src = \'?page=user&characterinfo=\'+chname;
		}
	</script>';
			
	//Logs and Extra Options
	echo '<div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#gmLogs" data-toggle="tab">Game Master Logs</a></li>
                  <li><a href="#accountlogs" data-toggle="tab">Account Logs</a></li>
                  <li><a href="#cheatlogs" data-toggle="tab">Cheat Logs</a></li>
                 <li><a href="#passwdlogs" data-toggle="tab">Password Logs</a></li>
                 <li><a href="#emaillogs" data-toggle="tab">Email Logs</a></li>
                  <li><a href="#notifications" data-toggle="tab">Notifications</a></li>
                </ul>
                <div class="tab-content">

					<div class="active tab-pane" id="gmLogs">
					<div class="container no-padding">
					<div class="row">
            <div class="box-body table-responsive no-padding">
					  <table id="data1" class="table table-hover">
						<thead>
						  <tr>
							<th>#</th>
							<th>Operator IP</th>
							<th>Note</th>
							<th>Date</th>
						  </tr>
						</thead>
						<tbody>';
						
						$i = 1;
						foreach($gmLogs as $log):
							echo'
						  <tr>
							<td>'.$i.'</td>
							<td>'.$log[0].'</td>
							<td>'.$log[1].'</td>
							<td>'.$log[2].'</td>
						  </tr>';
						  $i++;
						endforeach;
						  
						echo '
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					</div>

					<div class="tab-pane" id="accountlogs">
					<div class="container no-padding">
					<div class="row">
            <div class="box-body table-responsive no-padding">
					  <table id="data2" class="table table-hover">
						<thead>
						  <tr>
							<th>#</th>
							<th>IP</th>
							<th>LogID</th>
							<th>Note</th>
							<th>Date</th>
						  </tr>
						</thead>
						<tbody>';
						
						$i = 1;
						foreach($accountLogs as $log):
							echo'
						  <tr>
							<td>'.$i.'</td>
							<td>'.$log[0].'</td>
							<td>'.$log[1].'</td>
							<td>'.$log[2].'</td>
							<td>'.$log[3].'</td>
						  </tr>';
						  $i++;
						endforeach;
						  
						echo '
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					</div>

					<div class="tab-pane" id="cheatlogs">
					<div class="container no-padding">
					<div class="row">
          <div class="box-body table-responsive no-padding">
					  <table id="data3" class="table table-hover">
						<thead>
						  <tr>
							<th style="padding-right:0">#</th>
							<th style="padding-right:0">IP</th>
							<th style="padding-right:0">Action</th>
							<th style="padding-right:0">LogID</th>
							<th>Note</th>
							<th>Date</th>
						  </tr>
						</thead>
						<tbody>';
						
						$i = 1;
						foreach($cheatLogs as $log):
							echo'
						  <tr>
							<td style="padding-right:0">'.$i.'</td>
							<td style="padding-right:0">'.$log[0].'</td>
							<td style="padding-right:0">'.$log[1].'</td>
							<td style="padding-right:0">'.$log[2].'</td>
							<td>'.$log[3].'</td>
							<td>'.$log[4].'</td>
						  </tr>';
						  $i++;
						endforeach;
						  
						echo '
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					</div>
				  
					<div class="tab-pane" id="passwdlogs">
					<div class="container no-padding">
					<div class="row">
          <div class="box-body table-responsive no-padding">
					  <table id="data4" class="table table-hover">
						<thead>
						  <tr>
							<th>#</th>
							<th>Account</th>
							<th>Old Password</th>
							<th>New Password</th>
							<th>Confirmed</th>
						  </tr>
						</thead>
						<tbody>';
						
						$i = 1;
						foreach($passwdLogs as $log):
							echo'
						  <tr>
							<td>'.$i.'</td>
							<td>'.$log[0].'</td>
							<td>'.$log[1].'</td>
							<td>'.$log[2].'</td>
							<td>'.$log[3].'</td>
						  </tr>';
						  $i++;
						endforeach;
						  
						echo '
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					</div>

					<div class="tab-pane" id="emaillogs">
					<div class="container no-padding">
					<div class="row">
          	<div class="box-body table-responsive no-padding">
					  <table id="data5" class="table table-hover">
						<thead>
						  <tr>
							<th>#</th>
							<th>Account</th>
							<th>Old Email</th>
							<th>New Email</th>
							<th>Confirmed</th>
						  </tr>
						</thead>
						<tbody>';
						
						$i = 1;
						foreach($emailLogs as $log):
							echo'
						  <tr>
							<td>'.$i.'</td>
							<td>'.$log[0].'</td>
							<td>'.$log[1].'</td>
							<td>'.$log[2].'</td>
							<td>'.$log[3].'</td>
						  </tr>';
						  $i++;
						endforeach;
						  
						echo '
						</tbody>
					  </table>
					</div>
					</div>
					</div>
        </div>



									<div class="tab-pane" id="notifications">
									<div class="container no-padding">
										<div class="row">
											<button type="button" class="col-sm-2 btn btn-primary btn-small pull-right" data-toggle="modal" data-target="#modalNotification">New Notification</button>
										</div>
										<br>
										<div class="row">
											<div class="box-body table-responsive no-padding">
												<table id="data6" class="table table-hover">
												<thead>
													<tr>
													<th>#</th>
													<th>Notification</th>
													<th>Checked</th>
													<th>Date</th>
													</tr>
												</thead>
												<tbody>';
												
												$i = 1;
												foreach($notificationLogs as $log):
													echo'
													<tr>
													<td>'.$i.'</td>
													<td>'.$log[1].'</td>
													<td>'.$log[2].'</td>
													<td>'.$log[3].'</td>
													</tr>';
													$i++;
												endforeach;
													
												echo '
												</tbody>
												</table>
											</div>
										</div>									
									</div>
									</div>

                </div>
              </div>
            </div>';

	//End
    echo'</div></section></div>';

?>