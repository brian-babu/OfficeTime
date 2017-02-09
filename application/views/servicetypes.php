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
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                
                <!-- form start -->
                <?php
                if(isset($ServiceTypeInfo)){
                  ?>
                <form role="form" action="<?php echo site_url("ServiceTypes/edit/".$ServiceTypeInfo[0]->service_type_ID)?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputtype">Edit Service Type</label>
                      <input type="text" value="<?php echo $ServiceTypeInfo[0]->name?>" name="service_type" class="form-control" id="exampleInputtype" placeholder="Enter Service Type">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputtype">Is This is a Renewable Service</label>
                      <div class="checkbox">
                        <label>
                          <input
                          <?php
                          if($ServiceTypeInfo[0]->renewable==true) { echo " checked ";}
                          ?>
                          type="checkbox" name="renewable"> Renewable Service
                        </label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                  <?php
                }
                else{
                ?>
                <form role="form" action="<?php echo site_url("ServiceTypes")?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputtype">Add New Service Type</label>
                      <input type="text" name="service_type" class="form-control" id="exampleInputtype" placeholder="Enter Service Type">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputtype">Is This is a Renewable Service</label>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="renewable"> Renewable Service
                        </label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->

              <!-- Form Element sizes -->





            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                   
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>No. of Clients</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($ServiceTypes)>0){
                      foreach($ServiceTypes as $Service){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("ServiceTypes/edit/".$Service->service_type_ID)?>"><?php echo $Service->service_type_ID?></a></td>
                          <td><a href="<?php echo site_url("ServiceTypes/edit/".$Service->service_type_ID)?>"><?php echo $Service->name?></a></td>
                          <td> <?php echo $Service->num_clients?></td>
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
                        <th>No. of Clients</th>
                      </tr>
                    </tfoot>
                  </table>
                   
                   
                  </div><!-- /.box-body -->


                </form>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
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
