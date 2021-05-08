<?php
//export.php


session_start();

$SR_NO=1;
$output = '';


require_once('tcpdf/tcpdf.php');

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("reintors-Hydrothrust");

$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'  ', PDF_HEADER_STRING,array(0,64,0), array(0,64,128));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(true);
$obj_pdf->setPrintFooter(true);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 11);
$obj_pdf->AddPage();
$content = '';
$content .= '
<img  src="img/L&T_logo.png" style="height: 50px;" /> <span> <b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;DETAIL REPORT     </b></span><br/>';
$conn1 = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(),E_USER_ERROR);

$sql = "SELECT DISTINCT(vd.`valve_serial_no`),vd.`imir_no`,vd.`valve_tag_no`,vd.`manufacturer`,vd.`customer`,vd.`operator`,vd.`shift`,vd.`project`,tr.`gauge_serial_no`,tr.`guage_calibration_date`,tr.`valve_type`,vd.`date_time`,tr.`valve_size`,tr.`test_type`,tr.`test_result`,tr.`valve_class` FROM `test_result` tr  JOIN `valve_data` vd ON (tr.`test_no` = vd.`test_no` AND tr.`test_type` = vd.`test_type`) WHERE  tr.`test_no` = ".$_SESSION['test_no']."";
//echo $sql;
$valve_serial = '';
$valve_tag = '';
$imir_no = '';
$result = $conn1->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
	$valve_serial = $row['valve_serial_no'];
	$valve_tag = $row['valve_tag_no'];
	$imir_no = $row['imir_no'];
 
	$result = $row['test_result'];
	$result_string = '';
	if($result == '0'){
		$result_string = 'TEST NOT OK';
	}else{
		$result_string = 'TEST OK';
	}
        $content .= ' 
         <div class="">
             <table border="" >
                  <tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; VALVE SERIAL NO. </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['valve_serial_no'] . ' </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; CUSTOMER </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['customer'] . '  </td>
                 </tr>
                 <tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; VALVE TAG NO. </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['valve_tag_no'] . ' </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; OPERATOR NAME </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['operator'] . ' </td>
                 </tr>
                 <tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; IMIR NO.</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row["imir_no"] . ' </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; MANUFACTURER</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['manufacturer'] . ' </td>
                 </tr>
                 <tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; VALVE SIZE </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['valve_size'] . ' </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; SHIFT</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['shift'] . '  </td>
                 </tr>
		<tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; VALVE CLASS </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['valve_class'] . ' </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; PROJECT</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['project'] . '  </td>
                 </tr>
                 <tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; VALVE TYPE </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['valve_type'] . ' </td>
			<td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; TEST DATE</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['date_time'] . '  </td>
                 </tr>
		 <tr>
                        <td style="border: 1px solid #000; width: 520px;text-align: start;"> </td>
                 </tr>
		<tr>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; TEST TYPE </b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $row['test_type'] . ' </td>
			<td style="border: 1px solid #000; width: 130px;text-align: start;"><b> &nbsp; TEST RESULT</b> </td>
                        <td style="border: 1px solid #000; width: 130px;text-align: start;"> &nbsp; ' . $result_string. ' </td>
                 </tr>
                 </table>
        </div>
          ';
    }
}
$content .='
<table border="1" cellspacing="0" cellpadding="3">
                <tr>
                     <th style="text-align:center;">Sr No.</th>
    <th style="text-align:center;">Date / Time</th> ';

if($_SESSION['test_type']  == 'DOUBLE BLOCK BLEED TEST'){;
    $content .='<th style="text-align:center;">PRESSURE AT A SIDE</th>
    
    <th style="text-align:center;">PRESSURE AT B SIDE</th> ';
}else{
    $content .='   <th style="text-align:center;">PRESSURE</th>';
}$content .='</tr>  ';

$content .= fetch_data();

$content .= '</table>';


$content .= '
<br/>
<br/>
<br/>
<br/>
<table align="center">
<tr>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;">SUBCONTRACTOR</td>
<td style="border: 1px solid #000; width: 120px;">CONTRACTOR</td>
<td style="border: 1px solid #000; width: 120px;">COMPANY</td>
</tr>
<tr style="height: 120px;">
<td style="border: 1px solid #000; width: 120px; "> <br/> NAME<br/></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
</tr>
<tr style="height: 120px;">
<td style="border: 1px solid #000; width: 120px; "> <br/>SIGN. <br/></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
</tr>
<tr style="height: 120px;">
<td style="border: 1px solid #000; width: 120px; "> <br/>DATE <br/></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
<td style="border: 1px solid #000; width: 120px;"></td>
</tr>


</table>';


$obj_pdf->writeHTML($content);

$path = "Report_948/reports/Valve_Details_Reports/VDR_of_".$_SESSION['test_no']."_".$valve_serial."_".$valve_tag."_".$imir_no;
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
//echo date('d-m-Y H:i:s');

$date =date("d-m-Y H:i:s");



$obj_pdf->Output($_SERVER['DOCUMENT_ROOT'] .$path.'.pdf', 'F');



function fetch_data()

{
    $SR_NO=1;
    $conn = mysqli_connect('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
    $output = '';
    
//    $query = "SELECT * FROM item_desc";
    $query = "SELECT * FROM `test_result_by_type` WHERE  `test_no` =".$_SESSION['test_no']." ";
//    $result1 = $conn->query($sql1);
    $result =mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $output .= '<tr align="center" style="border: 1px solid #000000">  
                          <td>'.$SR_NO++.'</td>  
                          <td>'.$row['date_time'].'</td>
                         ';
        if( $_SESSION['test_type'] == 'HYDROSTATIC SHELL' || $_SESSION['test_type'] == 'HYDROSTATIC SEAT A SIDE' || $_SESSION['test_type'] == 'PNEUMATIC A SIDE'){
            $output .= '<td>'.$row['hydro_pressure_a_side'].'</td>';
        }elseif ($_SESSION['test_type'] == 'HYDROSTATIC SEAT B SIDE' || $_SESSION['test_type'] == 'PNEUMATIC B SIDE'){
            $output .= '<td>'.$row['hydro_pressure_b_side'].'</td>';
        }elseif ($_SESSION['test_type'] == 'DOUBLE BLOCK BLEED TEST'){
            $output .= '<td>'.$row["hydro_pressure_a_side"].'</td>
                          <td>'.$row["hydro_pressure_b_side"].'</td>';
        } $output .= '      
                     </tr>  
                          ';
    }
    return $output;
}
//echo "test no".$_SESSION['test_no'];
//echo "test type".$_SESSION['test_type'];
?>
<script>alert("PDF SAVED SUCCESSFULLY_split_<?php echo $path;?>")</script>

<script>window.location = "details_report.php?test_no=<?php echo $_SESSION['test_no'];?>&test_type=<?php echo $_SESSION['test_type'];?>"; </script>



