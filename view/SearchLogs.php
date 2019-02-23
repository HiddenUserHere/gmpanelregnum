<?php
	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';

	//Box Search 
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">Search</h3></div>
                <form name=searchlogs method=post action="?page=logs&search">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="category" onchange="changeSelect(this.value)" id="category" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Account</option>
                              <option>Character</option>
                              <option>Cheat</option>
                              <option>Fury Arena</option>
							  <option>Item</option>
							  <option>Coin Shop</option>
							  <option>Warehouse</option>
                            </select>
                          </div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Search By</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="searchby" onchange="changeSl(this,1)" id="searchby" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Account</option>
                              <option>IP</option>
							  <option>Log ID</option>
                              <option>Mac Address</option>
                            </select>
                          </div>
                        <input name="text" id="text1" type="text" class="form-control" placeholder="Ex: regnumpt" style="margin-bottom:10px;">
                      </div>
                    </div>
                    <div class="form-group" id="extra1" style="display:none">
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="searchby1" onchange="changeSl(this,2)" id="searchby1" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Account</option>
                              <option>IP</option>
							  <option>Log ID</option>
                              <option>Mac Address</option>
                            </select>
                          </div>
                        <input name="text2" id="text2" type="text" class="form-control" placeholder="Ex: regnumpt" style="margin-bottom:10px;">
                      </div>
                    </div>
                    <div class="col-sm-12" style="margin-bottom:10px"><button type="button" onclick="addOption()" class="btn btn-normal pull-right"><span class="glyphicon glyphicon-plus"></span></button></div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Date</label>
                      <div class="col-sm-10">
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input name="date" id="datemask2" type="date" class="form-control" >
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                      <div class="form-group" >
						  <label class="checkbox-inline" style="margin-top: 10px; margin-left: -5px"><input type="checkbox" class="minimal" name="onlyplayer" checked>
						   Only Players</label>
					  </label>
					  </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Search Logs</button></div>
                </form>
              </div>';
			  
	//Results
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Results</h3></div>
	<div id="results" style="margin:10px">'; 
	
	if( $showr )
	{
		//Show names from SQL Column
		echo '<table id="dataTables" class="table table-bordered"><thead><tr><th style="display:none;">#</th>';

		$userIdCol = 0;

		$i = 1;
		foreach($tablename as $table):
			echo '<th>'.$table.'</th>';

			if( $table == 'UserID' || $table == 'AccountName' )
				$userIdCol = $i; 

		$i++;
		endforeach;
		
		echo '</tr></thead><tbody>';
		
		//Show results in Table
		$i = 1;
		foreach($listlogs as $log):

			//Ignore the first column and make order from results
			if( $i == 1 )
				echo '<tr><td style="display:none;">1</td>';
		
			//UserID?
			if( $i == $userIdCol )
				echo '<td><a href="?page=user&edituser='.$log.'">'.$log.'</a></td>';
			else
				echo '<td>'.$log.'</td>';
			
			if( $i == sizeof($tablename) )
			{
				echo '</tr>';
				$i = 1;
				continue;
			}
			
			$i++;
		endforeach;
		
		echo '</tbody></table>';
	}
	
	echo '</div>
    </div></div>';
	
	//End
    echo'</div></section></div>';
?>

<script>

function changeSelect(str) 
{
	var select = document.getElementById("searchby");

	for (i = 0; i < 2; i++) 
	{ 
		if( i > 0 )
			var select = document.getElementById("searchby"+i);

		if( str == 'Cheat' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('IP');
			select.options[select.options.length] = new Option('Character Name');
			select.options[select.options.length] = new Option('Action');
			select.options[select.options.length] = new Option('Log ID');
		}
		else if( str == 'Item' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('IP');
			select.options[select.options.length] = new Option('Character Name');
			select.options[select.options.length] = new Option('Item Name');
			select.options[select.options.length] = new Option('Item Checksum');
			select.options[select.options.length] = new Option('Log ID');
			select.options[select.options.length] = new Option('Mac Address');
		}
		else if( str == 'Fury Arena' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('Character Name');
		}
		else if( str == 'Coin Shop' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('Character Name');
			select.options[select.options.length] = new Option('Item Code');
		}
		else if( str == 'Account' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('IP');
			select.options[select.options.length] = new Option('Log ID');
			select.options[select.options.length] = new Option('Mac Address');
		}
		else if( str == 'Character' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('Character Name');
			select.options[select.options.length] = new Option('IP');
			select.options[select.options.length] = new Option('Log ID');
		}
		else if( str == 'Warehouse' )
		{
			select.options.length = 0;
			select.options[select.options.length] = new Option('Account');
			select.options[select.options.length] = new Option('Character Name');
			select.options[select.options.length] = new Option('Item Name');
		}
	}
}
function changeSl(str,i)
{
	var select = document.getElementById('text'+i);

	if( str.value == 'Account' )
		select.placeholder = "Ex: regnumpt";
	else if( str.value == 'Item Checksum' )
		select.placeholder = "Ex: code1 x code2";
	else if( str.value == 'IP' )
		select.placeholder = "Ex: 127.0.0.1";
	else if( str.value == 'Log ID' )
		select.placeholder = "Ex: 506";
	else if( str.value == 'Character Name' )
		select.placeholder = "Ex: GM-Zeus";
	else if( str.value == 'Action' )
		select.placeholder = "Ex: Ban/DC/Warn";
	else if( str.value == 'Item Name' )
		select.placeholder = "Ex: Battle Suit";
}
function addOption()
{
    document.getElementById('extra1').style.display = 'initial';
}
</script>