<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small><a href="?page=coin&tab">'.$description.'</a></small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Add Tab
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Add Tab</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=addtab method=post action="?page=coin&savetab='.$tabinfo[0].'">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tab Name</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input value="'.$tabinfo[2].'" name="tabname" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Coin Shop ID</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$tabinfo[1].'" name="csid" id="text" type="text" class="form-control">
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
						  	echo '<option value="'.$tab[0].'"';
							if ( $tab[3] == $tabinfo[3] )
								echo ' selected';			
							echo '>'.$tab[1].'</option>'; 
						  endforeach;
						  echo'</select>
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Discount</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$tabinfo[4].'" name="discount" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$tabinfo[5].'" name="bulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Max Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$tabinfo[6].'" name="maxbulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">List Order</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$tabinfo[7].'" name="listorder" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Save Tab</button></div>
                </form>
              </div>';
			  
	//End
    echo'</div></section></div>';

?>