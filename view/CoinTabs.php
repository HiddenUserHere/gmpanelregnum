<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Add Tab
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Add Tab</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=addtab method=post action="?page=coin&addtab">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tab Name</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="tabname" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Coin Shop ID</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="csid" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Parent ID</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <select name="pid" id="text" class="form-control">
						  <option selected value="0">Parent</option>';
						  foreach($listtabs as $tab):
						  if ( $tab[3] == 0 )
						  	echo '<option value="'.$tab[0].'">'.$tab[1].'</option>'; 
						  endforeach;
						  echo'</select>
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Discount</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="discount" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="bulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Max Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="maxbulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">List Order</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="listorder" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Add Tab</button></div>
                </form>
              </div>';
			  
	//List Tabs from CoinShop
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">List Tabs</h3></div>
	<div id="results" style="margin-top:10px"> 
	
	<div class="box-body table-responsive dataTable_wrapper">
	  <table id="dataTables" class="table table-hover">
		<thead>
		  <tr>
			<th>#</th>
			<th>Tab Name</th>
			<th>Coin Shop ID</th>
			<th>Parent ID</th>
			<th>Discount</th>
			<th>List Order</th>
		  </tr>
		</thead>
		<tbody>';
		
		$i = 1;
		foreach($listtabs as $tab):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td><a href="?page=coin&edittab='.$tab[0].'">'.$tab[1].'</a></td>
			<td>'.$tab[2].'</td>
			<td>'.$tab[3].'</td>
			<td>'.$tab[4].'</td>
			<td>'.$tab[5].'</td>
			<td><a title="Delete Tab" href="?page=coin&deltab='.$tab[0].'"><i class="fa fa-times-circle fa-fw"></i></a></td>
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