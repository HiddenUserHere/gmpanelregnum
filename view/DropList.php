<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//List Monsters
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">Monsters List</h3></div>
						<div class="box-body table-responsive dataTable_wrapper">
						  <table id="dataTables" class="table table-hover">
							<thead>
							  <tr>
								<th>#</th>
								<th>ID</th>
								<th>Monster Name</th>
								<th>Public Drop</th>
								<th>Quantity</th>
							  </tr>
							</thead>
							<tbody>';
							
		$i = 1;
		foreach($listdrop as $drop):
		echo'
		  <tr>
			<td>'.$i.'</td>
			<td>'.$drop[0].'</td>
			<td><a href="?page=game&editdrop='.$drop[0].'" data-toggle="tooltip" title="Edit Drops">'.$drop[1].'</a></td>
			<td>'.$drop[2].'</td>
			<td>'.$drop[3].'</td>
		  </tr>';
		  $i++;
		endforeach;
				  
				  
	echo '			</div>
				  </div>
		  </div>';
	
	//End
    echo'</div></section></div>';

?>