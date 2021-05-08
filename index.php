<?php
session_start();

$_SESSION['db_user'] = 'root';//'root';
$_SESSION['db_pass'] = 'hydro';//'';
$_SESSION['db_name'] = 'e1232';//'380mt';

$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(), E_USER_ERROR);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/author.png">
    <title>Reports</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   
    <!-- DATA TABLES -->
    <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css"/>


</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->

    <?php include('nav_left.php'); ?>

    <!-- /.sidebar -->

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side" style="margin-Left:175px;">

        <!-- Content Header (Page header) -->

        <!--Report1 Start-->

        <div>


            <section class="content">
<!-- Small boxes (Stat box) -->
<!-- <a href = "./Report_948_old/index.php?db_user=root&db_pass=y8m7X5YhiWDGAxTQ&db_name=380mt">Old Reports</a> -->
            <div class="row" style="/*border: 1px solid #000000; border-radius: 10px;*/">

                <h1 style="text-align: center"><i class="fa fa-calendar"></i> Daily Report </h1>
            </div><!-- /.row -->


            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Box (with bar chart) -->
                    <div class="box box-danger">
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
                                    <!-- <th style="text-align:center;">Valve Type</th> -->
                                    <!-- <th style="text-align:center;">Size</th> -->
                                    <th style="text-align:center;">Test Type</th>
                                    <th style="text-align:center;">Test Pressure</th>
                                    <th style="text-align:center;">Test Result</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                $datenew = date('Y-m-d');
                                $date = date('Y-m-d');

                                $stop_date = $datenew;
                                //                    echo 'date before day adding: ' . $stop_date;
                                $fistdate = date('Y-m-d', strtotime($stop_date . ' -0 day'));
                                //                    echo '<br/>date after adding- 1 day: ' . $stop_datenew;

                                $dateah = date('Y-m-d', strtotime($stop_date . ' +1 day'));
                                //                    echo '<br/>date after adding 1 day: ' . $stop_datenew;


                                //                    list($week_start, $month_start, $day_start, $year_start) = split('[\ ]', $date);
                                //                    echo "Month: ".$month_start."; Day: ".$day_start."; Year: ".$year_start."<br />\n";
                                //                    echo "The current server timezone is: " . $date."<br/";
                                  $sql = "SELECT ti.`date`,ti.`test_no`,ti.`vsn`,ti.`holding_set`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `valve_data` ti, test_result tr  WHERE ti.test_no = tr.test_no AND  ti.test_type = tr.test_type AND  ti.`date` BETWEEN '$fistdate' AND '$dateah' ";
                                  echo $sql;

                                $qresult = $conn->query($sql);


                                if ($qresult->num_rows > 0) {


                                    $row = $qresult->fetch_assoc();
                                    $SR_NO = 1;
                                    do { ?>
                                        <tr class="gradeU">
                                            <td align="center" valign="middle">
                                                <?php echo $SR_NO++; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php echo $row['date']; ?>
                                            </td>
                                            
                                                <td align="center" valign="middle">
                                                <?php echo $row['test_no']; ?>

                                                </td>
                                            
                                          
                                            
                                                   <td align="center" valign="middle">
                                                   <a href="new_vtr_reports.php?valve_serial_no=<?php echo $row['vsn']; ?>&test_no=<?php echo $row['test_no'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['vsn']; ?></b>
                                                </a>
                                            </td>
                                            
                                            <td align="center" valign="middle">
                                                <a href="details_report.php?valve_serial_no=<?php echo $row['vsn']; ?>&test_no=<?php echo $row['test_no'];?>&test_type=<?php echo $row['test_type'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['test_type']; ?></b>
                                                </a>
                                                
                                            </td>

                                            <!-- <td align="center" valign="middle">
                                                <a href="details_report.php?valve_serial_no=<?php echo $row['vsn']; ?>&test_no=<?php echo $row['test_no'];?>&test_type=<?php echo $row['test_type'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr">
                                                <?php
                                                        switch ($row['test_type']) {
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
                                                        }
                                                  ?> 
                                            </b>
                                            </td> -->
                                            <td align="center" valign="middle">
                                                <?php echo $row['hydro_set_pressure']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php if ($row['test_result'] == '1') {
                                                    echo "PASS";
                                                } else {
                                                    echo "FAIL";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } while ($row = $qresult->fetch_assoc());

                                } else {


                                }
                                ?>

                                </tbody>

                            </table>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </section><!-- /.Left col -->
           
            </div><!-- /.row (main row) -->


            <!-- add new calendar event modal -->

</section>
            </div>



    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>

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
