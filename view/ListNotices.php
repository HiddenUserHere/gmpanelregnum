<?php

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
			<th>Title Notice</th>
			<th>Type</th>
			<th>Date</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>';
		
		$i = 1;
		foreach($listnotices as $notice):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td><a href="?page=website&editnotice='.$notice[0].'">'.$notice[1].'</a></td>
			<td>'.$notice[3].'</td>
			<td>'.$notice[2].'</td>
			<td><a title="Edit Notice" href="?page=website&editnotice='.$notice[0].'"><i class="fa fa-edit fa-fw"></i></a><a title="Delete Notice" href="?page=website&delnotice='.$notice[0].'"><i style="cursor: pointer" class="fa fa-times-circle fa-fw"></i></a></td>
		  </tr>';
		  $i++;
		endforeach;
		
		echo '</tbody>
		</table>
	</div>
	
	</div>
    </div></div></div>';
	
	//Add Notice
	echo '<div class="box box-danger collapsed-box"><div class="box-header with-border"><h3 class="box-title">Add Notice</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=addnotice method=post action="?page=website&addnotice">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="category" class="form-control select2" style="width: 100%;">
                              <option value="0" selected="selected">Notice</option>
                              <option value="1">Event</option>
							  <option value="2">Patch Log</option>
							  <option value="3">Maintenance</option>
                            </select>
                          </div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="title" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <textarea name="message" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Add Notice</button></div>
                </form>
              </div>';
	
	//End
    echo'</div></section></div>';

?>