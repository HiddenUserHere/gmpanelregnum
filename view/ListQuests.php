<?php

	$QType = array (1 => 'Repeatable', 2 => 'Daily', 3 => 'Pvp', 4 => 'Beginner', 5 => 'Additional', 6 => 'Old Quests', 7 => 'Tier 5 Rank-Up');

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//List Notices
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">List Notices</h3></div>
	<div id="results" style="margin-top:10px"> 
	
	<div class="box-body table-responsive dataTable_wrapper">
	  <table id="dataTables" class="table table-hover">
		<thead>
		  <tr>
			<th>#</th>
			<th>Title Quest</th>
			<th>Level</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>';
		
		$i = 1;
		foreach($listquests as $quest):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td><a href="">'.$quest[1].'</a></td>
			<td>'.$quest[2].'</td>
			<td><a title="Delete Quest" href="?page=website&delquest='.$quest[0].'"><i class="fa fa-times-circle fa-fw"></i></a></td>
		  </tr>';
		  $i++;
		endforeach;
		
		echo '</tbody>
		</table>
	</div>
	
	</div>
    </div></div></div>';
	
	//Add Notice
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Add Quest</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=addquest method=post action="?page=website&addquest">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="title" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="questtype" id="questtype" class="form-control select2" style="width: 100%;">';
							foreach($QType as $q => $t):
								echo '<option value="'.$q.'">'.$t.'</option>';
							endforeach;
							
                           echo ' </select>
                          </div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Exclusive</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="exclusive" id="exclusive" class="form-control select2" style="width: 100%;">
							<option value="0">No</option>
							<option value="1">Yes</option>
							</select>
                          </div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Quest Level</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="questlevel" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Reward</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="reward" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Add Quest</button></div>
                </form>
              </div>';
	
	//End
    echo'</div></section></div>';

?>