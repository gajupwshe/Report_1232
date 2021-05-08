<?php
//export.php


session_start();

$SR_NO = 1;
$output = '';


require_once('tcpdf/tcpdf.php');

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Creintors-Hydrothrust");

$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '  ', PDF_HEADER_STRING, array(0, 64, 0), array(0, 64, 128));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
//To display header and footer
$obj_pdf->setPrintHeader(false);//as per requirement
$obj_pdf->setPrintFooter(false);//as per requirement
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 11);
$obj_pdf->AddPage();
$content = '';
$content .= '
<div style="margine-top:10px">
<table>
<tr >
<td width="100px;">
<img  src="img/L&T_logo.png" style="height: 50px;" />
</td>
<td width="500px;">
<table align="center" width="420px">
<tr>
<td style="border: 0.5px solid #000; height: 8px;width: 320px;text-align: center; margin-right: 130px; padding-left: 20px;"> L & T HYDROCARBON ENGINEERING LIMITED</td>
</tr>
<tr>
<td style="border: 0.5px solid #000; height: 8px;width: 320px;text-align: center; margin-right: 130px; padding-left: 20px;" >MODULAR FABRICATION FACILITY, HAZIRA INDIA</td>
</tr>
<tr>
<td style="border: 0.5px solid #000; height: 8px;width: 320px;text-align: center; margin-right: 130px; padding-left: 20px;"> VALVE TEST REPORT </td>
</tr>
</table>
</td>
</tr>
</table>
</div>';
$conn1 = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(), E_USER_ERROR);
$valve_serial_no = $_SESSION['valve_serial_no'];
$sql = "SELECT DISTINCT(vd.`valve_serial_no`),vd.`valve_tag_no`,vd.`imir_no`,vd.`manufacturer`,vd.`customer`,vd.`operator`,vd.`shift`,vd.`project`,tr.`gauge_serial_no`,tr.`guage_calibration_date`,tr.`valve_type`,vd.`date_time`,tr.`valve_size`,tr.`valve_class` FROM `dbb_test_result` tr  JOIN `valve_data` vd ON (tr.`valve_serial_no` = vd.`valve_serial_no`) WHERE  tr.`valve_serial_no` = '$valve_serial_no' ORDER BY tr.`test_no` DESC LIMIT 1;";
//(tr.`test_no` = vd.`test_no` AND tr.`test_type` = vd.`test_type`) 
//echo $sql."<br/> new ";
$valve_serial = '';
$valve_tag = '';
$imir_no = '';
$rdate_time='';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $valve_serial = $row['valve_serial_no'];
        $valve_tag = $row['valve_tag_no'];
        $imir_no = $row['imir_no'];
        $rdate_time=$row['date_time'];
        $content .= ' 
 <table border="" >
                  <tr style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"><b> &nbsp; VALVE SERIAL NO. </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"> &nbsp; ' . $row['valve_serial_no'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"><b> &nbsp; CUSTOMER </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"> &nbsp; ' . $row['customer'] . '  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;  text-align: center;"><b> &nbsp; VALVE TAG NO. </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;  text-align: center;"> &nbsp; ' . $row['valve_tag_no'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp;  OPERATOR NAME  </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['operator'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"><b> &nbsp; MANUFACTURER </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px; text-align: center;"> &nbsp; ' . $row['manufacturer'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; SHIFT(TIMING)</b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['shift'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; VALVE SIZE</b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['valve_size'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; TEST DATE  </b> </td>';
        $fdate = $row['date_time'];
        $newDate = date("d/m/Y", strtotime($fdate));
//        echo $newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp;  '.$newDate .'</td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; VALVE CLASS </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['valve_class'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; PROJECT</b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['project'] . '  </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"><b> &nbsp; VALVE TYPE </b> </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;"> &nbsp; ' . $row['valve_type'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;">IMIR NO</td>
                        <td style="border: 0.5px solid #000; height: 8px; width: 80px;text-align: center;">&nbsp;'.$row['imir_no'].'</td>
                 </tr>
                 </table>
                 
          ';
    }
}


$shell_test_no = '45';
$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SHELL'  ORDER BY `test_no` DESC LIMIT 1";

$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $shell_test_no = $row['test_no'];
    }
}
// $sql_shell = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$shell_test_no'";
$sql_shell = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$shell_test_no'";
$result_shell = $conn1->query($sql_shell);
if ($result_shell->num_rows > 0) {
    if ($row = $result_shell->fetch_assoc()) {
        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align: center;"> &nbsp; <b>BODY / BONNET HYDROSTATIC SHELL TEST</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align: center;"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp;DONE DATE  </td>
                        ';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT END (' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['start_pressure_a'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['stop_pressure_a'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; WATER  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;   </td>
                 </tr>
                 </table>
';
    }
} else {
    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align: center;"> &nbsp; <b>HYDROSTATIC SHELL </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; SET PRESSURE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT center  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT END    </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';
}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='DOUBLE BLOCK BLEED TEST'  ORDER BY `test_no` DESC LIMIT 1";
$seat_a_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $seat_a_test_no = $row['test_no'];
    }
}
// $sql_seat_a = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` =  '$seat_a_test_no'";
$sql_seat_a = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` =  '$seat_a_test_no'";
$result_seat_a = $conn1->query($sql_seat_a);
if ($result_seat_a->num_rows > 0) {
    if ($row = $result_seat_a->fetch_assoc()) {
        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align: center;"> &nbsp; <b>DOUBLE BLOCK BLEED TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align: center;"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT START A SIDE (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT END A SIDE (' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['start_pressure_a'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['stop_pressure_a'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT START B SIDE (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; PRESSURE AT END B SIDE (' . $row['pressure_unit'] . ')   </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['start_pressure_b'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['stop_pressure_b'] . '  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['holding_time'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; MEDIA </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; WATER  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; ' . $row['water_temperature'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;   </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align: center;"> &nbsp;   </td>
                 </tr>
                 </table>
';
    }
} else {
    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>DOUBLE BLOCK BLEED TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START A SIDE  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END A SIDE    </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';
}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='BACK SEAT TEST'  ORDER BY `test_no` DESC LIMIT 1";
$seat_b_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $seat_b_test_no = $row['test_no'];
    }
}

// $sql_seat_b = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` =  '$seat_b_test_no'";
$sql_seat_b = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$seat_b_test_no'";
$result_seat_b = $conn1->query($sql_seat_b);
if ($result_seat_b->num_rows > 0) {
    if ($row = $result_seat_b->fetch_assoc()) {

        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table>
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>BACK SEAT TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .='
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_a'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_a'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; WATER  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';
    }
} else {

    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>BACK SEAT TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';

}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SEAT A SIDE'  ORDER BY `test_no` DESC LIMIT 1";
$air_a_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $air_a_test_no = $row['test_no'];
    }
}

// $sql_air_a = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` =   '$air_a_test_no'";
$sql_air_a = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no`= '$air_a_test_no'";
echo $sql_air_a; 
$result_air_a = $conn1->query($sql_air_a);
if ($result_air_a->num_rows > 0) {
    if ($row = $result_air_a->fetch_assoc()) {

        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>HYDROSTATIC SEAT TEST A SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_a'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_a'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['leakage_type'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['allowable_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['actual_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; WATER </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';

    }
} else {


    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>HYDROSTATIC SEAT TEST A SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';


}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='HYDROSTATIC SEAT B SIDE'  ORDER BY `test_no` DESC LIMIT 1";
$air_b_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $air_b_test_no = $row['test_no'];
    }
}
// $sql_air_b = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$air_b_test_no'";
$sql_air_b = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$air_b_test_no'";
$result_air_b = $conn1->query($sql_air_b);
if ($result_air_b->num_rows > 0) {
    if ($row = $result_air_b->fetch_assoc()) {

        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>HYDROSTATIC SEAT TEST B SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate .'  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_b'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_b'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['leakage_type'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['allowable_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['actual_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; WATER </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';


    }
} else {


    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>HYDROSTATIC SEAT TEST B SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';

}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='PNEUMATIC SEAT A SIDE'  ORDER BY `test_no` DESC LIMIT 1";
$double_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $double_test_no = $row['test_no'];
    }
}

// $sql_double = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$double_test_no'";
$sql_double = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no`= '$double_test_no'";
$result_double = $conn1->query($sql_double);
if ($result_double->num_rows > 0) {
    if ($row = $result_double->fetch_assoc()) {

        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>PNEUMATIC SEAT TEST A SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));;
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_a'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_a'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['leakage_type'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE / BUBBLE  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE / BUBBLE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['allowable_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['actual_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; AIR </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';

    }
} else {




    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>PNEUMATIC SEAT TEST A SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE / BUBBLE</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE / BUBBLE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';


}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='PNEUMATIC SEAT A SIDE'  ORDER BY `test_no` DESC LIMIT 1";
$back_seat_test_no = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $back_seat_test_no = $row['test_no'];
    }
}

// $sql_back_seat = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$back_seat_test_no'";
$sql_back_seat = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no`= '$back_seat_test_no'";
$result_back_seat = $conn1->query($sql_back_seat);
echo $sql_back_seat;
if ($result_back_seat->num_rows > 0) {
    if ($row = $result_back_seat->fetch_assoc()) {


        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table  align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>PNEUMATIC SEAT TEST B SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_b'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_b'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['leakage_type'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE / BUBBLE  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE / BUBBLE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['allowable_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['actual_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; AIR </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';



    }
} else {





    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>PNEUMATIC SEAT TEST B SIDE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE / BUBBLE</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE / BUBBLE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 </table>
';




}


$sql = "SELECT `test_no` FROM `dbb_test_result` WHERE  `valve_serial_no` = '$valve_serial_no' AND `test_type` ='CAVITY RELIEF TEST'  ORDER BY `test_no` DESC LIMIT 1";
$cavity_relief_test = '45';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $cavity_relief_test = $row['test_no'];
    }
}
// $sql_cavity_relief = "SELECT tr.*,vr.*, gd.`c_date`,gd.`c_due_date` FROM `dbb_test_result` tr JOIN gauge_data gd ON (tr.gauge_serial_no = gd.serial) JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no` = '$cavity_relief_test'";
$sql_cavity_relief = "SELECT tr.*,vr.* FROM `dbb_test_result` tr  JOIN `valve_data` vr ON (tr.`test_no` = vr.`test_no`) WHERE tr.`test_no`='$cavity_relief_test'";
$result_cavity_relief_test = $conn1->query($sql_cavity_relief);
if ($result_cavity_relief_test->num_rows > 0) {
    if ($row = $result_cavity_relief_test->fetch_assoc()) {


        $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>CAVITY RELIEF TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
                        <td style="border: 1px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['gauge_serial_no'] . ' </td>
</tr>
 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align:center"> &nbsp;PRESSURE GAUGE CALIBRATION  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align:center"> &nbsp;DONE DATE  </td>';
        $c_date= $row['guage_calibration_date'];
        $c_newDate = date("d/m/Y", strtotime($c_date));
        //echo $c_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $c_newDate. ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 80px;text-align: center;"> &nbsp; DUE DATE </td>';
        $c_due_date = $row['gauge_due_date'];
        $due_newDate = date("d/m/Y", strtotime($c_due_date));
       //echo $due_newDate;
        $content .= '
                        <td style="border: 0.5px solid #000; height: 8px;width: 100px;text-align: center;"> &nbsp; ' . $due_newDate . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT START (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; PRESSURE AT END(' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['hydro_set_pressure'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['start_pressure_b'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['stop_pressure_b'] . '  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; HOLDING TIME ACTUAL (SEC)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; OVERALL TEST TIME (SEC) </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; LEAKAGE TYPE </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['holding_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['over_all_time'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['leakage_type'] . ' </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ALLOWABLE LEAKAGE / BUBBLE  </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ACTUAL LEAKAGE / BUBBLE </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; MEDIA </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['allowable_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['actual_leakage'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; AIR </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; TEST TEMPERATURE (&deg;C)</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; RESULT </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;  </td>
                 </tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; ' . $row['water_temperature'] . ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> ';
        if ($row['test_result'] == '0') {
            $content .= '  PASS';
        } else {
            $content .= '  FAIL';
        }
        $content .= ' </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp;   </td>
                 </tr>
                 </table>
';



    }
} else {



    $content .= '
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<table align="center">
             <tr  style="padding: 8px;  font-size: 5px; text-align: center; border: 0.5px solid #000;">
             <td style="border: 1px solid #000; height: 8px;width: 320px;text-align:center"> &nbsp; <b>CAVITY RELIEF TEST</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; PRESSURE GAUGE NO.</td>
</tr>
                 <tr style="padding: 8px;  font-size: 5px; text-align: center">
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; SET PRESSURE (' . $row['pressure_unit'] . ')</td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; A SIDE BLEED IN (' . $row['pressure_unit'] . ') </td>
                        <td style="border: 0.5px solid #000; height: 8px;width: 160px;text-align:center"> &nbsp; B SIDE BLEED IN (' . $row['pressure_unit'] . ')   </td>
                 </tr>
                 </table>
';

}


$content .= '
<table align="center">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<hr style="color: #ffffff; width: 1px;">
<tr>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align: center; font-size: 7px;"> OPERATOR</td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align: center; font-size: 7px;"> LTHE - MFF&nbsp;QC</td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;text-align: center; font-size: 7px;"> COMPANY / CLIENT</td>
</tr>
<tr style="height: 50px;">
<td style="border: 0.5px solid #000; height: 8px;width: 120px; font-size: 7px; "> NAME</td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
</tr>
<tr style="height: 50px;">
<td style="border: 0.5px solid #000; height: 8px;width: 120px;  font-size: 7px;"> SIGN. </td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
</tr>
<tr style="height: 50px;">
<td style="border: 0.5px solid #000; height: 8px;width: 120px; font-size: 7px;"> DATE</td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
<td style="border: 0.5px solid #000; height: 8px;width: 120px;"></td>
</tr>


</table>';


$obj_pdf->writeHTML($content);
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
//echo date('d-m-Y H:i:s');

$date = date("d-m-Y H:i:s");


$path = "Report_948/reports/Valve_Test_Reports/VALVE_TEST_REPORT_of_" . $valve_serial . "_" . $valve_tag . "_" . $imir_no."_".$rdate_time;
//$path = "Report_948/aka";

$obj_pdf->Output($_SERVER['DOCUMENT_ROOT'] . $path . '.pdf', 'F');


//echo "test no".$_SESSION['test_no'];
//echo "test type".$_SESSION['test_type'];
?>


<script>alert("PDF SAVED SUCCESSFULLY_split_<?php echo $path;?>")</script>

<script>//window.location = "new_vtr_reports.php?valve_serial_no=<?php echo $_SESSION['valve_serial_no'];?>"; </script>
