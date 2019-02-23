<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';
	
	//Content
	echo '<div class="col-md-12">
              <div class="box">
				<form name=saveagelist method=post action="?page=game&aginglist">
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Failure Chance</th>
                      <th>+2 Chance</th>
                      <th>-2 Chance</th>
					  <th>-1 Chance</th>
					  <th>Broken Chance</th>
					  <th>With Aging Stone</th>
                    </tr>'; 
					
					foreach($listage as $age):
					echo'
                    <tr>
                      <td style="line-height: 28px;">+'.$age[0].'</td>
                      <td><input name="failch'.$age[0].'" class="form-control input-sm" value="'.$age[1].'" type="text"></td>
                      <td><input name="2ch'.$age[0].'" class="form-control input-sm" value="'.$age[2].'" type="text"></td>
					  <td><input name="m2ch'.$age[0].'" class="form-control input-sm" value="'.$age[3].'" type="text"></td>
					  <td><input name="m1ch'.$age[0].'" class="form-control input-sm" value="'.$age[4].'" type="text"></td>
					  <td><input name="bch'.$age[0].'" class="form-control input-sm" value="'.$age[5].'" type="text"></td>
					  <td><input name="agest'.$age[0].'" class="form-control input-sm" value="'.$age[6].'" type="text"></td>
                    </tr>';
					endforeach;
					
					echo'
                  </table>
                </div>
				<div class="box-footer"><button type="submit" class="btn btn-success pull-right">Save Aging List</button></div>
				</form>
				</div>';
	
	//End
    echo'</div></section></div>';

?>