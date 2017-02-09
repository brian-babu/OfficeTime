<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $app_name?> | <?php echo $title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include("topbar.php"); ?>
    
    

      <!-- Left side column. contains the logo and sidebar -->
      <?php include("sidebar.php"); ?>
     
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title?>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
<div class="row">
  <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($Users)>0){
                      $i=1;
                      foreach($Users as $User){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("Users/edit/".$User->ID)?>"><?php echo $i++?></a></td>
                          <td><a href="<?php echo site_url("Users/edit/".$User->ID)?>"><?php echo $User->name?></a></td>
                          <td><a href="<?php echo site_url("Users/edit/".$User->ID)?>"><?php echo $User->mobile?></a></td>
                          <td><a href="<?php echo site_url("Users/edit/".$User->ID)?>"><?php echo $User->email?></a></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                  </div>
  </div>
</div>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <?php if(isset($errors)) {
                ?> <div class="alert alert-danger alert-dismissable"> <?php 
                  foreach($errors as $error){
                  echo $error."<br>";
                  }
                ?> </div> <?php 
                }?>
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                 <h4 style="font-weight: bold; margin:0px;">
                 <?php if(isset($UserInfo)){ ?> Edit User Info <?php } 
                 else { ?> Create New Users <?php } ?></h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php if(!isset($UserInfo)) {?>
                <form role="form" method="post" action="<?php echo site_url("Users")?>">
                <?php } else { ?>
                <form role="form" method="post" action="<?php echo site_url("Users/edit/".$UserInfo[0]->ID)?>">
                <?php
                } ?>
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputContactName">Name</label>
                      <input type="text" name="name" value="<?php echo @$UserInfo[0]->name?>" class="form-control" id="exampleInputContactName" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputemail">Email</label>
                      <input type="text" name="email" value="<?php echo @$UserInfo[0]->email?>" class="form-control" id="exampleInputemail" placeholder="Enter Email">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputmobile">Mobile</label>
                      <input type="text" name="mobile" value="<?php echo @$UserInfo[0]->mobile?>" class="form-control" id="exampleInputmobile" placeholder="Enter Mobile Number">
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputemail">Username</label>
                        <input type="text" name="username" 
                        <?php if(isset($UserInfo)) {?> disabled <?php } ?> 
                        value="<?php echo @$UserInfo[0]->username?>" class="form-control" id="exampleInputemail" placeholder="Enter Username">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputemail">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputpassword" placeholder="Enter Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputemail">Re-Type Password</label>
                        <input type="password" name="retype_password" class="form-control" id="exampleInputpassword" placeholder="Enter Password">
                      </div>
                    </div>
                  <?php if(!isset($UserInfo)) {?>
                    <input type="checkbox" name="send_config"> Send Email Configuration to the User
                  <?php } ?>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                  <?php if(!isset($UserInfo)) {?>
                    <button type="submit" name="add_user" value="1" class="btn btn-primary">Submit</button>
                  <?php } else { ?>
                    <button type="submit" name="edit_user" value="1" class="btn btn-primary">Submit</button>
                  <?php } ?>
                  </div>
                </form>
              </div><!-- /.box -->

              <!-- Form Element sizes -->





            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
     
      <?php include("footer.php"); ?>
     
     <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url()?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url()?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>/assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>/assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>/assets/dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
