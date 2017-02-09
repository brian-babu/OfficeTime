<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $app_name?> | <?php echo $title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet"href="<?php echo base_url()?>/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet"href="<?php echo base_url()?>/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet"href="<?php echo base_url()?>/assets/dist/css/skins/_all-skins.min.css">
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
<?php
foreach ($client_account_info as $item) {
  foreach ($item as $value) {
    $client_info[]=$value;
  }
}
//var_dump($client_info);
?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                <table width="100%">
                <tr><td>
                  <h3 class="box-title">Send Notifications</h3></td><td>
                  <button type="submit" id="preview" style="float: right" class="btn btn-sm btn-primary">Preview</button>
                </td></tr>
                </table>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>Notification Type</label><br>
                      <?php 

                      switch($notify_type){
                        case "expire_7":
                        echo "7 days";
                        ?><input type="hidden" name="expiry_days" value="7"><?php
                        break;

                        case "expire_15":
                        echo "15 days";
                        ?><input type="hidden" name="expiry_days" value="15"><?php
                        break;

                        case "expire_30":
                        echo "30 days";
                        ?><input type="hidden" name="expiry_days" value="30"><?php
                        break;

                        default:
                        echo "Expired";
                        break;
                      }
                      ?>
                    </div>
                    <div class="form-group">
                      <label>Email Recipients</label>
                        <?php foreach ($client_info as $value) {
                          $expiry_date=str_replace(" 00:00:00 CET","",standard_date("DATE_RFC850",$value->expiry_date));
                          echo "<br>".$value->title." ".$value->contact_name." [ ".$value->towards." ] - ";
                          echo $expiry_date;
                        } ?>
                    </div>
                    <div class="form-group">
                      <label>Email Template</label>
                      <select class="form-control" name="email_template" id="emailtemplate">
                      <option value="0">Choose a template...</option>
                      <?php
                      foreach($EmailTemplates as $tmpl){
                        ?>
                        <option value="<?php echo $tmpl->email_tmpl_id;?>"><?php echo $tmpl->email_tmpl_title ?></option>
                        <?php
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject Here">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Your Content</label>

                      <div class="textarea" style="overflow: scroll; width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      </div>
                    </div>
                  </div><!-- /.box-body --

                  <div class="box-footer">
                  </div>-->
              </div><!-- /.box -->



            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
               <div class="box box-solid message_preview" style="display: none">
                <div class="box-header with-border">
                <table width="100%">
                <tr><td>
                  <h3 class="box-title">Message Previews</h3></td><td>
                  <form action="<?php echo site_url("HostingAccounts/SendNotification")?>" method="post">
                  <input type="hidden" name="ha_ids" value="<?php echo $ha_ids?>">
                  <input type="hidden" name="email_tmpl_id" id="email_tmpl_id" value="">
                  <input type="hidden" name="email_tmpl_subject" id="email_tmpl_subject" value="">
                  <input type="hidden" name="email_tmpl_content" id="email_tmpl_content" value="">
                  <button type="submit" style="float: right" class="send btn btn-sm btn-primary"><i class="fa fa-envelope"></i> Send Notification(s)</button>
                  <style>.send:hover{     background-color: #00a65a !important; border-color: #008d4c !important;}</style>
                  </form>
                  </td></tr>
                </table>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->


                  </div>
                </div><!-- /.box-body -->
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
    <!-- FastClick -->
    <script src="<?php echo base_url()?>/assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>/assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>/assets/dist/js/demo.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
$(document).ready(function(){   

      $("#emailtemplate").change(function() {
        var form_data = {
          email_tmpl_id: $('#emailtemplate').val(),
        };
          $('#email_tmpl_id').val($('#emailtemplate').val());
        $.ajax({
          url: "<?php echo site_url("HostingAccounts/NotifyUser_fetchcontent");?>",
          type: 'POST',
          data: form_data,
          cache: false,
          dataType: 'json',
          success: function(msg){
            console.log(msg);
          output="";  
            for (var i in msg)
            {
                output+=msg[i].subject;
            }
            output+="";
           $('#subject').val(output);
            $('#email_tmpl_subject').val($('#subject').val());

          output1="";  
            for (var j in msg)
            {
                output1+=msg[j].content;
            }
            output1+="";
            $('.textarea').html(output1);
            $('#email_tmpl_content').val($('.textarea').html()); // for preview purpose
          }
        });
        return false;
      });

      $('#preview').click(function() {
        if($('#emailtemplate').val()==0){
          alert("You numb nut select a value!");
        }
        else
        {
          var form_data = {
            ha_ids: "<?php echo $ha_ids;?>",
            email_tmpl_id: $('#emailtemplate').val(),
            email_tmpl_subject: $('#subject').val(),
            email_tmpl_content: $('.textarea').html(),
          };
          $.ajax({
            url: "<?php echo site_url("HostingAccounts/NotifyUser_Previews/1");?>",
            type: 'POST',
            data: form_data,
            dataType: 'json',
            success: function(msg1){
              //alert(msg1);
            console.log(msg1);
            $('.message_preview').hide().fadeIn('slow');
            var output3="";
            $( "#accordion" ).empty();
            for (var k in msg1)
            {
                output3="<div class='panel box box-primary'>";
                output3+="<div class='box-header with-border'>";
                output3+="<h4 class='box-title'>";
                output3+="<a data-toggle='collapse' data-parent='#accordion' href='#collapse";
                output3+=k+"";
                output3+="'>";
                output3+="Message for " + msg1[k].name + " ( " + msg1[k].towards + ")";
                output3+="</a>";
                output3+="</h4>";
                output3+="</div>";
                output3+="<div id='collapse";
                output3+=k+"";
                output3+="' class='panel-collapse collapse";
                output3+=" '>";
                output3+="<div class='box-body'> <b>Subject:</b> " + msg1[k].subject + "<br><br>" + msg1[k].content;
                output3+="</div>";
                output3+="</div>";
                output3+="</div>";
                $( "#accordion" ).append( output3 );
            }
            }
          });
        }
        return false;
      });
}); 
    </script>
  </body>
</html>
