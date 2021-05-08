<?php
session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(), E_USER_ERROR);

$sql= "SELECT * FROM valve_data WHERE `vsn` = '".$_GET['valve_serial_no']."' AND test_no ='".$_GET['test_no']."'";

$result = $conn ->query($sql);
if($result ->num_rows > 0){
 $row = $result->fetch_assoc();
 $gaDrawing =$row['gaDrawingNo'];
 $endType=$row['endType'];
 $modelNo=$row['modelNo'];
 $grade=$row['materialGrade'];
 $qtyTested=$row['qty'];
 $qty=$row['qty'];
 $vsn=$row['vsn'];
 $customer=$row['customer'];
 $po=$row['poRef'];
 $bom=$row['bom'];
 $assyProcedure=$row['assyProcedure'];
 $testingProcdure=$row['testingProcedure'];
 $wo=$row['woRef'];
 $procedureRef=$row['productRef'];
 $tcRef=$row['tcRef'];

 $bodySrNo=$row['bodySlNo'];
 $bodyHeatNo=$row['bodyHeatNo'];
 $bodyMipNo=$row['bodyMipNo'];
 $bodyRtNo=$row['bodyRtNo'];

 $bonnetSrNo=$row['bonnetSlNo'];
 $bonnetHeatNo=$row['bonnetHeatNo'];
 $bonnetMipNo=$row['bonnetMipNo'];
 $bonnetRtNo=$row['bonnetRtNo'];


 $plugSrNo=$row['plugSlNo'];
 $plugHeatNo=$row['plugHeatNo'];
 $plugMpiNo=$row['plugMpiNo'];
 $plugRtNo=$row['plugRtNo'];


 $slipSrNo=$row['slipSlno'];
 $slipHeatNo=$row['slipHeatNo'];
 $slipMpiNo=$row['slipMpino'];
 $slipRtNo=$row['slipRtNo'];

 $trunnionSrNo=$row['trunnionSlno'];
 $trunnionHeatNo=$row['trunnionHeatNo'];
 $trunnionMpiNo=$row['trunnionMpiNo'];
 $trunnionRtNo=$row['trunnionRtNo'];

 $glandSrNo=$row['glandSlNo'];
 $glandHeatNo=$row['glandHeatNo'];
 $glandMpiNo=$row['glandMpiNo'];
 $glandRtNo=$row['glandRtNo'];
 $pressureAsper=$row['pressureAsPer'];
 $date=$row['date'];

}


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

                    <table size="2" border="1" width="100%">
                        <tr>
                            <td width="70px;">&nbsp;<br>
                                &nbsp;&nbsp;&nbsp;<img  src="img/19.jpg" style="  height:30px; " />
                            </td>
                            <td width="270px;">
                                <table align="center"  width="100%">
                                    <tr>
                                        <th style="text-align:center;font-size:14px;" colspan="6"> <b>Peekay Steel Castings Private Limited,</b></th>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Plot No:40 APIIC Industrial Park,</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Gollapuram Village,</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Hindupur,Ananthapururu Dist,</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Andhra Pradesh Pin:515211 India</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table align="center" width="100%" >
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Report No:PKH/VTC/001 R1</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6">Date: <?php echo $date; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>



                    <table border="1" width="100%">
                        <tr>

                            <td>

                                <table border="1" cellspacing="0" cellpadding="3" width="100%">
                                    <tr>
                                        <th style="text-align:left;font-size:16px;" colspan="6"> <b>Valve Test Certificate</b></th>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px" colspan="6"><b>Product Details</b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="6"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>GA Drawing No:</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $gaDrawing; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>End Type</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $endType; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Model Number</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $modelNo; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Material Grade</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $grade; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Quantity Tested</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $qtyTested; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;font-size:12px;" colspan="2"><b>Quantity</b></td>
                                        <td style="text-align:center;font-size:12px;" colspan="4"><b>Valve Serial Numbers</b></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;font-size:12px;" colspan="2"><?php echo $qty; ?></td>
                                        <td style="text-align:center;font-size:12px;" colspan="4"><?php echo $vsn; ?></td>
                                    </tr>
                                </table>

                            </td>

                            <td>

                                <table border="1" cellspacing="0" cellpadding="3" width="100%">
                                    <tr>
                                        <td style="font-size:12px" colspan="6"><b>Customer Document Details</b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Customer</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $customer; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>PO Ref</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $po; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Bill of Material</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $bom; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Assy. Procedure</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $assyProcedure; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Testing Procedure</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $testingProcdure; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px" colspan="6"><b>Peekay Steel Document Details</b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>WO Ref</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $wo; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>Procedure Ref</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $procedureRef; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;" colspan="2"><b>TC Ref</b></td>
                                        <td style="font-size:12px;" colspan="4"><?php echo $tcRef; ?></td>
                                    </tr>

                                </table>

                            </td>

                        </tr>
                    </table>


                    <table border="1" width="100%">
                        <tr>

                            <td>

                                <table  width="100%" border="1" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <th style="text-align:left;font-size:12px" colspan="7"> <b>Valve Serial Number and Component Details</b></th>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;" colspan="3"><b>Valve Serial Number</b></td>
                                        <td style="font-size:12px;text-align:center;" colspan="4"><?php echo $vsn; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;" colspan="7"><b>Component Heat Number Details</b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;"></td>
                                        <td style="font-size:12px;text-align:center;">Body</td>
                                        <td style="font-size:12px;text-align:center;">Bonnet</td>
                                        <td style="font-size:12px;text-align:center;">Plug</td>
                                        <td style="font-size:12px;text-align:center;">Slip</td>
                                        <td style="font-size:12px;text-align:center;">Trunnion</td>
                                        <td style="font-size:12px;text-align:center;">Gland</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;">Sr.No</td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bodyHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bonnetHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $plugHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $slipHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $trunnionHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $glandHeatNo; ?></td>
                                        <!-- <td style="font-size:12px;text-align:center;"></td> -->
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;">Heat No.</td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bodyHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bonnetHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $plugHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $slipHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $trunnionHeatNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $glandHeatNo; ?></td>
                                        <!-- <td style="font-size:12px;text-align:center;"></td> -->
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;">MPI No.</td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bodyMipNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bonnetMipNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $plugMpiNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $slipMpiNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $trunnionMpiNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $glandMpiNo; ?></td>
                                        <!-- <td style="font-size:12px;text-align:center;"></td> -->
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;">RT No.</td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bodyRtNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $bonnetRtNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $plugRtNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $slipRtNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $trunnionRtNo; ?></td>
                                        <td style="font-size:12px;text-align:center;"><?php echo $glandRtNo; ?></td>
                                        <!-- <td style="font-size:12px;text-align:center;"></td> -->
                                    </tr>
                                </table>

                            </td>

                        </tr>
                    </table>


                    <table border="1" width="100%">
                        <tr>

                            <td>

                                <table width="100%" border="1" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <th style="text-align:left;font-size:12px" colspan="9"> <b>Pressure Test Details as per <?php echo $pressureAsper; ?> Latest Revision</b></th>
                                    </tr>

                                    <tr>
                                        <td style="font-size:12px;text-align:center;" rowspan="2" colspan="2">Type of Test</td>
                                        <td style="font-size:12px;text-align:center;" rowspan="2">Test Medium</td>
                                        <td style="font-size:12px;text-align:center;" colspan="2">Test Pressure(Bar)</td>
                                        <td style="font-size:12px;text-align:center;" colspan="2">Duration(Minutes)</td>
                                        <td style="font-size:12px;text-align:center;" rowspan="2" colspan="2">Test Result</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;text-align:center;">Required</td>
                                        <td style="font-size:12px;text-align:center;">Actual</td>
                                        <td style="font-size:12px;text-align:center;">Required</td>
                                        <td style="font-size:12px;text-align:center;">Actual</td>
                                    </tr>
                                    <?php

                                    $sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SHELL' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                                    $result_tt = $conn->query($sql_tt);

                                    if($result_tt->num_rows > 0){
                                     $row_tt =  $result_tt->fetch_assoc();	

                                     ?>
                                     <tr>
                                        <td style="text-align:center;font-size:12px;" colspan="2" >Hydostatic Shell Test</td>
                                        <td style="text-align:center;font-size:12px;">water</td>
                                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_a"]; ?></td>
                                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                        <td style="text-align:center;font-size:12px;" colspan="2">No visible leakage</td>
                                    </tr>

                                <?php }else{

                                } 

                                $sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SEAT A SIDE' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
// echo $sql_tt;
                                $result_tt = $conn->query($sql_tt);

                                if($result_tt->num_rows > 0){
                                 $row_tt =  $result_tt->fetch_assoc();	
                                 ?>
                                 <tr>
                                    <td style="text-align:center;font-size:12px;" colspan="2">Alternat Seat Test-1</td>
                                    <td style="text-align:center;font-size:12px;">water</td>
                                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_a"]; ?></td>
                                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                    <td style="text-align:center;font-size:12px;" colspan="2"></td>
                                </tr>
                                <?php 
                            }else{

                            }
                            $sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SEAT B SIDE' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                            $result_tt = $conn->query($sql_tt);

                            if($result_tt->num_rows > 0){
                             $row_tt =  $result_tt->fetch_assoc();	
                             ?>
                             <tr>
                                <td style="text-align:center;font-size:12px;" colspan="2">Alternat Seat Test-2</td>
                                <td style="text-align:center;font-size:12px;">water</td>
                                <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                                <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_b"]; ?></td>
                                <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                                <td style="text-align:center;font-size:12px;"colspan="2"></td>
                            </tr>
                            <?php 
                        }else{

                        }
                        $sql_tt ="SELECT * FROM test_result WHERE test_type='SIMULTANEOUS SEAT TEST HYDRO' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                        $result_tt = $conn->query($sql_tt);

                        if($result_tt->num_rows > 0){
                         $row_tt =  $result_tt->fetch_assoc();	
                         ?>
                         <tr>
                            <td style="text-align:center;font-size:12px;" colspan="2">Simultaneous Seat Test</td>
                            <td style="text-align:center;font-size:12px;">water</td>
                            <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                            <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_b"]; ?></td>
                            <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                            <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                            <td style="text-align:center;font-size:12px;"colspan="2"></td>
                        </tr>
                        <?php
                    }else{

                    }

                    $sql_tt ="SELECT * FROM test_result WHERE test_type='SIMULTANEOUS SEAT TEST AIR' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                    $result_tt = $conn->query($sql_tt);

                    if($result_tt->num_rows > 0){
                        $row_tt =  $result_tt->fetch_assoc();   
                         ?>
                        <tr>
                        <td style="text-align:center;font-size:9px" colspan="2">Simultaneous Seat Test Hydro</td>
                        <td style="text-align:center;font-size:9px">Air</td>
                        <td style="text-align:center;font-size:9px">'.$row_tt["hydro_set_pressure"].'</td>
                        <td style="text-align:center;font-size:9px">'.$row_tt["start_pressure_b"].'</td>
                        <td style="text-align:center;font-size:9px">'.$row_tt["holding_time"].'</td>
                        <td style="text-align:center;font-size:9px">'.$row_tt["holding_time"].'</td>
                        <td style="text-align:center;font-size:9px"colspan="2"></td>
                        </tr>
                         <?php
                    }else{

                    } 

                    $sql_tt ="SELECT * FROM test_result WHERE test_type='PNEUMATIC SEAT A SIDE' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
// echo $sql_tt;
                    $result_tt = $conn->query($sql_tt);

                    if($result_tt->num_rows > 0){
                     $row_tt =  $result_tt->fetch_assoc();	
                     ?>
                     <tr>
                        <td style="text-align:center;font-size:12px;" colspan="2">Low Pressure Seat Test-1</td>
                        <td style="text-align:center;font-size:12px;">Air</td>
                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_a"]; ?></td>
                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                        <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                        <td style="text-align:center;font-size:12px;"colspan="2"></td>
                    </tr>
                    <?php
                }else{

                }
                $sql_tt ="SELECT * FROM test_result WHERE test_type='PNEUMATIC SEAT B SIDE' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                $result_tt = $conn->query($sql_tt);

                if($result_tt->num_rows > 0){
                 $row_tt =  $result_tt->fetch_assoc();	
                 ?>
                 <tr>
                    <td style="text-align:center;font-size:12px;" colspan="2">Low Pressure Seat Test-2</td>
                    <td style="text-align:center;font-size:12px;">Air</td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_b"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;" colspan="2"></td>
                </tr>
                <?php
            }else{

            }

            $sql_tt ="SELECT * FROM test_result WHERE test_type='CAVITY' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                $result_tt = $conn->query($sql_tt);

                if($result_tt->num_rows > 0){
                 $row_tt =  $result_tt->fetch_assoc();  
                 ?>
                 <tr>
                    <td style="text-align:center;font-size:12px;" colspan="2">Low Pressure Seat Test-2</td>
                    <td style="text-align:center;font-size:12px;">Air</td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_a"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;" colspan="2"></td>
                </tr>
                <?php
            }else{

            }
             $sql_tt ="SELECT * FROM test_result WHERE test_type='BACKSEAT' AND valve_serial_no='".$_GET['valve_serial_no']."' ORDER BY test_result_id DESC LIMIT 1 ";
                $result_tt = $conn->query($sql_tt);

                if($result_tt->num_rows > 0){
                 $row_tt =  $result_tt->fetch_assoc();  
                 ?>
                 <tr>
                    <td style="text-align:center;font-size:12px;" colspan="2">Low Pressure Seat Test-2</td>
                    <td style="text-align:center;font-size:12px;">Air</td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["hydro_set_pressure"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["start_pressure_a"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;"><?php echo $row_tt["holding_time"]; ?></td>
                    <td style="text-align:center;font-size:12px;" colspan="2"></td>
                </tr>
                <?php
            }else{

            }
            ?>
        </table>

    </td>

</tr>
</table>


<table width="100%" border="1" cellspacing="0" cellpadding="3">
    <tr>
        <th style="font-size:12px" colspan="7"> <b>Digital Pressure Transducer and Calibration Details</b>
        </th>
    </tr>
    <tr>
        <th style="text-align:center;font-size:12px;"><b>Make</b></th>
        <th style="text-align:center;font-size:12px;"><b>Gauge Id No.</b></th>
        <th style="text-align:center;font-size:12px;"><b>Range</b></th>
        <th style="text-align:center;font-size:12px;"><b>Date of Calibration</b></th>
        <th style="text-align:center;font-size:12px;"><b>Valid up to</b></th>
        <th style="text-align:center;font-size:12px;"><b>Calibration Status</b></th>
        <th style="text-align:center;font-size:12px;"><b>Remarks</b></th>

    </tr>



    <?php
                 //SHEll


    $sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='HYDROSTATIC SHELL' ";

    $result = $conn->query($sql);

    $make='';
    $status='';
    $remarks='';
    $ranges='';
               // echo $new_date;

    if($row = mysqli_fetch_array($result))
    {

        $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='HYDROSTATIC SHELL' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
        $result_vd = $conn->query($sql_vd);
        if($row_vd = mysqli_fetch_array($result_vd)){
            $make=$row_vd['digiPressMake'];
            $status=$row_vd['digiPressCalibrationStatus'];
            $remarks=$row_vd['digiPressRemarks'];
            $range=$row_vd['digiPressRange'];
        }

        ?>
        <tr>
          <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
          <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

      </tr>
  <?php } ?>

  <?php
                 //HYDROSTATIC SEAT A SIDE


  $sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='HYDROSTATIC SEAT A SIDE' ";

  $result = $conn->query($sql);

  $make='';
  $status='';
  $remarks='';
  $ranges='';
               // echo $new_date;

  if($row = mysqli_fetch_array($result))
  {

    $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='HYDROSTATIC SEAT A SIDE' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
    $result_vd = $conn->query($sql_vd);
    if($row_vd = mysqli_fetch_array($result_vd)){
        $make=$row_vd['digiPressMake'];
        $status=$row_vd['digiPressCalibrationStatus'];
        $remarks=$row_vd['digiPressRemarks'];
        $range=$row_vd['digiPressRange'];
    }

    ?>
    <tr>
      <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

  </tr>
<?php } ?>

<?php
                 //HYDROSTATIC SEAT B SIDE


$sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='HYDROSTATIC SEAT B SIDE' ";

$result = $conn->query($sql);

$make='';
$status='';
$remarks='';
$ranges='';
               // echo $new_date;

if($row = mysqli_fetch_array($result))
{

    $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='HYDROSTATIC SEAT B SIDE' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
    $result_vd = $conn->query($sql_vd);
    if($row_vd = mysqli_fetch_array($result_vd)){
        $make=$row_vd['digiPressMake'];
        $status=$row_vd['digiPressCalibrationStatus'];
        $remarks=$row_vd['digiPressRemarks'];
        $range=$row_vd['digiPressRange'];
    }

    ?>
    <tr>
      <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

  </tr>
<?php } ?>


<?php
                 //HYDROSTATIC SEAT B SIDE


$sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='SIMULTANEOUS SEAT TEST HYDRO' ";

$result = $conn->query($sql);

$make='';
$status='';
$remarks='';
$ranges='';
               // echo $new_date;

if($row = mysqli_fetch_array($result))
{

    $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='SIMULTANEOUS SEAT TEST HYDRO' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
    $result_vd = $conn->query($sql_vd);
    if($row_vd = mysqli_fetch_array($result_vd)){
        $make=$row_vd['digiPressMake'];
        $status=$row_vd['digiPressCalibrationStatus'];
        $remarks=$row_vd['digiPressRemarks'];
        $range=$row_vd['digiPressRange'];
    }

    ?>
    <tr>
      <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

  </tr>
<?php } ?>

<?php
                 //PNEUMATIC SEAT A SIDE


$sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='PNEUMATIC SEAT A SIDE' ";

$result = $conn->query($sql);

$make='';
$status='';
$remarks='';
$ranges='';
               // echo $new_date;

if($row = mysqli_fetch_array($result))
{

    $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='PNEUMATIC SEAT A SIDE' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
    $result_vd = $conn->query($sql_vd);
    if($row_vd = mysqli_fetch_array($result_vd)){
        $make=$row_vd['digiPressMake'];
        $status=$row_vd['digiPressCalibrationStatus'];
        $remarks=$row_vd['digiPressRemarks'];
        $range=$row_vd['digiPressRange'];
    }

    ?>
    <tr>
      <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

  </tr>
<?php } ?>

<?php
                 //PNEUMATIC SEAT A SIDE


$sql="SELECT tr.gauge_serial_no, tr.valve_serial_no,tr.test_type, gd.serial,gd.c_date,gd.c_due_date FROM gauge_data gd, test_result tr WHERE tr.gauge_serial_no=gd.serial AND tr.valve_serial_no='".$_GET['valve_serial_no']."' AND tr.test_type='PNEUMATIC SEAT B SIDE' ";

$result = $conn->query($sql);

$make='';
$status='';
$remarks='';
$ranges='';
               // echo $new_date;

if($row = mysqli_fetch_array($result))
{

    $sql_vd = "SELECT digiPressMake,digiPressCalibrationStatus,digiPressRemarks,digiPressRange,vsn,test_type FROm valve_data WHERE vsn = '".$_GET['valve_serial_no']."' AND digiPressGaugeId='".$row["gauge_serial_no"]."' AND test_type='PNEUMATIC SEAT B SIDE' ORDER By id desc LIMIT 1";
                    // echo $sql_vd;
    $result_vd = $conn->query($sql_vd);
    if($row_vd = mysqli_fetch_array($result_vd)){
        $make=$row_vd['digiPressMake'];
        $status=$row_vd['digiPressCalibrationStatus'];
        $remarks=$row_vd['digiPressRemarks'];
        $range=$row_vd['digiPressRange'];
    }

    ?>
    <tr>
      <td style="font-size:12px;text-align:center;"><?php echo  $make; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["gauge_serial_no"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $range; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $row["c_due_date"]; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $status; ?></td>
      <td style="font-size:12px;text-align:center;"><?php echo $remarks; ?></td>

  </tr>
<?php } ?>
</table>


<table width="100%" border="1" cellspacing="0" cellpadding="3">

    <tr>
        <td style="font-size:12px" colspan="4"><b>Performance and Operation Test as per <?php echo $pressureAsper; ?> Latest Revision</b></td>
    </tr>
    <tr>
        <td style="font-size:12px;text-align:center;" colspan="1"><b>Test Type</b></td>
        <td style="font-size:12px;text-align:center;" colspan="1"><b>No of times Open</b></td>
        <td style="font-size:12px;text-align:center;" colspan="1"><b>No of times Close</b></td>
        <td style="font-size:12px;text-align:center;" colspan="1"><b>Test Result</b></td>
    </tr>
    <tr>
        <td style="font-size:12px;text-align:center;" colspan="1"></td>
        <td style="font-size:12px;text-align:center;" colspan="1"></td>
        <td style="font-size:12px;text-align:center;" colspan="1"></td>
        <td style="font-size:12px;text-align:center;" colspan="1"></td>
    </tr>

</table>


<div style="margine-top:-2px;">
    <table width="100%" cellspacing="0" cellpadding="0" >
        <tr>
            <td width="255px" border="1">
                <table width="100%">
                    <tr>
                        <th style="font-size:12px;text-align:left;" colspan="6">1. We confirm that the valve was manufactured, inspected and tested in accordance with applicable drawing,material specifications, purchase order and was found meet the requirements.</th>
                    </tr>
                    <tr>
                        <td style="font-size:12px;text-align:left;" colspan="6">2. The test water used for Hydostatic test,chloride content has been testedas per <?php echo $pressureAsper; ?> and found within the specified limits.</td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;text-align:left;" colspan="6">3. The Valve test successfully passed part has been stamped low stress stamp with Letter "HA" on end flange OD.</td>
                    </tr>

                </table>
            </td>

            <td width="255px">
                <table width="100%" border="1">
                    <tr>
                        <td style="font-size:12px" colspan="6" ><b>Test Summery</b></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">Quantity Offered</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>
                        <td style="font-size:px;" colspan="1" rowspan="6"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">Quantity Accepted</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">Visual Check</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">Dimension Check</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">MTC Verification</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" colspan="3">Functional Test</td>
                        <td style="font-size:12px;text-align:center;" colspan="2"></td>

                    </tr>

                </table>
            </td>
        </tr>
    </table>
</div>
<button> <a href="peekay_steel_pdf.php?vsn=<?php echo $_GET['valve_serial_no']; ?>&test_no=<?php echo $_GET['test_no'];?>&holding=<?php echo $row['holding_set'];?>"
   style="color: #000; font-size: 20px; ">
   <b class="vtr">Export PDF</b>
</a></button>
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