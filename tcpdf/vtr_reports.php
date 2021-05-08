<?php
$valve_serial_no = $_GET['valve_serial_no'];
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
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->





</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->

<div class="wrapper row-offcanvas row-offcanvas-left" >
    <!-- Left side column. contains the logo and sidebar -->

    <?php include('nav_left.php');?>

    <!-- /.sidebar -->

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">

        <!-- Content Header (Page header) -->

        <!--Report1 Start-->

        <div>


            <section class="content-header">
                <h1 style="text-align: center;">
                    Valve Test Reports
                </h1>
                <?php
                $sql = "SELECT DISTINCT(vd.`valve_serial_no`),vd.`valve_tag_no`,vd.`manufacturer`,vd.`customer`,vd.`operator`,vd.`shift`,vd.`project`,tr.`gauge_serial_no`,tr.`guage_calibration_date`,tr.`valve_type`,vd.`date_time`,tr.`valve_size`,tr.`valve_class` FROM `test_result` tr  JOIN `valve_data` vd ON (tr.`test_no` = vd.`test_no` AND tr.`test_type` = vd.`test_type`) WHERE  tr.`valve_serial_no` = '$valve_serial_no'";

                    $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    if($row = $result->fetch_assoc()){
                ?>
                <div class="table row content-header" style="text-align: center; margin-left: 15%">
                    <table>
                      <tr style="padding: 10px; font-size: 20px; text-align: center">
                          <td style="border: 1px solid #000; width: 200px"><b> VALVE SERIAL NO. </b> </td>
                          <td style="border: 1px solid #000; width: 300px"><?php echo $valve_serial_no?></td>
                          <td style="border: 1px solid #000; width: 200px"><b>CUSTOMER</b> </td>
                          <td style="border: 1px solid #000; width: 300px"><?php echo $row['customer']; ?>  </td>
                      </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 300px"><b> VALVE TAG NO. </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['valve_tag_no'];?></td>
                            <td style="border: 1px solid #000; width: 300px"><b>OPERATOR NAME </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['operator'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>  MANUFACTURER </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['manufacturer'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>SHIFT</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['shift'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>VALVE SIZE</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['valve_size'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>TEST DATE</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['date_time'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>VALVE CLASS</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['valve_class'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>PROJECT</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['project'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>VALVE TYPE</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['valve_type'];}}?></td>
                        </tr>
                    </table>

            <h1 style="text-align: left;">
                HYDROSTATIC SHELL TEST
            </h1>
            <?php
            $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SHELL'  ORDER BY `test_no` DESC LIMIT 1";
            ?>
            <?php
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
            ?>
            <table>
                <tr style="padding: 10px; font-size: 20px; text-align: center">
                    <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                    <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                </tr>
                <tr style="padding: 10px; font-size: 20px; text-align: center">
                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START (<?php echo $row['pressure_unit'];?>) </b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_a'];?></td>
                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END (<?php echo $row['pressure_unit'];?>)</b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_a'];?></td>
                </tr>
                <tr style="padding: 10px; font-size: 20px; text-align: center">
                    <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                    <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                </tr>
                <tr style="padding: 10px; font-size: 20px; text-align: center">
                    <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                    <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                    <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                </tr>
            </table>


                    <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>
                    <h1 style="text-align: left;">
                        HYDROSTATIC SEAT TEST SIDE - A
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SEAT A SIDE'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                    if($row = $result->fetch_assoc()){
                    ?>
                    <table>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START (<?php echo $row['pressure_unit'];?>) </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_a'];?></td>
                            <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END (<?php echo $row['pressure_unit'];?>)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_a'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                        </tr>
                    </table>
                    <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>




                    <h1 style="text-align: left;">
                        HYDROSTATIC SEAT TEST SIDE - B
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SEAT B SIDE'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                    if($row = $result->fetch_assoc()){
                    ?>
                    <table>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START (<?php echo $row['pressure_unit'];?>) </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_b'];?></td>
                            <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END (<?php echo $row['pressure_unit'];?>)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_b'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                        </tr>
                        <tr style="padding: 10px; font-size: 20px; text-align: center">
                            <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                            <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                            <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                        </tr>
                    </table>
                    <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>




                    <h1 style="text-align: left;">
                        PNEUMATIC TEST SIDE- A
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='PNEUMATIC A SIDE'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        if($row = $result->fetch_assoc()){
                            ?>
                            <table>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START (<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_a'];?></td>
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END (<?php echo $row['pressure_unit'];?>)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_a'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                                </tr>
                            </table>
                        <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>




                    <h1 style="text-align: left;">
                        PNEUMATIC TEST SIDE- B
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='PNEUMATIC B SIDE'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        if($row = $result->fetch_assoc()){
                            ?>
                            <table>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START (<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_b'];?></td>
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END (<?php echo $row['pressure_unit'];?>)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_b'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                                </tr>
                            </table>
                        <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>




                    <h1 style="text-align: left;">
                        DOUBLE BLOCK BLEED TEST
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='DOUBLE BLOCK BLEED TEST'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        if($row = $result->fetch_assoc()){
                            ?>
                            <table>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START A SIDE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_a'];?></td>
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END A SIDE(<?php echo $row['pressure_unit'];?>)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_a'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START B SIDE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_b'];?></td>
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END B SIDE(<?php echo $row['pressure_unit'];?>)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_b'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                                </tr>
                            </table>
                        <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>

                    <h1 style="text-align: left;">
                        BACK SEAT TEST
                    </h1>
                    <?php
                    $sql = "SELECT * FROM `test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='BACK SEAT TEST'  ORDER BY `test_no` DESC LIMIT 1";
                    ?>
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        if($row = $result->fetch_assoc()){
                            ?>
                            <table>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>PRESSURE GAUGE NO. </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['gauge_serial_no'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>CALIBRATION DATE</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['guage_calibration_date'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT START(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['start_pressure_a'];?></td>
                                    <td style="border: 1px solid #000; width: 300px"><b>PRESSURE AT END(<?php echo $row['pressure_unit'];?>)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['stop_pressure_a'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 300px"><b>SET PRESSURE(<?php echo $row['pressure_unit'];?>) </b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['hydro_set_pressure'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>HOLDING TIME ACTUAL (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['holding_time'];?></td>
                                </tr>
                                <tr style="padding: 10px; font-size: 20px; text-align: center">
                                    <td style="border: 1px solid #000; width: 200px"><b>OVERALL TEST TIME (SEC)</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php echo $row['over_all_time'];?></td>
                                    <td style="border: 1px solid #000; width: 200px"><b>RESULT</b> </td>
                                    <td style="border: 1px solid #000; width: 300px"><?php if($row['test_result'] == '0'){echo "TEST NOT OK";}else{echo "TEST OK";}?></td>
                                </tr>
                            </table>
                        <?php }}else{?><h3 style="text-align: left;"><?php echo "NOT APPLICABLE";}?></h3>
                </div>

            <!-- /.row -->

                </section><!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <!-- right col -->
            </div><!-- /.row (main row) -->


            <!-- add new calendar event modal -->


        </div>


    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<!--Report1 END-->

<!-- /.modal End-->

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
</body>
</html>
