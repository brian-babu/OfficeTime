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
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo base_url()?>/assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="<?php echo base_url()?>/assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                <?php
                if(isset($PageInfo)){
                  ?>
                  <h4 style="margin:0px; font-weight: bold">Edit Page</h4>
                <?php } else { ?>
                  <h4 style="margin:0px; font-weight: bold">Add New Page</h4>
                <?php } ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
                if(isset($PageInfo)){
                ?>
                <form role="form" method="post" action="<?php echo site_url("Pages/Edit/".$PageInfo[0]->page_id)?>">
                <?php } else {?>
                <form role="form" method="post" action="<?php echo site_url("Pages")?>">
                <?php } ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Name</label>
                      <input type="text" value="<?php echo @$PageInfo[0]->page_name?>" name="page_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Page Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Controller</label>
                      <input type="text" value="<?php echo @$PageInfo[0]->page_controller?>" name="page_controller" class="form-control" id="exampleInputEmail1" placeholder="Enter Page Controller">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Icon (Font Awesome Icons)</label>
                      <input type="text" value="<?php echo @$PageInfo[0]->page_icon?>" name="page_icon" class="form-control" id="exampleInputEmail1" placeholder="Enter Page Icon">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">Page Order</label>
                      <input type="text" value="<?php echo @$PageInfo[0]->page_order?>" name="page_order" class="form-control" id="exampleInputEmail1" placeholder="Enter Page Order">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page Parent</label>
                      <select name="page_parent" class="form-control">
                      <option value="0">No Parent Page</option>
                      <?php
                      foreach ($Pages as $page) {
                        ?>
                          <option value="<?php echo $page->page_id?>">
                          <?php echo $page->page_name ?>
                          </option>
                        <?php
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Default Page Access</label>
                      <div class="radio">
                      <label>
                      <input type="radio" value="0" <?php if(@$PageInfo[0]->page_default_access==0) echo " checked ";?> name="page_default_access" id="optionsRadios2"> No
                      </label>
                      </div>
                      <div class="radio">
                      <label>
                      <input type="radio" value="1" <?php if(@$PageInfo[0]->page_default_access==1) echo " checked ";?> name="page_default_access" id="optionsRadios2"> Yes
                      </label>
                      </div>
                      </label>
                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <?php
                    if(isset($PageInfo)){
                    ?>
                    <button type="submit" name="edit_page" value="true" class="btn btn-primary">Submit</button>
                    <?php } else { ?>
                    <button type="submit" name="new_page" value="true" class="btn btn-primary">Submit</button>
                    <?php } ?>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                   
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Page Name</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($Pages)>0){
                      $i=1;
                      foreach($Pages as $Page){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("Pages/edit/".$Page->page_id)?>"><?php echo $i++?></a></td>
                          <td><a href="<?php echo site_url("Pages/edit/".$Page->page_id)?>"><i class="<?php echo $Page->page_icon?>" style="padding-right: 5px;"></i> <?php echo $Page->page_name?></a></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Page Name</th>
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
    <!-- FastClick -->
    <script src="<?php echo base_url()?>/assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>/assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>/assets/dist/js/demo.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
      $(function () {

function create_btn(title,icon){
   btn = '<li class="dropdown">'
   btn += '<a class="btn btn-default" data-toggle="dropdown">'
   btn += '<span> '+title+' </span> <b class="caret"></b></a>'
   btn += '<ul class="dropdown-menu">'
   btn += '<li><a data-wysihtml5-command="insertHTML" data-wysihtml5-command-value="{service_type_name}">Service Type Name</a></li>'
   btn += '<li><a data-wysihtml5-command="insertHTML" data-wysihtml5-command-value="{expiry_date}">Expiry Date</a></li>'
   btn += '<li><a data-wysihtml5-command="insertHTML" data-wysihtml5-command-value="{client_title}">Client Title</a></li>'
   btn += '<li><a data-wysihtml5-command="insertHTML" data-wysihtml5-command-value="{client_name}">Client Name</a></li>'
   btn += '</ul></li>';
   return btn;
}

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        myButton = create_btn('Custom Values','fa fa-edit'); // Generate the button HTML
        $(".wysihtml5-toolbar").append(myButton) // Append the button

      });
    </script>
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
