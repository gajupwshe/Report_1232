
<?php
session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(), E_USER_ERROR);

    require_once('tcpdf/tcpdf.php');

    

    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Creintors-Hydrothrust");
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '  ', PDF_HEADER_STRING, array(0, 64, 0), array(0, 64, 128));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // $obj_pdf->SetMargins('3', '5', '3');
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');

    //To display header and footer
    $obj_pdf->setPrintHeader(false);//as per requirement
    $obj_pdf->setPrintFooter(false);//as per requirement
    $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $obj_pdf->SetFont('helvetica', '', 8);
    $obj_pdf->AddPage();



    $sql= "SELECT * FROM valve_data WHERE `vsn` = '".$_GET['vsn']."' AND test_no ='".$_GET['test_no']."'";
    // echo $sql;
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



    $content = '';
    $content .= '



<table border="1">
<tr>
<td width="70px;">&nbsp;<br>
&nbsp;&nbsp;&nbsp;<img  src="img/19.jpg" style="  height:30px; " />
</td>
<td width="270px;">
<table align="center"  >
<tr>
<th style="text-align:center;font-size:14px;" colspan="6"> <b>Peekay Steel Castings Private Limited,</b></th>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6">Plot No:40 APIIC Industrial Park,</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6">Gollapuram Village,</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6">Hindupur,Ananthapururu Dist,</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6">Andhra Pradesh Pin:515211 India</td>
</tr>
</table>
</td>
<td>
<table align="center">
<tr>
<td style="font-size:8.5px" colspan="6">Report No:PKH/VTC/001 R1</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6">Date: '.$date.'</td>
</tr>
</table>
</td>
</tr>
</table>



<table border="1">
<tr>

<td>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<th style="text-align:left;font-size:16px;" colspan="6"> <b>Valve Test Certificate</b></th>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="6"><b>Product Details</b></td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="6"></td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>GA Drawing No:</b></td>
<td style="font-size:8.5px" colspan="4">'.$gaDrawing.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>End Type</b></td>
<td style="font-size:8.5px" colspan="4">'.$endType.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Model Number</b></td>
<td style="font-size:8.5px" colspan="4">'.$modelNo.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Material Grade</b></td>
<td style="font-size:8.5px" colspan="4">'.$grade.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Quantity Tested</b></td>
<td style="font-size:8.5px" colspan="4">'.$qtyTested.'</td>
</tr>
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2"><b>Quantity</b></td>
<td style="text-align:center;font-size:8.5px" colspan="4"><b>Valve Serial Numbers</b></td>
</tr>
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">'.$qty.'</td>
<td style="text-align:center;font-size:8.5px" colspan="4">'.$vsn.'</td>
</tr>
</table>

</td>

<td>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<td style="font-size:8.5px;" colspan="6"><b>Customer Document Details</b></td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Customer</b></td>
<td style="font-size:8.5px" colspan="4">'.$customer.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>PO Ref</b></td>
<td style="font-size:8.5px" colspan="4">'.$po.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Bill of Material</b></td>
<td style="font-size:8.5px" colspan="4">'.$bom.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Assy. Procedure</b></td>
<td style="font-size:8.5px" colspan="4">'.$assyProcedure.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Testing Procedure</b></td>
<td style="font-size:8.5px" colspan="4">'.$testingProcdure.'</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="6"><b>Peekay Steel Document Details</b></td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>WO Ref</b></td>
<td style="font-size:8.5px" colspan="4">'.$wo.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>Procedure Ref</b></td>
<td style="font-size:8.5px" colspan="4">'.$procedureRef.'</td>
</tr>
<tr>
<td style="font-size:8.5px" colspan="2"><b>TC Ref</b></td>
<td style="font-size:8.5px" colspan="4">'.$tcRef.'</td>
</tr>

</table>

</td>

</tr>
</table>


<table border="1">
<tr>

<td>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<th style="text-align:left;font-size:8.5px;" colspan="7"> <b>Valve Serial Number and Component Details</b></th>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;" colspan="3"><b>Valve Serial Number</b></td>
<td style="font-size:8.5pxtext-align:center;" colspan="4">'.$vsn.'</td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;" colspan="7"><b>Component Heat Number Details</b></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;"></td>
<td style="font-size:8.5pxtext-align:center;">Body</td>
<td style="font-size:8.5pxtext-align:center;">Bonnet</td>
<td style="font-size:8.5pxtext-align:center;">Plug</td>
<td style="font-size:8.5pxtext-align:center;">Slip</td>
<td style="font-size:8.5pxtext-align:center;">Trunnion</td>
<td style="font-size:8.5pxtext-align:center;">Gland</td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;">Sr.No</td>
<td style="font-size:8.5pxtext-align:center;">'.$bodyHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$bonnetHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$plugHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$slipHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$trunnionHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$glandHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;"></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;">Heat No.</td>
<td style="font-size:8.5pxtext-align:center;">'.$bodyHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$bonnetHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$plugHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$slipHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$trunnionHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$glandHeatNo.'</td>
<td style="font-size:8.5pxtext-align:center;"></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;">MPI No.</td>
<td style="font-size:8.5pxtext-align:center;">'.$bodyMipNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$bonnetMipNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$plugMpiNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$slipMpiNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$trunnionMpiNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$glandMpiNo.'</td>
<td style="font-size:8.5pxtext-align:center;"></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;">RT No.</td>
<td style="font-size:8.5pxtext-align:center;">'.$bodyRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$bonnetRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$plugRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$slipRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$trunnionRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;">'.$glandRtNo.'</td>
<td style="font-size:8.5pxtext-align:center;"></td>
</tr>
</table>

</td>

</tr>
</table>


<table border="1">
<tr>

<td>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<th style="text-align:left;font-size:8.5px;" colspan="9"> <b>Pressure Test Details as per '.$pressureAsper.' Latest Revision</b></th>
</tr>

<tr>
<td style="font-size:8.5pxtext-align:center;" rowspan="2" colspan="2">Type of Test</td>
<td style="font-size:8.5pxtext-align:center;" rowspan="2">Test Medium</td>
<td style="font-size:8.5pxtext-align:center;" colspan="2">Test Pressure(Bar)</td>
<td style="font-size:8.5pxtext-align:center;" colspan="2">Duration(Minutes)</td>
<td style="font-size:8.5pxtext-align:center;" rowspan="2" colspan="2">Test Result</td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;">Required</td>
<td style="font-size:8.5pxtext-align:center;">Actual</td>
<td style="font-size:8.5pxtext-align:center;">Required</td>
<td style="font-size:8.5pxtext-align:center;">Actual</td>
</tr>
';

$sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SHELL' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	

$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2" >Hydostatic Shell Test</td>
<td style="text-align:center;font-size:8.5px">water</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_a"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px" colspan="2">No visible leakage</td>
</tr>';
}else{

}

$sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SEAT A SIDE' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Alternat Seat Test-1</td>
<td style="text-align:center;font-size:8.5px">water</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_a"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px" colspan="2"></td>
</tr>';
}else{

}
$sql_tt ="SELECT * FROM test_result WHERE test_type='HYDROSTATIC SEAT B SIDE' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Alternat Seat Test-2</td>
<td style="text-align:center;font-size:8.5px">water</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_b"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{

}
$sql_tt ="SELECT * FROM test_result WHERE test_type='SIMULTANEOUS SEAT TEST HYDRO' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Simultaneous Seat Test Hydro</td>
<td style="text-align:center;font-size:8.5px">water</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_b"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{

}
$sql_tt ="SELECT * FROM test_result WHERE test_type='SIMULTANEOUS SEAT TEST AIR' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Simultaneous Seat Test Hydro</td>
<td style="text-align:center;font-size:8.5px">Air</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_b"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{

}
$sql_tt ="SELECT * FROM test_result WHERE test_type='PNEUMATIC SEAT A SIDE' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
	$row_tt =  $result_tt->fetch_assoc();	
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Low Pressure Seat Test-1</td>
<td style="text-align:center;font-size:8.5px">Air</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_a"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{
	
}

$sql_tt ="SELECT * FROM test_result WHERE test_type='PNEUMATIC SEAT B SIDE' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
    $row_tt =  $result_tt->fetch_assoc();   
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Low Pressure Seat Test-2</td>
<td style="text-align:center;font-size:8.5px">Air</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_b"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{
    
}

$sql_tt ="SELECT * FROM test_result WHERE test_type='CAVITY' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
    $row_tt =  $result_tt->fetch_assoc();   
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Low Pressure Seat Test-2</td>
<td style="text-align:center;font-size:8.5px">Air</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_a"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{
    
}


$sql_tt ="SELECT * FROM test_result WHERE test_type='BACKSEAT' AND valve_serial_no='".$_GET['vsn']."' ORDER BY test_result_id DESC LIMIT 1 ";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0){
    $row_tt =  $result_tt->fetch_assoc();   
$content.='
<tr>
<td style="text-align:center;font-size:8.5px" colspan="2">Low Pressure Seat Test-2</td>
<td style="text-align:center;font-size:8.5px">Air</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["hydro_set_pressure"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["start_pressure_a"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px">'.$row_tt["holding_time"].'</td>
<td style="text-align:center;font-size:8.5px"colspan="2"></td>
</tr>';
}else{
    
}
$content.='
</table>

</td>

</tr>
</table>


<table border="1" cellspacing="0" cellpadding="3">
                <tr>
                <th style="font-size:8.5px;" colspan="7"> <b>Digital Pressure Transducer and Calibration Details</b>
                </th>
                </tr>
                 <tr>
                    <th style="text-align:center;font-size:8.5px"><b>Make</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Gauge Id No.</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Range</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Date of Calibration</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Valid up to</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Calibration Status</b></th>
                    <th style="text-align:center;font-size:8.5px"><b>Remarks</b></th>
                    
                </tr>';
                // $output = '';
                
                
                $sql = "SELECT vd.digiPressMake, vd.digiPressGaugeId, vd.digiPressRange, vd.digiPressCalibration, vd.digiPressDue, vd.digiPressCalibrationStatus, vd.digiPressRemarks , gd.serial FROM gauge_data gd, valve_data vd WHERE vd.digiPressGaugeId=gd.serial AND vd.vsn='".$_GET['vsn']."'";
                // echo $sql;
                $result = $conn->query($sql);

             
               // echo $new_date;

                while($row = mysqli_fetch_array($result))
                {

                   // $date_time =$row['date_tim'];$timestamp = strtotime($date_time);
                   // $new_date = date("d-m-Y H:i:s", $timestamp);
                   // $testing_std=$row["testing_std"];
                   // $serial_number=$row["serial_number"];
                   // $uom=$row["uom"];

                    $content .= '<tr>
                                          
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressMake"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressGaugeId"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressRange"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressCalibration"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressDue"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressCalibrationStatus"].'</td>
                                          <td style="font-size:8.5pxtext-align:center;">'.$row["digiPressRemarks"].'</td>
                                          
                               </tr>';
                }
    $content .= '</table>';

 $content .= '
<table border="1" cellspacing="0" cellpadding="3">

<tr>
<td style="font-size:8.5px;" colspan="4"><b>Performance and Operation Test as per '.$pressureAsper.' Latest Revision</b></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;" colspan="1"><b>Test Type</b></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"><b>No of times Open</b></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"><b>No of times Close</b></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"><b>Test Result</b></td>
</tr>
<tr>
<td style="font-size:8.5pxtext-align:center;" colspan="1"></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"></td>
<td style="font-size:8.5pxtext-align:center;" colspan="1"></td>
</tr>

</table>';

$content .= '
<div style="margine-top:-2px;">
<table cellspacing="0" cellpadding="0" >
<tr>
<td width="255px" border="1">
<table>
<tr>
<th style="font-size:8.5px;text-align:left;" colspan="6">1. We confirm that the valve was manufactured, inspected and tested in accordance with applicable drawing,material specifications, purchase order and was found meet the requirements.</th>
</tr>
<tr>
<td style="font-size:8.5px;text-align:left;" colspan="6">2. The test water used for Hydostatic test,chloride content has been testedas per '.$pressureAsper.' and found within the specified limits.</td>
</tr>
<tr>
<td style="font-size:8.5px;text-align:left;" colspan="6">3. The Valve test successfully passed part has been stamped low stress stamp with Letter "HA" on end flange OD.</td>
</tr>

</table>
</td>

<td width="255px">
<table border="1" cellpadding="3">
<tr>
<td style="font-size:12px;" colspan="6" ><b>Test Summery</b></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">Quantity Offered</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>
<td style="font-size:8.5px;" colspan="1" rowspan="6"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">Quantity Accepted</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">Visual Check</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">Dimension Check</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">MTC Verification</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>
</tr>
<tr>
<td style="font-size:8.5px;" colspan="3">Functional Test</td>
<td style="font-size:8.5px;text-align:center;" colspan="2"></td>

</tr>

</table>
</td>
</tr>
</table>
</div>';


$output = '';  
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'Report_1232/pdf/REPORT_'.$_GET['vsn'].'_'.$_GET['test_no'].'.pdf', 'F');

// }

?>
<script>alert("PDF SAVED SUCCESSFULLY ")</script>

<script>window.location = "new_vtr_reports.php?valve_serial_no=<?php echo $_GET['vsn'];?>&test_no=<?php echo $_GET['test_no'];?>&holding=<?php echo $_GET['holding_set'];?>"; </script>
