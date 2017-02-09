<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $app_name?> | <?php echo $title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/dist/css/real-world.css">
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
          <h1><?php echo $title?>            
          </h1>
          
        </section>

        <!-- Main content -->
        <?php if(count($expires_7)>0||
        count($expires_15)>0||
        count($expires_30)>0) { ?>
        <section class="content" style="min-height: 0px;">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <?php
            if(isset($free_service_expiry)){ 
              ?>
            <div class="alert alert-warning alert-dismissable">
            <h4><i class="icon fa fa-warning"></i> ATTENTION: These Special Accounts are about to expire in 7 Days!</h4>
              <ol>
              <?php 
              foreach($free_service_expiry as $record){
                ?>
                <li><?php echo $record->towards." expires on <b>".str_replace("00:00:00 CET","",standard_date("DATE_RFC850",$record->expiry_date))."</b>"?><br>
                  <?php if(isset($record->sent_date)) { ?>
                  <em>Last notification sent on <span class="blink"><?php echo removetime($record->sent_date);?></span></em>
                  <?php } else { ?><em>No notifications sent </em><?php } ?>
                </li>
                <?php
              }
              foreach($free_service_expiry as $ID){
                $expired_services[]=$ID->ID;
              }
              ?>
              </ol>
            </div>
            <?php } ?>
            <?php if(isset($expired)) { ?>
            <div class="alert alert-danger alert-dismissable">
            <table width="100%">
            <tr><td>
            <h4><i class="icon fa fa-warning"></i> ATTENTION: The Following Services have Expired!</h4>
              <ol>
              <?php 
              foreach($expired as $record){
                ?>
                <li><?php echo $record->towards." expires on <b>".removetime($record->expiry_date)."</b>"?><br><?php if(isset($record->sent_date)) { ?>
                  <em>Last notification sent on <span class="blink"><?php echo removetime($record->sent_date);?></span></em>
                  <?php } else { ?><em>No notifications sent </em><?php } ?>
                </li>
                <?php
              }
              foreach($expired as $ID){
                $expired_services[]=$ID->ID;
              }
              ?>
              </ol>
            </td><td valign="top">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <form method="post" action="<?php echo site_url("Renewables/NotifyUser/");?>" align="right">
            <input type="hidden" name="notify_type" value="expired">
            <input type="hidden" name="HA_ids" value="<?php echo implode("/",$expired_services); ?>">
            <button class="btn btn-warning btn-md"><i class="fa fa-envelope"></i> Notify Clients</button>
            </form>
            </td></tr>
            </table>
            </div>
            <?php } ?>


            <?php if(isset($expires_7)) {?>
            <div class="alert alert-danger alert-dismissable">
            <table width="100%">
            <tr><td>
            <h4><i class="icon fa fa-warning"></i> ATTENTION: The Following Services Expire in 7 Days!</h4>
              <ol>
              <?php 
              foreach($expires_7 as $record){
                ?>
                <li><?php echo $record->towards." expires on <b>".removetime($record->expiry_date)."</b>"?><br><?php if(isset($record->sent_date)) { ?>
                  <em>Last notification sent on <span class="blink"><?php echo removetime($record->sent_date);?></span></em>
                  <?php } else { ?><em>No notifications sent </em><?php } ?>
                </li>
                <?php 
              }
              foreach($expires_7 as $ID){
                $expire7_services[]=$ID->ID;
              }
              ?>
              </ol>
            </td><td valign="top">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <form method="post" action="<?php echo site_url("Renewables/NotifyUser/");?>" align="right">
            <input type="hidden" name="notify_type" value="expire_7">
            <input type="hidden" name="HA_ids" value="<?php echo implode("/",$expire7_services); ?>">
            <button class="btn btn-warning btn-md"><i class="fa fa-envelope"></i> Notify Clients</button>
            </form>
            </td></tr>
            </table>
            </div>
            <?php } ?>


            <?php if(isset($expires_15)) {?>
            <div class="alert alert-danger alert-dismissable">
              <table width="100%">
              <tr><td>
              <h4><i class="icon fa fa-warning"></i> Services Expiring in 15 days!</h4>
              <ol>
              <?php 
              foreach($expires_15 as $record){
                ?>
                <li><?php echo $record->towards." expires on <b>".removetime($record->expiry_date)."</b>"?><br><?php if(isset($record->sent_date)) { ?>
                  <em>Last notification sent on <span class="blink"><?php echo removetime($record->sent_date);?></span></em>
                  <?php } else { ?><em>No notifications sent </em><?php } ?>
                </li>
                <?php
              }
              foreach($expires_15 as $ID){
                $expire15_services[]=$ID->ID;
              }
              ?>
              </ol>
              </td><td valign="top">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <form method="post" action="<?php echo site_url("Renewables/NotifyUser/");?>" align="right">
              <input type="hidden" name="notify_type" value="expire_15">
              <input type="hidden" name="HA_ids" value="<?php echo implode("/",$expire15_services); ?>">
              <button class="btn btn-warning btn-md"><i class="fa fa-envelope"></i> Notify Clients</button>
              </form>
            </td></tr>
            </table>
            </div>
            <?php } ?>
            <?php if(isset($expires_30)) {?>
            <div class="alert alert-warning alert-dismissable">
            <table width="100%">
            <tr><td>
              <h4><i class="icon fa fa-warning"></i> Services Expiring in 30 days!</h4>
              <ol>
              <?php 
              foreach($expires_30 as $record){
                ?>
                <li><?php echo $record->towards." expires on <b>".removetime($record->expiry_date)."</b>"?><br><?php if(isset($record->sent_date)) { ?>
                  <em>Last notification sent on <span class="blink"><?php echo removetime($record->sent_date);?></span></em>
                  <?php } else { ?><em>No notifications sent </em><?php } ?>
                </li>
                <?php
              }
              foreach($expires_30 as $ID){
                $expire30_services[]=$ID->ID;
              }
              ?>
              </ol>
            </td><td valign="top">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <form method="post" action="<?php echo site_url("Renewables/NotifyUser/");?>" align="right">
            <input type="hidden" name="notify_type" value="expire_30">
            <input type="hidden" name="HA_ids" value="<?php echo implode("/",$expire30_services); ?>">
            <button class="btn btn-success btn-md"><i class="fa fa-envelope"></i> Notify Clients</button>
            </form>
            </td></tr>
            </table>
            </div>
            <?php } ?>
            </div>
          </div>
        </section>
        <?php } ?>
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                 <h4 style="font-weight: bold; margin:0px;">
                 <?php if(isset($RenewablesInfo)){ ?> Edit Renewables Info <?php } 
                 else { ?> Create New Renewables <?php } ?></h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php if(isset($RenewablesInfo)){ ?>
                <form role="form" method="post" action="<?php echo site_url("Renewables/edit/".$RenewablesInfo[0]->ID)?>">
                <?php } else { ?>
                <form role="form" method="post" action="<?php echo site_url("Renewables")?>">

                <?php
                }
                ?>
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputclien">Client</label>
                      <select name="client"  class="form-control" id="exampleInputClient" placeholder="choose client">
                      <option>Choose a client</option>
                     <?php
                     foreach($Clients as $Client){
                     ?>
                      <option 
                      <?php
                        if(isset($RenewablesInfo)){
                          if($RenewablesInfo[0]->client_ID==$Client->client_ID){
                            echo " selected ";
                          }
                        }
                      ?>
                      value="<?php echo $Client->client_ID?>"><?php echo $Client->company_name."   [$Client->title ".$Client->contact_name." - ".$Client->mobile."]";?></option>
                    <?php
                    }
                    ?>
                       </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputtowards">Renewal for</label>
                      <input type="text" value="<?php echo @$RenewablesInfo[0]->towards; ?>" name="towards" class="form-control" id="exampleInputtowards" placeholder="Eg: 'example.com' or 'Hosting Service for example.com'">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputservice_type">Service Type</label>
                    <?php
                    if(count($ServiceTypes)>0)
                      foreach($ServiceTypes as $Service){
                        ?>
                      <div class="radio">
                        <label>
                          <input
                          <?php
                            if(isset($RenewablesInfo)){
                              if($RenewablesInfo[0]->service_type_ID==$Service->service_type_ID){
                                echo " checked ";
                              }
                            }
                          ?>
                          type="radio" name="service_type" value="<?php echo $Service->service_type_ID?>"> <?php echo $Service->name?>
                        </label>
                      </div>
                        <?php
                      }
                    else
                        echo "<br><a href=".site_url("ServiceTypes").">Create New Service Type</a>";
                    ?>                    
                    </div>
                     <div class="form-group">
                      <label for="exampleInputcharge">Charge (OMR)</label>
                      <input type="text" name="charge" value="<?php echo @$RenewablesInfo[0]->charge; ?>"  class="form-control" id="exampleInputcreation_date" placeholder="How much did you quote?">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputcreation_date">Creation Date</label>
                      <input type="text" id="datepicker" value="<?php if(isset($RenewablesInfo)){ $date=explode("T",standard_date("DATE_W3C",@$RenewablesInfo[0]->creation_date)); echo $date[0]; } ?>"  name="creationdate" class="form-control" id="exampleInputcreation_date" placeholder="Choose Creation Date">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputexpiry_date">Expiry Date</label>
                      <input type="text" id="datepicker2" value="<?php if(isset($RenewablesInfo)){ $date=explode("T",standard_date("DATE_W3C",@$RenewablesInfo[0]->expiry_date)); echo $date[0]; } ?>" name="expirydate" class="form-control" id="exampleInputexpiry_date" placeholder="Choose Expiry Date">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputcreation_date">Remarks</label>
                      <textarea name="remarks" style="width: 100%" class="form-control" rows="10"><?php echo @$RenewablesInfo[0]->remarks; ?></textarea>
                      
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  <?php if(isset($RenewablesInfo)){ ?>
                    <button type="submit" name="edit_account" value="true" class="btn btn-primary">Submit</button>
                    <?php } else {?>
                    <button type="submit" name="add_account" value="true" class="btn btn-primary">Submit</button>
                    <?php } ?>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-8">

              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Renewal For</th>
                        <th>Service Type</th>
                        <th>Charge (OMR)</th>
                        <th>Expiry</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($Renewables)>0){
                    $i=1;
                      foreach($Renewables as $Account){
                        ?>
                        <tr>
                          <td><a href="<?php echo site_url("Renewables/edit/".$Account->ID)?>"><?php echo $i++?></a></td>
                          <td><a href="<?php echo site_url("Renewables/edit/".$Account->ID)?>"><?php echo $Account->towards?></a></td>
                          <td><a href="<?php echo site_url("Renewables/edit/".$Account->ID)?>"><?php echo $Account->name?></a></td>
                          <td><a href="<?php echo site_url("Renewables/edit/".$Account->ID)?>"><?php echo $Account->charge?></a></td>
                          <td><a href="<?php echo site_url("Renewables/edit/".$Account->ID)?>"><?php echo removetime($Account->expiry_date);?></a></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Renewal For</th>
                        <th>Service Type</th>
                        <th>Charge (OMR)</th>
                        <th>Expiry</th>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
              
            </div>
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
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">
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
        $( "#datepicker" ).datepicker({
              dateFormat : 'yy-mm-dd'
        });
        $( "#datepicker2" ).datepicker({
              dateFormat : 'yy-mm-dd'
        });
      });
    </script>
  </body>
</html>