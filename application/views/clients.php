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
                        <th>Contact Name</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($clients)>0){
                      $i=1;
                      foreach($clients as $client){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("clients/edit/".$client->client_ID)?>"><?php echo $i++?></a></td>
                          <td><a href="<?php echo site_url("clients/edit/".$client->client_ID)?>"><?php echo $client->title.$client->contact_name?></a></td>
                          <td><a href="<?php echo site_url("clients/edit/".$client->client_ID)?>"><?php echo $client->company_name?></a></td>
                          <td><a href="<?php echo site_url("clients/edit/".$client->client_ID)?>"><?php echo $client->mobile?></a></td>
                          <td><a href="<?php echo site_url("clients/edit/".$client->client_ID)?>"><?php echo $client->email?></a></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Contact Name</th>
                        <th>Company</th>
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
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                 <h4 style="font-weight: bold; margin:0px;">
                 <?php if(isset($clientInfo)){ ?> Edit client Info <?php } 
                 else { ?> Create New client <?php } ?></h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php if(!isset($clientInfo)) {?>
                <form role="form" method="post" action="<?php site_url("clients")?>">
                  <div class="box-body">
                  <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputtitle">Title</label>
                      <select name="title" class="form-control" id="exampleInputTitle" placeholder="choose title">
                     
                    <option value="Mr.">Mr</option>
                      <option value="Mrs.">Mrs</option>
                       </select>
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCompanyname">Company name</label>
                      <input type="text" name="company_name" class="form-control" id="exampleInputCompanyname" placeholder="Enter Company Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputContactName">Contact Name</label>
                      <input type="text" name="contact_name" class="form-control" id="exampleInputContactName" placeholder="Enter Contact Name">
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputemail">Email</label>
                      <input type="text" name="email" class="form-control" id="exampleInputemail" placeholder="Enter email">
                      <p class="help-block">Separate multiple emails with ;</p>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputmobile">Mobile</label>
                      <input type="text" name="mobile" class="form-control" id="exampleInputmobile" placeholder="Enter Mobile Number" required>
                    </div>                   
                   </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" name="add_client" value="1" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              <?php } 
                else { ?>
                <form role="form" method="post" action="<?php site_url("clients/edit/".$clientInfo[0]->client_ID)?>">
                  <div class="box-body">
                    <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputtitle">Title</label>
                      <select name="title" class="form-control" id="exampleInputTitle" placeholder="choose title">
                     
                    <option <?php if($clientInfo[0]->title=="Mr.") echo " selected ";?> value="Mr.">Mr</option>
                      <option <?php if($clientInfo[0]->title=="Mrs.") echo " selected ";?> value="Mrs.">Mrs</option>
                       </select>
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCompanyname">Company name</label>
                      <input type="text" value="<?php echo $clientInfo[0]->company_name?>" name="company_name" class="form-control" id="exampleInputCompanyname" placeholder="Enter Company Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputContactName">Contact Name</label>
                      <input type="text" value="<?php echo $clientInfo[0]->contact_name?>" name="contact_name" class="form-control" id="exampleInputContactName" placeholder="Enter Contact Name">
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputemail">Email</label>
                      <input type="text" value="<?php echo $clientInfo[0]->email?>" name="email" class="form-control" id="exampleInputemail" placeholder="Enter email">
                      <p class="help-block">Separate multiple emails with ;</p>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputmobile">Mobile</label>
                      <input type="text" value="<?php echo $clientInfo[0]->mobile?>" name="mobile" class="form-control" id="exampleInputmobile" placeholder="Enter Mobile Number">
                    </div>                   
                   </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" name="edit_client" value="1" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                <?php } ?>
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
