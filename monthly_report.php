<?php
session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(),E_USER_ERROR);

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/author.png">
    <title> Reports</title>


    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <!--    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <!-- Ionicons -->
    <!--    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <!-- DATA TABLES -->
    <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
 



</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->


<div class="wrapper row-offcanvas row-offcanvas-left" >
    <!-- Left side column. contains the logo and sidebar -->

    <?php include('nav_left.php');?>

    <!-- /.sidebar -->

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side"style="margin-Left:175px;">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Small boxes (Stat box) -->
            <div class="row" style="/*border: 1px solid #000000; border-radius: 10px;*/">

                <h1 style="text-align: center"><i class="fa fa-calendar"></i> Monthly Report </h1>
            </div><!-- /.row -->

            <!-- top row -->

            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Box (with bar chart) -->
                    <div class="box box-danger" id="loading-example">
                        <br>
                        <div class="box-body no-padding" style="width: 100%">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                               <tr>
                                    <th style="text-align:center;">Sr No.</th>
                                    <th style="text-align:center;">Date / Time</th>
                                    <th style="text-align:center;">Test Nos</th>
                                    <!-- <th style="text-align:center;">Company</th> -->
                                    <!-- <th style="text-align:center;">Customer</th> -->
                                    <th style="text-align:center;">Valve Serial Number</th>
                                    <th style="text-align:center;">Valve Type</th>
                                    <th style="text-align:center;">Size</th>
                                    <th style="text-align:center;">Test Type</th>
                                    <th style="text-align:center;">Test Pressure</th>
                                    <th style="text-align:center;">Test Result</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                $datenow = date('Y-m-d');

                                $first_day_this_month = date('Y-m-01');
                                $datelast = new DateTime($datenow);

                                //Print out your desired result by using
                                //the format method
                                $dateah = $datelast->format('Y-m-t');
//                                echo $datelast->format('Y-m-t');
                              $fistdate=  date('Y-m-01');
//                                echo date('Y-m-01');

//                                $new_start_date=date_create($new_start_date);
//                                date_add($new_start_date,date_interval_create_from_date_string("1 days"));
//                                echo date_format("date is hear...".$new_start_date,"Y-m-d");





                                $date = date('Y-m-d');
                                //                            echo "The current server timezone is: " . $date;
                                // SELECT ti.`date_tim`,ti.`test_no`,ti.`company`,ti.`customer`,ti.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`pressure_end`,tr.`result` FROM `initial_valve_data_unit2` ti JOIN `test_result_unit2` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE ti.`date_tim` BETWEEN '$fistdate' AND '$dateah'

                                $sql = "SELECT ti.`date`,ti.`test_no`,ti.`vsn`,ti.`holding_set`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `valve_data` ti, test_result tr  WHERE ti.test_no = tr.test_no AND  ti.test_type = tr.test_type AND  ti.`date` BETWEEN '$fistdate' AND '$dateah'";

                                //                              $sql = "SELECT ti.`date_time`,ti.`test_no`,vd.`customer`,vd.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`pressure_end`,tr.`test_result` FROM `test_init` ti JOIN `valve_data` vd ON (ti.`test_no` = vd.`test_no` AND ti.`test_type` = vd.`test_type`) JOIN `test_result` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`)";
                                                   // echo $sql;

                                $qresult = $conn->query($sql);




                                if ($qresult->num_rows > 0) {
                                    // output data of each row


                                    $row = $qresult->fetch_assoc();
                                    $SR_NO=1;
                                     do { ?>
                                        <tr class="gradeU">
                                            <td align="center" valign="middle">
                                                <?php echo $SR_NO++; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php echo $row['date_tim']; ?>
                                            </td>
                                            <?php if ($row['test_type'] == "CAVITY RELIEF TEST") { echo 'before if';?>
                                                <td align="center" valign="middle">
                                                <?php echo $row['test_no']; ?>

                                                </td>
                                            <?php } else {   ?>
                                                <td align="center" valign="middle">
                                                <?php echo $row['test_no']; ?>

                                                </td>
                                            <?php } ?>
                                           <!--  <td align="center" valign="middle">
                                                <?php echo $row['company']; ?>
                                            </td> -->
                                           <!--  <td align="center" valign="middle">
                                                <?php echo $row['customer']; ?>
                                            </td> -->
                                            <?php
                                            if($row['valve_type']=='DOUBLE BLOCK BLEED VALVE'){?>
                                            <td align="center" valign="middle">
                                                <a href="new_vtr_reports_dbb.php?valve_serial_no=<?php echo $row['serial_number']; ?>&company=<?php echo $row['company'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['serial_number']; ?></b>
                                                </a>
                                            </td>
                                        <?php }
                                        else { ?>
                                                   <td align="center" valign="middle">
                                                   <a href="new_vtr_reports.php?valve_serial_no=<?php echo $row['serial_number']; ?>&test_no=<?php echo $row['test_no'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['serial_number']; ?></b>
                                                </a>
                                            </td>
                                            <?php }
                                            ?>

                                            <td align="center" valign="middle">
                                                <?php echo $row['valve_type']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php echo $row['valve_size']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <a href="details_report.php?valve_serial_no=<?php echo $row['serial_number']; ?>&test_no=<?php echo $row['test_no'];?>&test_type=<?php echo $row['test_type'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr">
                                                <?php switch ($row['test_type']) {
                                                            case '0':
                                                                echo 'Hydrostatic Shell';
                                                                break;
                                                            case '1':
                                                                echo 'Hydrostatic Seat A';
                                                                break;
                                                            case '2':
                                                                echo 'Hydrostatic Seat B';
                                                                break;
                                                            case '3':
                                                                echo 'Air Seat A';
                                                                break;
                                                            case '4':
                                                                echo 'Air Seat B';
                                                                break;
                                                            case '5':
                                                                echo 'Nitrogen Shell';
                                                                break;
                                                            case '6':
                                                                echo 'Nitrogen Seat A';
                                                                break;
                                                            case '7':
                                                                echo 'Nitrogen Seat B';
                                                                break;
                                                            
                                                            default:
                                                                # code...
                                                                break; 
                                                            }?> 
                                            </b>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php echo $row['hydro_set_pressure']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php if ($row['result'] == '1') {
                                                    echo "PASS";
                                                } else {
                                                    echo "FAIL";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } while ($row = $qresult->fetch_assoc());

                                }
                                else {
//                                    echo "0 results";
                                }
                                ?>

                                </tbody>

                            </table>


                        </div><!-- /.box-body -->
                        <!-- /.box-body -->
                    </div><!-- /.box -->

                    <!-- Custom tabs (Charts with tabs)-->


                </section><!-- /.Left col -->

            </div><!-- /.row (main row) -->


        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- add new calendar event modal -->




<!-- jQuery 2.0.2 -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!-- jQuery UI 1.10.3 -->
<!--<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>-->
<!-- Sparkline -->
<!--<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>-->
<!-- jvectormap -->
<!--<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>-->
<!--<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>-->
<!-- fullCalendar -->
<!--<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>-->
<!-- daterangepicker -->
<!--<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>-->
<!-- Bootstrap WYSIHTML5 -->
<!--<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
<!-- iCheck -->
<!--<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>-->
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
<!-- jQuery 2.0.2 -->
<script src="js/jquery.min.js"></script>
<!-- DATA TABES SCRIPT -->
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->

<!-- page script -->
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>


</body>
</html>
