<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<a href="?page=coin&itemlist"><small>'.$description.'</small></a></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Add Item
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Edit Item</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=additem method=post action="?page=coin&saveitem='.$iteminfo[0].'">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tab</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="tab" id="tab" class="form-control select2" style="width: 100%;">';
							foreach($listtabs as $tab):
							{
								echo'<option value="'.$tab[0].'"';
								
								if( $tab[0] == $iteminfo[1] )
									echo 'selected';
								
								echo '>'.$tab[1].'</option>';
							}
							endforeach;
							
                           echo ' </select>
                          </div>
                      </div>
                    </div>		
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Name</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input value="'.$iteminfo[2].'" name="itemname" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input value="'.$iteminfo[3].'" name="description" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Code</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input value="'.$iteminfo[4].'" name="itemcode" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Image Path</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input value="'.$iteminfo[5].'" name="imgpath" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Value</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$iteminfo[6].'" name="price" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Discount</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$iteminfo[7].'" name="discount" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$iteminfo[8].'" name="bulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Max Bulk</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$iteminfo[9].'" name="maxbulk" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Is Spec</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="spec" id="tab" class="form-control select2" style="width: 10%;">
								<option value="1"'; if( $iteminfo[10] == 1 ) echo 'selected'; echo'>True</option>
								<option value="0"'; if( $iteminfo[10] == 0 ) echo 'selected'; echo'>False</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Is Quantity</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="quantity" id="tab" class="form-control select2" style="width: 10%;">
								<option value="0"'; if( $iteminfo[11] == 0 ) echo 'selected'; echo'>False</option>
								<option value="1"'; if( $iteminfo[11] == 1 ) echo 'selected'; echo'>True</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Disabled</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="disabled" id="tab" class="form-control select2" style="width: 10%;">
								<option value="0"'; if( $iteminfo[12] == 0 ) echo 'selected'; echo'>False</option>
								<option value="1"'; if( $iteminfo[12] == 1 ) echo 'selected'; echo'>True</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Order</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input value="'.$iteminfo[13].'" name="order" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Save Item</button></div>
                </form>
              </div>
		</div>
    </div></div></div>';
	
	//End
    echo'</div></section></div>';

?>