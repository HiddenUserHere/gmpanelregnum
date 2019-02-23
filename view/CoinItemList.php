<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Add Item
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Add Item</h3><div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div></div>
                <form name=additem method=post action="?page=coin&additem">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tab</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="tab" id="tab" class="form-control select2" style="width: 100%;">';
							foreach($listtabs as $tab):
							echo'<option value="'.$tab[0].'">'.$tab[1].'</option>';
							endforeach;
							
                           echo ' </select>
                          </div>
                      </div>
                    </div>		
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Name</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="itemname" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="description" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Code</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="itemcode" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Image Path</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="imgpath" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Value</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="price" id="text" type="text" class="form-control">
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
                      <label for="inputEmail3" class="col-sm-2 control-label">Is Spec</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="spec" id="tab" class="form-control select2" style="width: 10%;">
								<option value="1">True</option>
								<option value="0">False</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Is Quantity</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="quantity" id="tab" class="form-control select2" style="width: 10%;">
								<option value="0">False</option>
								<option value="1">True</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Disabled</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="disabled" id="tab" class="form-control select2" style="width: 10%;">
								<option value="0">False</option>
								<option value="1">True</option>
							</select>
                          </div>
                      </div>
					</div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Order</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-2">
						  <input name="order" id="text" type="text" class="form-control">
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Add Item</button></div>
                </form>
              </div>';
			  
	//List Items from CoinShop
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">List Items</h3></div>
	<div id="results" style="margin-top:10px"> 
	
	<div class="box-body table-responsive dataTable_wrapper">
	  <table id="dataTables" class="table table-hover">
		<thead>
		  <tr>
			<th>#</th>
			<th>Item Name</th>
			<th>Tab</th>
			<th>Disabled</th>
		  </tr>
		</thead>
		<tbody>';
		
		$i = 1;
		foreach($listitems as $item):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td><a href="?page=coin&edititem='.$item[0].'">'.$item[1].'</a></td>
			<td>'.$item[2].'</td>
			<td>'.$item[3].'</td>
			<td><a title="Delete Item" href="?page=coin&delitem='.$item[0].'"><i class="fa fa-times-circle fa-fw"></i></a></td>
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