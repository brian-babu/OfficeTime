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
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/dist/css/skins/_all-skins.min.css">

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
            <small>Manage User Access to Pages </small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Users</th>
                        <?php foreach($Pages as $page) { ?>
                        <th><?php echo $page->page_name;?></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($Users as $user) {
                      ?>
                      <tr>
                        <td><?php echo $user->name?></td>
                        <?php
                        foreach($Pages as $page) {
                        ?>
                          <td>
                          <?php
                            echo "
                            <div id='results_".$page->page_id."_".$user->ID."'>
                            <input type='hidden' name='page_id' id='page_id_".$page->page_id."' value='".$page->page_id."'>
                            <input type='hidden' name='user_id' id='user_id_".$user->ID."' value='".$user->ID."'>
                            ";
                            echo "<input type='checkbox' name='user_page_access' id='user_page_access_".$page->page_id."_".$user->ID."'";

                            foreach ($user_perms as $perms) {
                              if($perms['userid']==$user->ID) {
                                if($perms['pageid']==$page->page_id){
                                  if($perms['pageaccess']==1){
                                  echo " checked ";
                                  }
                                }
                              }
                            }

                          echo " > </div>";
                            }
                          ?>
                          </td>
                        <?php
                        }
                        ?>
                      </tr>
                      <?php
                    //}
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Users</th>
                        <?php
                        foreach($Pages as $page)
                        {
                        ?>
                        <th><?php echo $page->page_name?></th>
                        <?php                          
                        }
                        ?>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    
<?php include("footer.php"); ?>

      <!-- Control Sidebar -->
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
        
        $("#example1").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": true
        });

      <?php
      foreach ($Users as $user) {
        for($i=0;$i<count($Pages);$i++) {
        ?>
        $('#user_page_access_<?php echo $Pages[$i]->page_id."_".$user->ID;?>').click(function() {
          var form_data = {
            page_id: $('#<?php echo "page_id_".$Pages[$i]->page_id;?>').val(),
            user_id: $('#<?php echo "user_id_".$user->ID;?>').val(),
          };
          $.ajax({
            url: "<?php echo site_url('Users/access_change')?>", /* update the page id access for the selected user */
            type: 'POST',
            data: form_data,
            cache: false,
            success: function(msg){
              console.log(msg);
//              if(msg==1){
              /*
                $('#results_<?php echo $Pages[$i]->page_id."_".$user->ID;?>').html("<span class='toggle_<?php echo $Pages[$i]->page_id."_".$user->ID;?>' style='color: green'><i class='fa fa-check'></i></span>");*/
  //            $('input:checkbox[name=toggle_<?php echo $Pages[$i]->page_id."_".$user->ID;?>]').attr('checked',true);
    //          }
      //        else {
              /*
                $('#results_<?php echo $Pages[$i]->page_id."_".$user->ID;?>').html("<span class='toggle_<?php echo $Pages[$i]->page_id."_".$user->ID;?>' style='color: red'><i class='fa fa-lock'></i></span>");*/
//              $('input:checkbox[name=toggle_<?php echo $Pages[$i]->page_id."_".$user->ID;?>]').attr('checked',false);
  //            }
            }
          });
        });
        <?php
        }
      }
      ?>
      });
    </script>
  </body>
</html>
