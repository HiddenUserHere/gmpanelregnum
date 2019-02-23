<?php

	//Header
	echo '<div class="content-wrapper" style="margin-top:0"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';

	//Menu Side
	echo '<div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Menu</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li id="alltct"><a href="?page=maintenance"><i class="fa fa-inbox"></i> General</a></li>
                    <li id="opentct"><a href="?page=maintenance&command"><i class="fa fa-envelope-o"></i> Server Command</a></li>
                  </ul>
                </div>
              </div>
            </div>';

    //Content
	echo '<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Server Statistics</h3></div>
                <div class="box-body">
                	<div class="col-sm-6 center-block" style="margin: 0px auto ! important; float: none ! important;">
						<table class="table">
	                      <tbody>
	                      <tr>
	                        <td style="border: 0px none;" class="col-sm-7">Total Accounts</td>
	                        <td style="border: 0px none;"><b>'.$info[0].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Total Banned Accounts</td>
	                        <td><b>'.$info[1].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Total Characters</td>
	                        <td><b>'.$info[2].'</b></td>
	                      </tr>
	                      <tr><td><br></td><td></td></tr>
	                      <tr>
	                        <td>Account Logs</td>
	                        <td><b>'.$info[3].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Character Logs</td>
	                        <td><b>'.$info[4].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Cheat Logs</td>
	                        <td><b>'.$info[5].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Coin Logs</td>
	                        <td><b>'.$info[6].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Fury Arena Logs</td>
	                        <td><b>'.$info[7].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Game Master Logs</td>
	                        <td><b>'.$info[8].'</b></td>
	                      </tr>
	                      <tr>
	                        <td>Warehouse Logs</td>
	                        <td><b>'.$info[9].'</b></td>
	                      </tr>
	                      <tr><td><br></td><td></td></tr>
	                      <tr>
	                        <td>Server Status</td>
	                        <td><a href="?page=maintenance&setmaint" data-toggle="tooltip" title="Set True or False">';

	                        if( $status == 0 )
	                        	echo '<span class="label label-success">ONLINE</span></a></td>';
	                        else
	                        	echo '<span class="label label-danger">MAINTENANCE</span></a></td>';

	                        echo '
	                      </tr>
	                    </tbody></table>
	                </div>
				</div>
			</div>

			<div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Announcements Login</h3></div>
                <div class="box-body">
                	<div class="col-sm-10 center-block" style="margin: 0px auto ! important; float: none ! important;">
                		<table class="table">
	                      <tbody>
		                      <tr>
		                        <th style="border: 0px none;" class="col-sm-10">Message</th>
		                        <th style="border: 0px none;" class="col-sm-2"></th>
		                      </tr>';

		                      foreach($alogin as $a):
		                      	echo '<form method=post action="?page=maintenance&updatemsglogin"><tr>
		                      <td><input name="message" type="text" class="form-control input-sm" value="'.$a[1].'"></td>
		                      <td><input name="id" type="text" style="display: none" value="'.$a[0].'"><button type="submit" class="btn btn-normal btn-sm">Save</button> <a href="?page=maintenance&deletemsglogin='.$a[0].'"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
		                      </tr></form>';
		                      endforeach;

		                     echo ' 
		                     <form method=post action="?page=maintenance&insertmsglogin"><tr><td><input name="message" type="text" class="form-control input-sm" placeholder="Message"></td>
		                     <td><button type="submit" class="btn btn-success btn-sm">Insert</button></td></tr></form>

	                      </tbody>
	                    </table>
	                </div>
				</div>
			</div>

			<div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Server Maintenace</h3></div>
                <div class="box-body">
                	<div class="col-sm-8 center-block" style="margin: 0px auto ! important; float: none ! important;">
                		<table class="table">
	                      <tbody>
		                      <tr>
		                        <th style="border: 0px none;">Mode</th>
		                        <th style="border: 0px none;">IP or Mac Address</th>
		                        <th style="border: 0px none;">Name</th>
		                        <th style="border: 0px none;"></th>
		                      </tr>';

		                      foreach($mlogin as $m):
		                      	echo '<form method=post action="?page=maintenance&updatelogin"><tr>
		                      <td><input name="mode" type="text" class="form-control input-sm" value="'.$m[0].'"></td>
		                      <td><input name="ip" type="text" class="form-control input-sm" value="'.$m[1].'"></td>
		                      <td><input name="name" type="text" class="form-control input-sm" value="'.$m[2].'"></td>
		                      <td><input name="id" type="text" style="display: none" value="'.$m[3].'"><button type="submit" class="btn btn-normal btn-sm">Save</button> <a href="?page=maintenance&deletelogin='.$m[3].'"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
		                      </tr></form>';
		                      endforeach;

		                     echo ' 
		                     <form method=post action="?page=maintenance&insertlogin"><tr><td><input name="mode" type="text" class="form-control input-sm" placeholder="Mode"></td>
		                     <td><input name="ip" type="text" class="form-control input-sm" placeholder="IP or Mac Address"></td>
		                     <td><input name="name" type="text" class="form-control input-sm" placeholder="Name of User"></td>
		                     <td><button type="submit" class="btn btn-success btn-sm">Insert</button></td></tr></form>

	                      </tbody>
	                    </table>
	                </div>
				</div>
			</div>

		</div>';

    //End
    echo'</div></section></div>';

?>