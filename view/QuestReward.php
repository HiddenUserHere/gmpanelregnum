<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row">';

	//Content
	echo '<div class="col-md-12">
              <div class="box">
                <div class="box-body">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalQ_'.($lastquestid + 1).'">New Quest Reward</button>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Quest ID</th>
                      <th>Name</th>
                    </tr>'; 
					
					$i = 1;
					foreach($questreward as $quest):
					echo'
                    <tr>
                      <td>'.$i.'</td>
                      <td>'.$quest[1].'</td>
                      <td><a data-toggle="modal" data-target="#myModalQ_'.$quest[0].'">'.$quest[2].'</a></td>
                    </tr>';
                    $i++;
					endforeach;

					echo'
                  </table>
                 </div>
                </div>
				</div>';
			

//Modal Change Name Account
    echo '  <div class="modal fade" id="myModalQ_'.($lastquestid + 1).'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <form name=banaccount method=post action="?page=game&questlist">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">New Quest Reward</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row" style="">

				        </div>
				      </div>
				    </form>
				</div>
			  </div>
			</div>';

	//End
    echo'</div></section></div>';

?>