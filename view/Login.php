<?php

  echo '<div class="content-wrapper" style="margin-left:0;margin-top:-125px"><div class="login-box" style="padding-top:120px">
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form name="loginpt" action="?page=Login" method="post">
          <div class="form-group has-feedback">
            <input name="account" class="form-control" placeholder="Account">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div></div>';

?>