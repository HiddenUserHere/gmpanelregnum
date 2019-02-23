<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content">';

    //Row 1
	echo '<div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>'.$userson.'</h3>
                  <p>Users Online</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="?page=user&usersonline" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>'.$accountsregistred.'</h3>
                  <p>Accounts Registered</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
                <a href="?page=user&search" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">';
                  if( Request::getSession('level') >= 2 )
                  {
                      echo'
                    <h3>'; 
                    //Money Balance
                   echo 'R$'.number_format($caixaAmount).'';
				   
                    echo '</h3>
                    <p>R$'.number_format($caixaAmount).'</p>';
                  }
                echo '
                </div>
                <div class="icon">
                  <i style="margin-top:20px" class="glyphicon glyphicon-usd"></i>
                </div>
                <a href="?page=shop" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>'.$totaltickets.'</h3>
                  <p>New support Tickets!</p>
                </div>
                <div class="icon">
                  <i class="fa fa-support"></i>
                </div>
                <a href="?page=support" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>';

	//Row 3
	echo '<div class="row"><div class="col-md-6">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Latest Users</h3>
                <div class="box-tools pull-right">
                  <span class="label label-danger">'.$totalnewusers.' New Users</span>
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body no-padding">
                <ul class="users-list clearfix">';
				
				foreach($listnewusers as $user):
					echo'
                  <li>
                    <a class="users-list-name" href="?page=user&edituser='.$user['userid'].'">'.$user['userid'].'</a>
                    <span class="users-list-date">'.$user['date'].'</span>
                  </li>';
				endforeach;
				
	echo'
                </ul>
              </div>
              <div class="box-footer text-center">
                <a href="javascript::" class="uppercase">View All Users</a>
              </div>
            </div>
          </div></div>';
          
	//End
    echo'</section></div>';
?>