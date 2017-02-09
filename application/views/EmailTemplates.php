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
                if(isset($EmailTemplateInfo)){
                  ?>
                  <h4 style="margin:0px; font-weight: bold">Edit Email Template</h4>
                <?php } else { ?>
                  <h4 style="margin:0px; font-weight: bold">Create New Email Template</h4>
                <?php } ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
                if(isset($EmailTemplateInfo)){
                ?>
                <form role="form" method="post" action="<?php echo site_url("EmailTemplates/Edit/".$EmailTemplateInfo[0]->email_tmpl_id)?>">
                <?php } else {?>
                <form role="form" method="post" action="<?php echo site_url("EmailTemplates")?>">
                <?php } ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Template Title</label>
                      <input type="text" value="<?php echo @$EmailTemplateInfo[0]->email_tmpl_title?>" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter a Title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Template Subject</label>
                      <input type="text" value="<?php echo @$EmailTemplateInfo[0]->email_tmpl_subject?>" name="subject" class="form-control" id="exampleInputEmail1" placeholder="Enter Subject">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Template Content</label>
                      <textarea class="textarea" name="content" placeholder="Template content goes here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo @$EmailTemplateInfo[0]->email_tmpl_content?>
                      </textarea>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <?php
                    if(isset($EmailTemplateInfo)){
                    ?>
                    <button type="submit" name="edit_template" value="true" class="btn btn-primary">Submit</button>
                    <?php } else { ?>
                    <button type="submit" name="new_template" value="true" class="btn btn-primary">Submit</button>
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
                        <th>Template Title</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($EmailTemplates)>0){
                      foreach($EmailTemplates as $EmailTemplate){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("EmailTemplates/edit/".$EmailTemplate->email_tmpl_id)?>"><?php echo $EmailTemplate->email_tmpl_id?></a></td>
                          <td><a href="<?php echo site_url("EmailTemplates/edit/".$EmailTemplate->email_tmpl_id)?>"><?php echo $EmailTemplate->email_tmpl_title?></a></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Template Title</th>
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
