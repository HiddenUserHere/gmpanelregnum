<?php

//Enum
$AreaType = array(0 => 'None', 1 => 'Bound', 2 => 'Radius');

$DurationType = array(0 => 'None', 1 => 'Running', 2 => 'Amount');

$QuestType = array(0 => 'None', 1 => 'Solo', 2 => 'Party',
				3 => 'Daily', 4 => 'Daily MidNight', 5 => 'Daily Week',
				6 => 'Daily Month', 7 => 'Repeatable'
	);

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';


	//Content
	echo '<div class="col-md-12">
              <div class="box">
                <div class="box-body">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalQ_'.($lastquestid + 1).'">New Quest</button>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Quest ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Level</th>
                    </tr>'; 
					
					$i = 1;
					foreach($listquest as $quest):
					echo'
                    <tr>
                      <td>'.$i.'</td>
                      <td>'.$quest[0].'</td>
                      <td><a data-toggle="modal" data-target="#myModalQ_'.$quest[0].'">'.$quest[1].'</a></td>
                      <td>'.$quest[2].'</td>
                      <td>'.$quest[7].'</td>
                    </tr>';
                    $i++;
					endforeach;

					echo'
                  </table>
                </div>
				</div>';

foreach($listquest as $quest):
    //Modal Change Name Account
    echo '  <div class="modal fade" id="myModalQ_'.$quest[0].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=banaccount method=post action="?page=game&questlist">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Change Quest: '.$quest[1].'</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style="">
				        	<div class="col-sm-4">Name</div><div class="col-sm-10">
				        		<input name="questid" class="form-control input-sm col-sm-12" value="'.$quest[0].'" type="hidden">
				        		<input name="name" class="form-control input-sm col-sm-12" value="'.$quest[1].'" type="text">
				        	</div>
				     		<br>

				        	<div class="col-sm-4">Short Description</div><div class="col-sm-10">
				        		<input name="shortdescription" class="form-control input-sm col-sm-12" value="'.$quest[2].'" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Start Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="description" class="form-control input-sm col-sm-12">'.$quest[3].'</textarea>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Progress Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="progresstext" class="form-control input-sm col-sm-12">'.$quest[4].'</textarea>
				        	</div>
							<br>

				        	<div class="col-sm-4">Conclusion Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="conclusiontext" class="form-control input-sm col-sm-12">'.$quest[5].'</textarea>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Party</div><div class="col-sm-10">
				        		<select name="party" class="form-control input-sm col-sm-12">
				        			<option value="0"';
				        			
				        			if ($quest[6] == 0)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'False</option>
									
									<option value="1"';
				        			
				        			if ($quest[6] == 1)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'True</option>
				        		</select>
				        	</div>


				        	<div class="col-sm-4">Multiple</div><div class="col-sm-10">
				        		<select name="multiple" class="form-control input-sm col-sm-12">
				        			<option value="0"';
				        			
				        			if ($quest[7] == 0)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'False</option>
									
									<option value="1"';
				        			
				        			if ($quest[7] == 1)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'True</option>
				        		</select>
				        	</div>


				        	<div class="col-sm-4">PVP</div><div class="col-sm-10">
				        		<select name="pvp" class="form-control input-sm col-sm-12">
				        			<option value="0"';
				        			
				        			if ($quest[8] == 0)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'False</option>
									
									<option value="1"';
				        			
				        			if ($quest[8] == 1)
				        				echo ' selected>';
				        			else
				        				echo ' >';

				        			echo 'True</option>
				        		</select>
				        	</div>

				        	<div class="col-sm-4">Min Level</div><div class="col-sm-10">
				        		<input name="minlevel" class="form-control input-sm col-sm-12" value="'.$quest[9].'" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Max Level</div><div class="col-sm-10">
				        		<input name="maxlevel" class="form-control input-sm col-sm-12" value="'.$quest[10].'" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Duration Type</div><div class="col-sm-10">
				        		<select name="durationtype" class="form-control input-sm col-sm-12">';
				        		foreach ($DurationType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			if ( $key == $quest[12] )
				        				echo ' selected>'.$value.'</option>';
				        			else
				        				echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Duration</div><div class="col-sm-10">
				        		<input name="maxduration" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[11] == '' )
				        			echo 0;
				        		else
				        			echo $quest[11];

				        		echo '" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Map</div><div class="col-sm-10">
				        		<select name="mapid" class="form-control select-sm col-sm-12" style="width:250px;">
				        		<option value="-1">None</option>';
				        		$i = 0;
				        		foreach ($maplist as $map) {
				        			echo '<option value="'.$i.'"';
				        			if ( $i == $quest[13] )
				        				echo ' selected>'.$map[1].'</option>';
				        			else
				        				echo ' >'.$map[1].'</option>';

				        			$i++;
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Monsters ID</div><div class="col-sm-10">
				        		<input name="monsterid" id="monsteridQ_'.$quest[0].'" class="form-control input-sm col-sm-12" style="width:230px;" value="'.$quest[14].'" type="text"></input>
				        		<select name="monsteridl" id="monsteridlQ_'.$quest[0].'" class="form-control select-sm col-sm-12" style="width:200px;" onchange="AddCommaValueSelect(\'monsteridQ_'.$quest[0].'\', \'monsteridlQ_'.$quest[0].'\', 10)">';
				        		foreach ($monsteridlist as $mob) {
				        			echo '<option value="'.$mob[1].'">'.$mob[0].'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Items Required</div><div class="col-sm-10">
				        		<input name="requireditems" class="form-control input-sm col-sm-12" value="'.$quest[15].'" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Quest Type</div><div class="col-sm-10">
				        		<select name="questtype" class="form-control input-sm col-sm-12" style="width:150px;">';
				        		foreach ($QuestType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			if ( $key == $quest[16] )
				        				echo ' selected>'.$value.'</option>';
				        			else
				        				echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Required Quest IDs</div><div class="col-sm-10">
				        		<input name="requiredquestids" class="form-control input-sm col-sm-12" value="'.$quest[17].'" type="text">
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">Inclusion Quest IDs</div><div class="col-sm-10">
				        		<input name="inclusionquestids" class="form-control input-sm col-sm-12" value="'.$quest[18].'" type="text">
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">NPC ID</div><div class="col-sm-10">
				        		<select name="npcid" class="form-control input-sm col-sm-12" style="width:300px;">
				        		<option value="0">None</option>';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			if ( $quest[19] == $npc[0] )
				        				echo ' selected>'.$npc[1].' ['.$npc[2].']</option>';
				        			else
				        				echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">Target NPC ID</div><div class="col-sm-10">
				        		<select name="progressnpcid" class="form-control input-sm col-sm-12" style="width:300px;">
				        		<option value="0">None</option>';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			if ( $quest[20] == $npc[0] )
				        				echo ' selected>'.$npc[1].' ['.$npc[2].']</option>';
				        			else
				        				echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">Conclusion NPC ID</div><div class="col-sm-10">
				        		<select name="conclusionnpcid" class="form-control input-sm col-sm-12" style="width:300px;">
				        		<option value="0">None</option>';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			if ( $quest[21] == $npc[0] )
				        				echo ' selected>'.$npc[1].' ['.$npc[2].']</option>';
				        			else
				        				echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Auto Star Quest ID</div><div class="col-sm-10">
				        		<input name="autostartquestid" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[22] == '' )
				        			echo 0;
				        		else
				        			echo $quest[22];

				        		echo '" type="text">
				        	</div>
				        	<br>
				        	
				        	<div class="col-sm-4">Class Restriction</div><div class="col-sm-10">
				        		<input name="classrestriction" class="form-control input-sm col-sm-12" value="'.$quest[23].'" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Area Type</div><div class="col-sm-10">
				        		<select name="areatype" class="form-control input-sm col-sm-12">';
				        		foreach ($AreaType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			if ( $key == $quest[24] )
				        				echo ' selected>'.$value.'</option>';
				        			else
				        				echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">X Min</div><div class="col-sm-10">
				        		<input name="minx" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[25] == '' )
				        			echo 0;
				        		else
				        			echo $quest[25];

				        		echo '" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">X Max</div><div class="col-sm-10">
				        		<input name="maxx" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[26] == '' )
				        			echo 0;
				        		else
				        			echo $quest[26];

				        		echo '" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Z Min</div><div class="col-sm-10">
				        		<input name="minz" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[27] == '' )
				        			echo 0;
				        		else
				        			echo $quest[27];

				        		echo '" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Z Max</div><div class="col-sm-10">
				        		<input name="maxz" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[28] == '' )
				        			echo 0;
				        		else
				        			echo $quest[28];

				        		echo '" type="text">
				        	</div>
				        	<br>

				 			<div class="col-sm-4">Radius</div><div class="col-sm-10">
				        		<input name="radius" class="form-control input-sm col-sm-12" value="';

				        		if ( $quest[29] == '' )
				        			echo 0;
				        		else
				        			echo $quest[29];

				        		echo '" type="text">
				        	</div>
				        	<br>

				        </div>				      
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';
endforeach;

//Modal Change Name Account
    echo '  <div class="modal fade" id="myModalQ_'.($lastquestid + 1).'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=banaccount method=post action="?page=game&questlist">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">New Quest</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style="">
				        	<div class="col-sm-4">Name</div><div class="col-sm-10">
				        		<input name="questid" class="form-control input-sm col-sm-12" value="'.($lastquestid + 1).'" type="hidden">
				        		<input name="name" class="form-control input-sm col-sm-12" value="" type="text">
				        	</div>
				     		<br>

				        	<div class="col-sm-4">Short Description</div><div class="col-sm-10">
				        		<input name="shortdescription" class="form-control input-sm col-sm-12" value="" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Start Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="description" class="form-control input-sm col-sm-12"></textarea>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Progress Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="progresstext" class="form-control input-sm col-sm-12"></textarea>
				        	</div>
							<br>

				        	<div class="col-sm-4">Conclusion Text</div><div class="col-sm-10">
				        		<textarea maxlenght="2048" name="conclusiontext" class="form-control input-sm col-sm-12"></textarea>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Party</div><div class="col-sm-10">
				        		<select name="party" class="form-control input-sm col-sm-12">
				        			<option value="0" >';

				        			echo 'False</option>
									
									<option value="1" >';

				        			echo 'True</option>
				        		</select>
				        	</div>

				        	<div class="col-sm-4">Multiple</div><div class="col-sm-10">
				        		<select name="multiple" class="form-control input-sm col-sm-12">
				        			<option value="0" >';

				        			echo 'False</option>
									
									<option value="1" >';

				        			echo 'True</option>
				        		</select>
				        	</div>

				        	<div class="col-sm-4">PVP</div><div class="col-sm-10">
				        		<select name="pvp" class="form-control input-sm col-sm-12">
				        			<option value="0" >';

				        			echo 'False</option>
									
									<option value="1" >';

				        			echo 'True</option>
				        		</select>
				        	</div>

				        	<div class="col-sm-4">Min Level</div><div class="col-sm-10">
				        		<input name="minlevel" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Max Level</div><div class="col-sm-10">
				        		<input name="maxlevel" class="form-control input-sm col-sm-12" value="1000" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Duration Type</div><div class="col-sm-10">
				        		<select name="durationtype" class="form-control input-sm col-sm-12">';
				        		foreach ($DurationType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Duration</div><div class="col-sm-10">
				        		<input name="maxduration" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Map</div><div class="col-sm-10">
				        		<select name="mapid" class="form-control select-sm col-sm-12" style="width:250px;">
				        		<option value="-1">None</option>';
				        		$i = 0;
				        		foreach ($maplist as $map) {
				        			echo '<option value="'.$i.'"';
				        			echo ' >'.$map[1].'</option>';

				        			$i++;
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Monsters ID</div><div class="col-sm-10">
				        		<input name="monsterid" id="monsteridQ_'.($lastquestid + 1).'" class="form-control input-sm col-sm-12" style="width:230px;" value="" type="text"></input>
				        		<select name="monsteridl" id="monsteridlQ_'.($lastquestid + 1).'" class="form-control select-sm col-sm-12" style="width:200px;" onchange="AddCommaValueSelect(\'monsteridQ_'.($lastquestid + 1).'\', \'monsteridlQ_'.($lastquestid + 1).'\', 10)">';
				        		foreach ($monsteridlist as $mob) {
				        			echo '<option value="'.$mob[1].'">'.$mob[0].'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Items Required</div><div class="col-sm-10">
				        		<input name="requireditems" class="form-control input-sm col-sm-12" value="" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Quest Type</div><div class="col-sm-10">
				        		<select name="questtype" class="form-control input-sm col-sm-12" style="width:150px;">';
				        		foreach ($QuestType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Required Quest IDs</div><div class="col-sm-10">
				        		<input name="requiredquestids" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Inclusion Quest IDs</div><div class="col-sm-10">
				        		<input name="inclusionquestids" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">NPC ID</div><div class="col-sm-10">
				        		<select name="npcid" class="form-control input-sm col-sm-12" style="width:300px;">';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">Target NPC ID</div><div class="col-sm-10">
				        		<select name="progressnpcid" class="form-control input-sm col-sm-12" style="width:300px;">';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     

				        	<div class="col-sm-4">Conclusion NPC ID</div><div class="col-sm-10">
				        		<select name="conclusionnpcid" class="form-control input-sm col-sm-12" style="width:300px;">';
				        		foreach ($npcidlist as $npc) {
				        			echo '<option value="'.$npc[0].'"';
				        			echo ' >'.$npc[1].' ['.$npc[2].']</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>
				     
				        	<div class="col-sm-4">Auto Star Quest ID</div><div class="col-sm-10">
				        		<input name="autostartquestid" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>
				        	
				        	<div class="col-sm-4">Class Restriction</div><div class="col-sm-10">
				        		<input name="classrestriction" class="form-control input-sm col-sm-12" value="" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Area Type</div><div class="col-sm-10">
				        		<select name="areatype" class="form-control input-sm col-sm-12">';
				        		foreach ($AreaType as $key => $value) {
				        			echo '<option value="'.$key.'"';
				        			echo ' >'.$value.'</option>';
				        		}
				        		echo '</select>
				        	</div>
				        	<br>

				        	<div class="col-sm-4">X Min</div><div class="col-sm-10">
				        		<input name="minx" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">X Max</div><div class="col-sm-10">
				        		<input name="maxx" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Z Min</div><div class="col-sm-10">
				        		<input name="minz" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				        	<div class="col-sm-4">Z Max</div><div class="col-sm-10">
				        		<input name="maxz" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				 			<div class="col-sm-4">Radius</div><div class="col-sm-10">
				        		<input name="radius" class="form-control input-sm col-sm-12" value="0" type="text">
				        	</div>
				        	<br>

				        </div>				      
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-success">Confirm</button>
				      </div>
				    </form>
			    </div>
			  </div>
			</div>';

	//End
    echo'</div></section></div>';
?>

<script>
	function AddCommaValueSelect(doc, doc2, vl)
	{
		var txt = document.getElementById(doc);
		var txt2 = document.getElementById(doc2);
		var Count = txt.value.length;
		if ( Count > 0 )
		{
			var ss = txt.value.split(',').length;
			if ( ss < vl )
		    	txt.value = txt.value + ',' + txt2.options[txt2.selectedIndex].value;
		}
		else
			txt.value = txt2.options[txt2.selectedIndex].value;
	}
</script>