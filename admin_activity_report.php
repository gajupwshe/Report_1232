<?php
session_start();
//include('db_config.php');
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
   
    <!--<script src="js/respond.min.js"></script>-->
    <![endif]-->

    <link rel="stylesheet" href="pikaday.css">
    <!--    <link rel="stylesheet" href="site.css">-->

    <script>
        function  showVtr(test_no) {
            // window.alert(test_no);
            // document.getElementById('test_no').value = test_no;
            <?php
            $drop = "SELECT * FROM `test_init` WHERE `test_no`='test_no' ";
            $result = $conn->query($drop);
            echo $row["test_type"];
            ?>
            window.alert(<?php echo $row["test_type"];?>)
        }
    </script>
    <style>
        .vtr:hover{
            font-size: 24px;
            color: #0099FF;
            border-bottom:5px dotted black;
        }
        .details:hover{
            font-size: 24px;
            color: #009900;
            border-bottom:5px dotted black;
        }
    </style>

</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->


<div class="wrapper row-offcanvas row-offcanvas-left">
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

                <h1 style="text-align: center"><i class="fa fa-calendar"></i> Customized Report </h1>
            </div>
            <!-- /.row -->

            <!-- top row -->
            <div class="row">
                <div class="col-xs-12 connectedSortable">
                    <div class="col-lg-12 connectedSortable" style="padding: 20px;">


                        <form action="#" method="post" class="form-inline">
                            <div style="">
                                <center>

                                    <div class="form-group">
                                        <label for="datepicker">Start Date: </label>
                                        <input type="text"  class="form-control" id="datepicker" name="date_to" placeholder="Start Date" style="margin: 20px; width: 200px;" required>
                                        <label for="datepicker">End Date: </label>
                                        <input type="text"  class="form-control" id="datepicker_end" name="date_end" placeholder="End Date" style="margin: 20px; width: 200px;" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Test Type: </label>
                                        <select class="form-control" name="test_type" style="margin: 20px; width: 200px;">
                                            <option class="dropdown-toggle" data-toggle="dropdown" value="All">All</option>
                                            <?php
                                            $drop = "SELECT * FROM `test_type` ";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option class="dropdown-toggle" data-toggle="dropdown" ` value="<?php echo $row["test_type"];?>"><?php echo $row["test_type"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>
                                        <label>Valve Class: </label>
                                        <select class="form-control" name="valve_class" style="margin: 20px; width: 200px;">
                                            <option value="All">All</option>
                                            <?php
                                            $drop = "SELECT  * FROM `valve_class` ";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option value="<?php echo $row["valve_class"];?>"><?php echo $row["valve_class"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class = "form-group">
                                        <label style="">Valve Size: </label>
                                        <select class="form-control"  name="valve_size" style="margin: 20px; width: 200px;">
                                            <option value="All" >All</option>
                                            <?php
                                            $drop = "SELECT * FROM `valve_size` ";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option class="dropdown-toggle" value="<?php echo $row["valve_size"];?>"><?php echo $row["valve_size"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>
                                        <label style="">Valve Type: </label>
                                        <select class="form-control" name="valve_type" style="margin: 20px; width: 200px;">
                                            <option value="All">All</option>
                                            <?php
                                            $drop = "SELECT * FROM `valve_type` ";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option value="<?php echo $row["valve_type"];?>"><?php echo $row["valve_type"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>
                                        <label>Customer: </label>
                                        <select class="form-control" name="customer_name" style="margin: 20px; width: 200px;">
                                            <option value="All">All</option>
                                            <?php
                                            $drop = "SELECT * FROM `initial_valve_data_unit1` GROUP BY customer";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option value="<?php echo $row["customer"];?>"><?php echo $row["customer"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label>Serial Number: </label>
                                        <select class="form-control " name="valve_serial_no" style="margin: 20px; width: 200px;">
                                            <option value="All">All</option>
                                            <?php
                                            $drop = "SELECT * FROM `initial_valve_data_unit1` GROUP BY component_serial_no";
                                            $result = $conn->query($drop);


                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                do { ?>
                                                    <option value="<?php echo $row["component_serial_no"];?>"><?php echo $row["component_serial_no"];?></option>
                                                    <?php
                                                } while ($row = $result->fetch_assoc());
                                            }
                                            ?>
                                        </select>
                                        <input type="submit"  class="btn btn-primary form-control" name="report" value="View Report" style="width: 200px;" >

                                    </div>

                                </center>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Box (with bar chart) -->
                    <div class="box box-danger" id="loading-example">
                        <div class="box-header ">
                            <!-- tools box -->



                            <h3 class="text-info " style="margin-left:40%; "><i class="fa fa-calendar"></i> Result</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body no-padding" style="width: 100%">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="text-align:center;">Sr No.</th>
                                    <th style="text-align:center;">Date / Time</th>
                                    <th style="text-align:center;">Test Nos</th>
                                    <!-- <th style="text-align:center;">Company</th> -->
                                    <th style="text-align:center;">Customer</th>
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

                                if (isset($_POST['report'])) {


                                    $date_start = $_POST['date_to'];
                                    $date_end = $_POST['date_end'];
                                    $test_type1 = $_POST['test_type'];
                                    $valve_class1 = $_POST['valve_class'];
                                    $valve_size1 = $_POST['valve_size'];
                                    $valve_type1 = $_POST['valve_type'];
                                    $customer_name1 = $_POST['customer_name'];
                                    // $operator_name1 = $_POST['operator_name'];
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
                                        $customer_name = " ti.`customer`='$customer_name1' AND";
                                    }

                                    // if($_POST['operator_name'] == "All"){
                                    //     $operator_name = "";
                                    // }else{
                                    //     $operator_name = " vd.`operator`='$operator_name1' AND";
                                    // }

                                    if($_POST['valve_serial_no'] == "All"){
                                        $valve_serial_no = "";
                                    }else{
                                        $valve_serial_no = " ti.`component_serial_no`='$valve_serial_no1'";
                                    }


                                    if ($date_start==""||$date_end==""){
                                        ?>
                                        <script>
                                            window.alert("date is empty");
                                        </script>

                                    <?php
                                    }else{




                                    $start_date= explode(' ', $date_start);

                                    //        echo "Split Date :: <br>";
                                    //        echo "Day : ".$start_date[2]."<br>";
                                    //        echo "Month : ".$start_date[1]."<br>";
                                    //        echo "Year : ".$start_date[3]."<br>";

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


                                    //    $new_start_date1 = $start_date[3]."-".$start_month."-".$start_date[2];
                                    $new_start_date = $start_date[3]."-".$start_month."-".$start_date[2];
                                    $new_end_date1 = $end_date[3]."-".$end_month."-".$end_date[2];
                                    //    $new_end_date = $end_date[3]."-".$end_month."-".$end_date[2];

                                    $current_date = date("Y-m-d");

                                    $stop_date = $new_end_date1;

                                    $new_end_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
                                    //                        echo '<br/>date after adding 1 day: ' . $new_end_date;






                                    if ($new_start_date >= $new_end_date && $new_end_date >= $current_date) {

                                    if ($test_type=="All"&&$valve_class=="All"&&$valve_size=="All"&&$valve_type=="All"&&$customer_name=="All"&&$valve_serial_no=="All"){

                                        $sql = "SELECT ti.`date_tim`,ti.`test_no`,ti.`company`,ti.`customer`,ti.`holding_set`,ti.`component_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,tr.`pressure_end`,tr.`result` FROM `initial_valve_data_unit1` ti JOIN `test_result_unit1` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE ti.`date_tim` BETWEEN '$new_start_date' AND '$new_end_date'";
           // echo "all are all ".$sql;


                                    }
                                    else{
                                        $sql = "SELECT ti.`date_tim`,ti.`test_no`,ti.`company`,ti.`holding_set`,ti.`customer`,ti.`component_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,tr.`pressure_end`,tr.`result` FROM `initial_valve_data_unit1` ti JOIN `test_result_unit1` tr ON (tr.`test_no` = ti.`test_no` AND ti.`test_type` = tr.`test_type`) WHERE ti.`date_tim` BETWEEN '$new_start_date' AND '$new_end_date' AND$test_type$valve_class$valve_size$valve_type$customer_name$valve_serial_no" ;

                                        if($_POST['valve_serial_no']=="All"){
                                            $sql = substr($sql,0,-3);
                                        }
           // echo $sql;
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
                                                    <?php echo $row['test_no']; ?>

                                                </td>

                                            <td align="center" valign="middle">
                                                <?php echo $row['company']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php echo $row['customer']; ?>
                                            </td>


                                           <td align="center" valign="middle">
                                             <a href="new_vtr_reports.php?valve_serial_no=<?php echo $row['component_serial_no']; ?>&company=<?php echo $row['company'];?>&test_no=<?php echo $row['test_no'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['component_serial_no']; ?></b>
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
                                                <?php echo $row['pressure_end']; ?>
                                            </td>
                                            <td align="center" valign="middle">
                                                <?php if($row['result']==1){
                                                    echo "TEST NOT OK";
                                                }else{
                                                    echo  "TEST OK";
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

                                    if ($test_type=="All"&&$valve_class=="All"&&$valve_size=="All"&&$valve_type=="All"&&$customer_name=="All"&&$valve_serial_no=="All"){

                                        $sql = "SELECT ti.`date_tim`,ti.`test_no`,ti.`company`,ti.`customer`,ti.`component_serial_no`,ti.`valve_type`, ti.`valve_size`,ti.`test_type`,tr.`pressure_end`,tr.`result` FROM `initial_valve_data_unit1` ti, test_result_unit1 tr  WHERE ti.test_no = tr.test_no AND  ti.test_type = tr.test_type AND  ti.`date_tim` BETWEEN '$new_start_date' AND '$new_end_date'";
//        echo "all are all ".$sql;


                                    }
                                    else{
                                        $sql = "SELECT ti.`date_tim`,ti.`test_no`,ti.`customer`,ti.`component_serial_no`,ti.`valve_type`,ti.`holding_set`, ti.`valve_size`,ti.`test_type`,ti.`hydro_set_pressure`,tr.`result` FROM `valve_data` ti, test_result tr  WHERE ti.test_no = tr.test_no AND  ti.test_type = tr.test_type AND  ti.`date_tim`  BETWEEN '$new_start_date' AND '$new_end_date' AND$test_type$valve_class$valve_size$valve_type$customer_name$valve_serial_no" ;

                                        if($_POST['valve_serial_no']=="All"){
                                            $sql = substr($sql,0,-3);
                                        }
   // echo $sql;
                                    }

                                    $result = $conn->query($sql);


                                    if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $SR_NO = 1;
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
                                            <td align="center" valign="middle">
                                                <?php echo $row['customer']; ?>
                                            </td>
                                            <?php
                                            if($row['valve_type']=='DOUBLE BLOCK BLEED VALVE'){?>
                                            <td align="center" valign="middle">
                                                <a href="new_vtr_reports_dbb.php?valve_serial_no=<?php echo $row['component_serial_no']; ?>&company=<?php echo $row['company'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['component_serial_no']; ?></b>
                                                </a>
                                            </td>
                                        <?php }
                                        else { ?>
                                                   <td align="center" valign="middle">
                                                   <a href="new_vtr_reports.php?valve_serial_no=<?php echo $row['component_serial_no']; ?>&test_no=<?php echo $row['test_no'];?>&holding=<?php echo $row['holding_set'];?>"
                                                   style="color: #000; font-size: 20px; ">
                                                    <b class="vtr"><?php echo $row['component_serial_no']; ?></b>
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
                                                <?php echo $row['test_type']; ?>
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
                                    <?php } while ($row = $result->fetch_assoc());

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
                        <!-- /.box-body -->
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- Custom tabs (Charts with tabs)-->


                </section>
                <!-- /.Left col -->

            </div>
            <!-- /.row (main row) -->


        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->

<!-- add new calendar event modal -->


<script src="pikaday.js"></script>
<script>

    new Pikaday(
        {
            field:document.getElementById('datepicker'),
            trigger:document.getElementById('datepicker-button'),
            minDate:new Date(2000, 0, 1),
            ariaLabel:'Custom label',
            maxDate:new Date(3020, 12, 31),
            yearRange:[2010, 2080]
        });

    new Pikaday(
        {
            field:document.getElementById('datepicker_end'),
            trigger:document.getElementById('datepicker_end-button'),
            minDate:new Date(2000, 0, 1),
            ariaLabel:'Custom label',
            maxDate:new Date(3020, 12, 31),
            yearRange:[2010, 2080]
        });

</script>



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
