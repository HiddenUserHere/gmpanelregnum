<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Box Search 
	echo '<div class="box box-info">
		<div class="box-header with-border"><h3 class="box-title">Add Credits to Account</h3></div>
			<div class="form-horizontal">
			<div class="box-body">
			<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Price</label>
			<div class="col-sm-10">
				<input name="pricecoins" id="pricecoins" type="text" class="form-control" >
				<br>
				<button type="button" class="btn btn-success" onclick="CalcValueCoins();">Calculate</button>
			</div>
			</div>
			</div>
			</div>
                <form class="form-horizontal" name=addcredit method=post action="?page=user&addcredits">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Add to</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="by" id="addby" class="form-control select2" style="width: 100%;">
                              <option value=1 selected="selected">ID</option>
                              <option value=2>Account</option>
                            </select>
                          </div>
                        <input name="user" type="text" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Value</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <input id="valuecoins" name="value" type="text" class="form-control" >
						</div>
                      </div>
                    </div>
					
					<table class="table table-hover">
						<tr>
						  <th>#</th>
						  <th>Account</th>
						  <th>Description</th>
						  <th>Date</th>
						</tr>';
						
						$i = 1;
						foreach($logs as $log):
							echo'<tr><td>'.$i.'</td><td>'.$log[0].'</td><td>'.$log[1].'</td><td>'.$log[2].'</td><tr>';
							$i++;
						endforeach;
						
					echo'</table>
					
                  </div>
				<div class="box-footer"><button type="submit" class="btn btn-success pull-right">Add Credits</button></div>
				</form>
              </div>';
	
	//Send Item Form
	echo '<div class="box box-info">
		<div class="box-header with-border"><h3 class="box-title">Send Items to PostBox</h3></div>
                <form class="form-horizontal" name=senditem method=post action="?page=user&postbox">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Send to</label>
                      <div class="col-sm-10">
					  	<div class="input-group">
                        	<input name="user" type="text" class="form-control">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Name</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <input name="itemname" type="text" class="form-control" >
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Spec</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <input name="itemspec" type="text" class="form-control" >
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Item Count</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <input name="itemcount" type="text" class="form-control" >
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <input name="credits" type="text" class="form-control" >
						</div>
                      </div>
                    </div>
                  </div>
				<div class="box-footer"><button type="submit" class="btn btn-success pull-right">Send Item</button></div>
				</form>
              </div>';
	
	//End
    echo'</div></section></div>';

?>

<script type="text/javascript">
	function CalcValueCoins()
	{	
		var inputprice = document.getElementById('pricecoins');
		var value = Math.round((1100.0 / 35.0) * inputprice.value);
		value = Math.round(value / 50) * 50;
		value = (value * 110) / 100;
		
		
		var inputvalue = document.getElementById('valuecoins');
		
		inputvalue.value = value;
	}
	
	
</script>