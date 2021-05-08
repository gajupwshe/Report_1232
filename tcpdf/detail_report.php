<?php
$test_no = $_GET['test_no'];
$test_type = $_GET['test_type'];
include('db_config.php');
$conn = new mysqli($hostname, $username, $password, $database) or trigger_error(mysql_error(),E_USER_ERROR);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/author.png">
    <title>Reports</title>


    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->

<div >
    <!-- Left side column. contains the logo and sidebar -->

    <?php include('nav_left.php');?>

    <!-- /.sidebar -->

    <aside class="right-side">
        <div >
            <section class="content-header">
                <h1 style="text-align: center;">
                    Valve Test Reports
                </h1>







                <?php
                $sql = "SELECT DISTINCT(vd.`valve_serial_no`),vd.`valve_tag_no`,vd.`manufacturer`,vd.`customer`,vd.`operator`,vd.`shift`,vd.`project`,tr.`gauge_serial_no`,tr.`guage_calibration_date`,tr.`valve_type`,vd.`date_time`,tr.`valve_size`,tr.`valve_class` FROM `test_result` tr  JOIN `valve_data` vd ON (tr.`test_no` = vd.`test_no` AND tr.`test_type` = vd.`test_type`) WHERE  tr.`test_no` = '$test_no'";

                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                ?>
                <center>
                <div class="" style="text-align: center; margin-left: 5%">
                    <table >
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 150px;"><b> VALVE SERIAL NO. </b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['valve_serial_no'];?></td>
                            <td style="border: 1px solid #000; width: 150px;"><b>CUSTOMER</b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['customer']; ?>  </td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 150px;"><b> VALVE TAG NO. </b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['valve_tag_no'];?></td>
                            <td style="border: 1px solid #000; width: 150px;"><b>OPERATOR NAME </b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['operator'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 150px;"><b>  MANUFACTURER </b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['manufacturer'];?></td>
                            <td style="border: 1px solid #000; width: 150px;"><b>SHIFT</b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['shift'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000;width: 150px;"><b>VALVE SIZE</b> </td>
                            <td style="border: 1px solid #000;width: 150px;"><?php echo $row['valve_size'];?></td>
                            <td style="border: 1px solid #000;width: 150px;"><b>TEST DATE</b> </td>
                            <td style="border: 1px solid #000;width: 150px;"><?php echo $row['date_time'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000;width: 150px;"><b>VALVE CLASS</b> </td>
                            <td style="border: 1px solid #000;width: 150px;"><?php echo $row['valve_class'];?></td>
                            <td style="border: 1px solid #000; width: 150px;"><b>PROJECT</b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['project'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 150px;"><b>VALVE TYPE</b> </td>
                            <td style="border: 1px solid #000; width: 150px;"><?php echo $row['valve_type'];}}?></td>
                        </tr>
                    </table>

                    <h1 style="text-align: left;">
                        <?php echo $test_type; ?>
                    </h1>
                </div>
                </center>
            </section>
        </div>



        <div class="box-body no-padding" style="width: 100%">

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="text-align:center;">Sr No.</th>
                    <th style="text-align:center;">Date / Time</th>
                    <th style="text-align:center;">Test Nos</th>
                    <th style="text-align:center;">Customer</th>
                    <th style="text-align:center;">Valvl Serial Number</th>
                    <th style="text-align:center;">Valvl Type</th>
                    <th style="text-align:center;">Size</th>
                    <th style="text-align:center;">Test Type</th>
                    <th style="text-align:center;">Test Pressure</th>
                    <th style="text-align:center;">Test Result</th>
                </tr>
                </thead>
                <tbody>

                <?php

                if (isset($_POST['report'])) {


                    $date_start = $_POST['date_to'];
                    $date_end = $_POST['date_end'];
                    $test_type1 = $_POST['test_type'];
                    $valve_class1 = $_POST['valve_class'];
                    $valve_size1 = $_POST['valve_size'];
                    $valve_type1 = $_POST['valve_type'];
                    $customer_name1 = $_POST['customer_name'];
                    $operator_name1 = $_POST['operator_name'];
                    $valve_serial_no1 = $_POST['valve_serial_no'];

                    if($_POST['test_type'] == "All"){
                        $test_type = "";
                    }else{
                        $test_type = " ti.`test_type`= '$test_type1' AND";
                    }

                    if($_POST['valve_class'] == "All"){
                        $valve_class = "";
                    }else{
                        $valve_class = " ti.`valve_class`='$valve_class1' AND";
                    }

                    if($_POST['valve_size'] == "All"){
                        $valve_size = "";
                    }else{
                        $valve_size = " ti.`valve_size`='$valve_size1\"' AND";
                    }

                    if($_POST['valve_type'] == "All"){
                        $valve_type = "";
                    }else{
                        $valve_type = " ti.`valve_type`= '$valve_type1' AND";
                    }

                    if($_POST['customer_name'] == "All"){
                        $customer_name = "";
                    }else{
                        $customer_name = " vd.`customer`='$customer_name1' AND";
                    }

                    if($_POST['operator_name'] == "All"){
                        $operator_name = "";
                    }else{
                        $operator_name = " vd.`operator`='$operator_name1' AND";
                    }

                    if($_POST['valve_serial_no'] == "All"){
                        $valve_serial_no = "";
                    }else{
                        $valve_serial_no = " vd.`valve_serial_no`='$valve_serial_no1'";
                    }


                    if ($date_start==""||$date_end==""){
                        ?>
                        <script>
                            window.alert("date is empty");
                        </script>

                    <?php
                    }else{




                    $start_date= explode(' ', $date_start);

                    //    echo "Split Date :: <br>";
                    //    echo "Day : ".$start_date[2]."<br>";
                    //    echo "Month : ".$start_date[1]."<br>";
                    //    echo "Year : ".$start_date[3]."<br>";

                    $end_date= explode(' ', $date_end);

                    //    echo "Split Date2 :: <br>";
                    //    echo "Day : ".$end_date[2]."<br>";
                    //    echo "Month : ".$end_date[1]."<br>";
                    //    echo "Year : ".$end_date[3]."<br>";



                    $start_month = 0;
                    $end_month = 0;
                    switch ($start_date[1]) {
                        case "Jan":
//                                            echo "Your favorite color is red!";
                            $start_month = "01";
                            break;
                        case "Feb":
//                                            echo "Your favorite color is red!";
                            $start_month = "02";
                            break;
                        case "Mar":
//                                            echo "Your favorite color is red!";
                            $start_month = "03";
                            break;
                        case "Apr":
//                                            echo "Your favorite color is red!";
                            $start_month = "04";
                            break;
                        case "May":
//                                            echo "Your favorite color is red!";
                            $start_month = "05";
                            break;
                        case "Jun":
//                                            echo "Your favorite color is red!";
                            $start_month = "06";
                            break;
                        case "Jul":
//                                            echo "Your favorite color is red!";
                            $start_month = "07";
                            break;
                        case "Aug":
//                                            echo "Your favorite color is red!";
                            $start_month = "08";
                            break;
                        case "Sep":
//                                            echo "Your favorite color is red!";
                            $start_month = "09";
                            break;
                        case "Oct":
//                                            echo "Your favorite color is red!";
                            $start_month = "10";
                            break;
                        case "Nov":
//                                            echo "Your favorite color is red!";
                            $start_month = "11";
                            break;
                        case "Dec":
//                                            echo "Your favorite color is red!";
                            $start_month = "12";
                            break;

                        default:
                            echo "";
                    }

                    switch ($end_date[1]) {
                        case "Jan":
//                                            echo "Your favorite color is red!";
                            $end_month = "01";
                            break;
                        case "Feb":
//                                            echo "Your favorite color is red!";
                            $end_month = "02";
                            break;
                        case "Mar":
//                                            echo "Your favorite color is red!";
                            $end_month = "03";
                            break;
                        case "Apr":
//                                            echo "Your favorite color is red!";
                            $end_month = "04";
                            break;
                        case "May":
//                                            echo "Your favorite color is red!";
                            $end_month = "05";
                            break;
                        case "Jun":
//                                            echo "Your favorite color is red!";
                            $end_month = "06";
                            break;
                        case "Jul":
//                                            echo "Your favorite color is red!";
                            $end_month = "07";
                            break;
                        case "Aug":
//                                            echo "Your favorite color is red!";
                            $end_month = "08";
                            break;
                        case "Sep":
//                                            echo "Your favorite color is red!";
                            $end_month = "09";
                            break;
                        case "Oct":
//                                            echo "Your favorite color is red!";
                            $end_month = "10";
                            break;
                        case "Nov":
//                                            echo "Your favorite color is red!";
                            $end_month = "11";
                            break;
                        case "Dec":
//                                            echo "Your favorite color is red!";
                            $end_month = "12";
                            break;

                        default:
                            echo "";
                    }


                    $new_start_date = $start_date[3]."-".$start_month."-".$start_date[2];
                    $new_end_date = $end_date[3]."-".$end_month."-".$end_date[2];

                    $current_date = date("Y-m-d");



                    if ($new_start_date <= $new_end_date && $new_end_date <= $current_date) {
                    if ($test_type=="All"&&$valve_class=="All"&&$valve_size=="All"&&$valve_type=="All"&&$customer_name=="All"&&$operator_name=="All"&&$valve_serial_no=="All"){

                        $sql = "SELECT ti.`date_time`,ti.`test_no`,vd.`customer`,vd.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `test_init` ti JOIN `valve_data` vd ON (ti.`test_no` = vd.`test_no` AND ti.`test_type` = vd.`test_type`) JOIN `test_result` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE ti.`date_time` BETWEEN '$new_start_date' AND '$new_end_date'";
//            echo "all are all ".$sql;


                    }
                    else{
                        $sql = "SELECT ti.`date_time`,ti.`test_no`,vd.`customer`,vd.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `test_init` ti JOIN `valve_data` vd ON (ti.`test_no` = vd.`test_no` AND ti.`test_type` = vd.`test_type`) JOIN `test_result` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE  ti.`date_time` BETWEEN '$new_start_date' AND '$new_end_date' AND$test_type$valve_class$valve_size$valve_type$customer_name$operator_name$valve_serial_no" ;

                        if($_POST['valve_serial_no']=="All"){
                            $sql = substr($sql,0,-3);
                        }
//            echo $sql;
                    }

                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $SR_NO = 1;
                    do {
                    ?>
                        <tr class="gradeU" style="color: #000">
                            <td align="center" valign="middle">
                                <?php echo $SR_NO++; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['date_time']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <a href="detail_report.php?test_no=<?php echo $row['test_no'];?>&test_type=<?php echo $row['test_type'];?>" style="color: #000; font-size: 20px; ">
                                    <b class="details"><?php echo $row['test_no']; ?></b>
                                </a>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['customer']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <a href="vtr_reports.php?valve_serial_no=<?php echo $row['valve_serial_no'];?>" style="color: #000; font-size: 20px; ">
                                    <b class="vtr"><?php echo $row['valve_serial_no']; ?></b>
                                </a>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['valve_type']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['valve_size']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['test_type']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['hydro_set_pressure']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php if($row['test_result']==1){
                                    echo "OK";
                                }else{
                                    echo  "NOT OK";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    } while ($row = $result->fetch_assoc());
                    }
                    else {
                    echo "invalid date - Not allowed";
                    ?>
                        <script>
                            alert("invalid date");
                        </script>
                    <?php
                    }

                    }else{
                    //        echo "<br />Allowed";

                    //    echo $test_type;
                    //    echo $valve_class;
                    //    echo $valve_size;
                    //    echo $valve_type;
                    //    echo $customer_name;
                    //    echo $operator_name;
                    //    echo $valve_serial_no;
                    //    echo $new_start_date;
                    //    echo $new_end_date;

                    if ($test_type=="All"&&$valve_class=="All"&&$valve_size=="All"&&$valve_type=="All"&&$customer_name=="All"&&$operator_name=="All"&&$valve_serial_no=="All"){

                        $sql = "SELECT ti.`date_time`,ti.`test_no`,vd.`customer`,vd.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `test_init` ti JOIN `valve_data` vd ON (ti.`test_no` = vd.`test_no` AND ti.`test_type` = vd.`test_type`) JOIN `test_result` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE ti.`date_time` BETWEEN '$new_start_date' AND '$new_end_date'";
//        echo "all are all ".$sql;


                    }
                    else{
                        $sql = "SELECT ti.`date_time`,ti.`test_no`,vd.`customer`,vd.`valve_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`test_result` FROM `test_init` ti JOIN `valve_data` vd ON (ti.`test_no` = vd.`test_no` AND ti.`test_type` = vd.`test_type`) JOIN `test_result` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE  ti.`date_time` BETWEEN '$new_start_date' AND '$new_end_date' AND$test_type$valve_class$valve_size$valve_type$customer_name$operator_name$valve_serial_no" ;

                        if($_POST['valve_serial_no']=="All"){
                            $sql = substr($sql,0,-3);
                        }
//    echo $sql;
                    }

                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $SR_NO = 1;
                    do {
                    ?>
                        <tr class="gradeU" style="color: #000">
                            <td align="center" valign="middle">
                                <?php echo $SR_NO++; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['date_time']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <a href="detail_report.php?test_no=<?php echo $row['test_no'];?>&test_type=<?php echo $row['test_type'];?>" style="color: #000; font-size: 20px; ">
                                    <b class="details"><?php echo $row['test_no']; ?></b>
                                </a>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['customer']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <a href="vtr_reports.php?valve_serial_no=<?php echo $row['valve_serial_no'];?>" style="color: #000; font-size: 20px; ">
                                    <b class="vtr"><?php echo $row['valve_serial_no']; ?></b>
                                </a>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['valve_type']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['valve_size']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['test_type']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php echo $row['hydro_set_pressure']; ?>
                            </td>
                            <td align="center" valign="middle">
                                <?php if($row['test_result']==1){
                                    echo "OK";
                                }else{
                                    echo  "NOT OK";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    } while ($row = $result->fetch_assoc());
                    }
                    else {
                    echo "invalid date - Not allowed";
                    ?>
                        <script>
                            alert("invalid date");
                        </script>
                        <?php
                    }
                    }

                    }

                }



                ?>

                </tbody>

            </table>

        </div>

        <table>
            <tr style="padding: 10px; font-size: 20px; text-align: center">
                <td style="border: 1px solid #000; width: 400px"><b>S.No. </b> </td>
                <td style="border: 1px solid #000; width: 400px"><b>DATE TIME</b></td>
                <?php if($test_type == 'DOUBLE BLOCK BLEED TEST'){?>
                    <td style="border: 1px solid #000; width: 400px"><b>PRESSURE AT A SIDE</b></td>
                    <td style="border: 1px solid #000; width: 400px"><b>PRESSURE AT B SIDE</b></td>
                <?php }else{?>
                    <td style="border: 1px solid #000; width: 400px"><b>PRESSURE</b></td>
                <?php }?>
            </tr>
            <?php
            $sql = "SELECT * FROM `test_result_by_type` WHERE  `test_no` = '$test_no'";
            ?>
            <?php
            $count = 0;
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    ?>
                    <tr style="padding: 10px; font-size: 20px; text-align: center">
                        <td style="border: 1px solid #000; width: 400px"><?php echo $count++; ?></td>
                        <td style="border: 1px solid #000; width: 400px"><?php echo $row['date_time']; ?></td>
                        <?php if($test_type == 'HYDROSTATIC SHELL' || $test_type == 'HYDROSTATIC SEAT A SIDE' || $test_type == 'PNEUMATIC A SIDE'){?>
                            <td style="border: 1px solid #000; width: 400px"><?php echo $row['hydro_pressure_a_side']; ?></td>
                        <?php }elseif ($test_type == 'HYDROSTATIC SEAT B SIDE' || $test_type == 'PNEUMATIC B SIDE'){ ?>
                            <td style="border: 1px solid #000; width: 400px"><?php echo $row['hydro_pressure_b_side']; ?></td>
                        <?php }elseif ($test_type == 'DOUBLE BLOCK BLEED TEST'){ ?>
                            <td style="border: 1px solid #000; width: 400px"><?php echo $row['hydro_pressure_a_side']; ?></td>
                            <td style="border: 1px solid #000; width: 400px"><?php echo $row['hydro_pressure_b_side']; ?></td>
                        <?php }?>
                    </tr>
                <?php }}?>
        </table>
</div>


</aside>
</div>


<!-- jQuery 2.0.2 -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- fullCalendar -->
<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

<!-- jQuery 2.0.2 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $(function() {
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
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</body>
</html>
