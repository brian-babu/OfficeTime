  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $profile_pic?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $name?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <li class="<?php if(substr_count(current_url(),"Dashboard")>0) {?> active <?php } ?>">
              <a href="<?php echo site_url("Dashboard")?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="<?php if(substr_count(current_url(),"Clients")>0) {?> active <?php } ?>">
              <a href="<?php echo site_url("Clients")?>">
                <i class="fa fa-users"></i>
                <span>Clients</span>
              </a>
            </li>
            <li class="<?php if(substr_count(current_url(),"Service")>0) {?> active <?php } ?>">
              <a href="<?php echo site_url("ServiceTypes")?>">
                <i class="fa fa-laptop"></i>
                <span>Service Types</span>
              </a>
            </li>
            <li class="<?php if(substr_count(current_url(),"Renewables")>0) {?> active <?php } ?>">
              <a href="<?php echo site_url("Renewables")?>">
                <i class="fa fa-refresh"></i>
                <span>Renewables</span>
              </a>
            </li>
            <!-- <li class="treeview <?php if(substr_count(current_url(),"Projects")>0) {?> active <?php } ?>">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Projects - TBD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Project</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Edit Project</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Manage Tasks</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Add New Task</a></li>
              </ul>
            </li>
            <li class="<?php if(substr_count(current_url(),"Invoices")>0) {?> active <?php } ?>">
              <a href="<?php echo site_url("Invoices")?>">
                <i class="fa fa-edit"></i>
                <span>Invoices - TBD</span>
              </a>
            </li>-->
            <li>
              <a href="<?php echo site_url("Quotations")?>">
                <i class="fa fa-book"></i> <span>Quotations</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("Invoice")?>">
                <i class="fa fa-dollar"></i> <span>Invoice</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("Expenses")?>">
                <i class="fa fa-money"></i> <span>Expenses</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("Projects")?>">
                <i class="fa fa-cogs"></i> <span>Projects</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("Projects")?>">
                <i class="fa fa-edit"></i> <span>To Do List</span>
              </a>
            </li>
            <li class="treeview <?php if(substr_count(current_url(),"Users")>0||
            substr_count(current_url(),"EmailTemplates")>0) { ?> active <?php } ?>">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>App Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url("EmailTemplates")?>"><i class="fa fa-envelope"></i> Email Templates</a></li>
                <li><a href="<?php echo site_url("Users")?>"><i class="fa fa-user"></i>Users</a></li>
                <!-- <li><a href="<?php echo site_url("Pages")?>"><i class="fa fa-file"></i>Pages</a></li>-->
                <li><a href="<?php echo site_url("Users/Permissions")?>"><i class="fa fa-ban"></i> User Permissions</a></li>
              </ul>
            </li>
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>