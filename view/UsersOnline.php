<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//List Users On
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">Map Users Online</h3></div>
	<div id="results" style="margin-left:10px; margin-top:10px"> 
	
	';
	
	include_once('worldmap.php');

	echo '</div>
		</div></div></div>';
		
	//List Users On
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">List Users Online</h3></div>
	<div id="results" style="margin-top:10px"> 
	
	<div class="box-body table-responsive">
	  <table class="table table-hover">
		<thead>
		  <tr>
			<th>#</th>
			<th>Account</th>
			<th>Character Name</th>
			<th>IP</th>
			<th>Class</th>
			<th>Level</th>
			<th>Login Time</th>
		  </tr>
		</thead>
		<tbody>';
		
		$i = 1;
		foreach($listuseron as $user):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td><a href="?page=user&edituser='.$user[0].'">'.$user[0].'</a></td>';
			
			if( !empty($user[6]) )
				echo '<td><a href="#" data-toggle="tooltip" title="'.$user[6][1].'"><img src="http://'.WEBSITE_URL.'/ClanImage/'.$user[6][6].'.bmp" height="20px" width="20px"></a> '.$user[1].'</td>';
			else
				echo '<td>'.$user[1].'</td>';
			
			echo'
			<td>'.$user[2].'</td>
			<td><img src="view/imgs/'.$user['3'].'.gif"></td>
			<td>'.$user[4].'</td>
			<td>'.$user[5].'</td>
		  </tr>';
		  $i++;
		endforeach;
		
		echo '</tbody>
		</table>
	</div>
	
	</div>
    </div></div></div>';
	
	//End
    echo'</div></section></div>';

?>