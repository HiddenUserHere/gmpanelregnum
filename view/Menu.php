<?php

	$pSQL = new SQL();
	$pSQL->CreateConnection('UserDB');
	
	if( $pSQL->Prepare('SELECT * FROM TicketList WHERE State=0') )
			$pSQL->Execute();
			
	$newTickets = $pSQL->GetRecordCount() > 0 ? $pSQL->GetRecordCount() : '';

	echo '<div class="wrapper">

      <header class="main-header"><a href="index.php" class="logo"><span class="logo-mini"><b>F</b>PT</span><span class="logo-lg"><b>Regnum</b>PT</span></a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="http://icons.iconarchive.com/icons/graphicloads/100-flat/256/contact-icon.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">'.Request::getSession('account').'</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="http://icons.iconarchive.com/icons/graphicloads/100-flat/256/contact-icon.png" class="img-circle" alt="User Image">
                    <p>
                      '.Request::getSession('account').'
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="?page=Login&action=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">

          <!-- Search Menu -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>

          <!-- Menu Lateral -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVEGATION</li>
            <li class="menufpt"><a href="?page=Main"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
              <a href="#"><i class="fa fa-user"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=user&addcredits">Add Credits</a></li>
                <li><a href="?page=user&search">Search User</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Game Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=game&aginglist">Aging List</a></li>
                <li><a href="#">Mix List</a></li>
                <li><a href="?page=game&droplist">Drop List</a></li>
                <li><a href="#">Item List</a></li>
                <li><a href="#">Maps</a></li>
                <li><a href="#">Monster List</a></li>
                <li><a href="#">NPC List</a></li>
                <li><a href="?page=game&questlist">Quest List</a></li>
                <li><a href="?page=game&questreward">Quest Reward List</a></li>
              </ul>
            </li>
            <li class="menufpt"><a href="?page=logs&search"><i class="fa fa-edit fa-fw"></i> <span>Logs</span></a></li>
            <li><a href="?page=support"><i class="fa fa-support fa-fw"></i> <span>Support Tickets</span><small class="label pull-right bg-green">'.$newTickets.'</small></a></li>
            <li><a href="?page=maintenance"><i class="fa fa-wrench fa-fw"></i> <span>Maintenance</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-globe"></i> <span>WebSite</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=website&listnotices">Edit Notices</a></li>
				        <li><a href="?page=website&listquests">Edit Quests</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-shopping-cart"></i> <span>Coin Shop Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=coin&itemlist">Coin Shop Item</a></li>
				<li><a href="?page=coin&tab">Coin Shop Tab</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>';

?>