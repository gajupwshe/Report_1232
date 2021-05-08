<!-- <script>alert("PDF SAVED SUCCESSFULLY ")</script> -->


<?php
session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(), E_USER_ERROR);


$valve_serial_no = $_GET['valve_serial_no'];
$test_no=$_GET['test_no'];
$holding_set =$_GET['holding'];




// if(isset($_GET["generate_pdf"]))
// {
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
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $content = '';
    // $content .= '

    // <table width="90%" border="1">
    
    // ';
    $sql = "SELECT vsn,docNo,pcd,allowable_leakage,bodyHeat,discHeat,noOfHole FROM valve_data WHERE vsn='".$_GET['valve_serial_no']."' ORDER BY id  DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $content .= '
        <table width="100%" border="1">
        <tr>
        <th rowspan="2" colspan="1" width="15%">
        <br><br>
        <img src="img/AVK.png" style="width: 50px;">
        </th>
        <th colspan="2" width="85%" style="text-align:center;font-size:18px;">
        <b>Test Report</b>
        </th>
        </tr>
        <tr>
        <th width="42%"></th>
        <th width="43%"> Doc No. '.$row['docNo'].'</th>
        </tr>

        <tr>
        <th rowspan="2" colspan="1" width="15%">
        Valve Serial No.
        </th>
        <th colspan="2" width="85%" style="text-align:center;font-size:14px;">
        Heat Number
        </th>
        </tr>
        <tr>
        <th width="42.5%"> Body</th>
        <th> Disc</th>
        </tr>
        <tr>
        <td>&nbsp;'.  $row['vsn'] .'</td>
        <td>&nbsp;'.  $row['bodyHeat'] .'</td>
        <td>&nbsp;'.  $row['discHeat'] .'</td>

        </tr>
        <tr>
        <td colspan="3" >
        &nbsp;
        </td>
        </tr>
        </table>
        <table width="100%" border="1">
        <tr>
        <th width="25%">
        Allowable SeatLeakage Volume(ml)
        </th>
        <td width="25%">
        '.$row['allowable_leakage'].'
        </td>
        <th width="25%">
        No Of Holes
        </th>
        <td width="25%">
        '. $row['noOfHole'].'
        </td>
        </tr>

        <tr>
        <th width="25%">
        SeatLeakage Rate(ml)
        </th>
        <td width="25%">

        </td>
        <th width="25%">
        PCD
        </th>
        <td width="25%">
        '. $row['pcd'].'
        </td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        </table>

        ';
    }
    
    $sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Body Test' AND  valve_serial_no='".$_GET['valve_serial_no']."'";
    $result= $conn->query($sql_body);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();

        $content.='
        <table border="1" width="100%">
        <tr>
        <th colspan="3" style="text-align:center;font-size:14px;">
        <b>Body Test</b>
        </th>
        </tr>
        <tr>
        <th>
        pressure(bar)
        </th>
        <th>
        Duration (sec)
        </th>
        <th> Result</th>
        </tr>
        <tr>
        <td>&nbsp;'. $row['stop_pressure_a'].'</td>
        <td>&nbsp;'. $row['over_all_time'].'</td>
        <td>&nbsp;'. $row['test_result'].'</td>

        </tr>
        <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
        </table>
        ';
    }

    
    $sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Seat Test (Preffered Dummy)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
    $result= $conn->query($sql_body);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $content.='
        <table border="1" width="100%">
        <tr>
        <th colspan="3" style="text-align:center;font-size:14px;">
        <b>Seat Test (Flow Direction)</b>
        </th>
        </tr>
        <tr>
        <th>
        pressure(bar)
        </th>
        <th>
        Duration (sec)
        </th>
        <th>&nbsp;Result</th>
        </tr>
        <tr>
        <td>&nbsp;'. $row['stop_pressure_a'].'</td>
        <td>&nbsp;'. $row['over_all_time'].'</td>
        <td>&nbsp;'. $row['test_result'].'</td>
        </tr>
        <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
        </table>
        ';
    }   


    $sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Disc Strength Test' AND valve_serial_no='".$_GET['valve_serial_no']."'";
    $result= $conn->query($sql_body);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $content.='
        <table border="1" width="100%">
        <tr>
        <th colspan="3" style="text-align:center;font-size:14px;">
        <b>Disc strength test</b>
        </th>
        </tr>
        <tr>
        <th>
        pressure(bar)
        </th>
        <th>
        Duration (sec)
        </th>
        <th>&nbsp;Result</th>
        </tr>
        <tr>
        <td>&nbsp;'. $row['stop_pressure_a'].'</td>
        <td>&nbsp;'. $row['over_all_time'].'</td>
        <td>&nbsp;'. $row['test_result'].'</td>
        </tr>
        <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
        </table>
        ';
    }                            

    $sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Seat Test (Non Preffered)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
    $result= $conn->query($sql_body);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();

        $content.='
        <table border="1" width="100%">
        <tr>
        <th colspan="3" style="text-align:center;font-size:14px;">
        <b>Seat test 1</b>
        </th>
        </tr>
        <tr>
        <th>
        pressure(bar)
        </th>
        <th>
        Duration (sec)
        </th>
        <th>&nbsp;Result</th>
        </tr>
        <tr>
        <td>&nbsp;'. $row['stop_pressure_a'].'</td>
        <td>&nbsp;'. $row['over_all_time'].'</td>
        <td>&nbsp;'. $row['test_result'].'</td>
        </tr>
        <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
        </table>
        ';
    }



    $sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE  test_type='Seat Test ( Preffered)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
    $result= $conn->query($sql_body);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();

        $content.='
        <table border="1" width="100%">
        <tr>
        <th colspan="3" style="text-align:center;font-size:14px;">
        <b> Seat test 2 </b>
        </th>
        </tr>
        <tr>
        <th>
        pressure(bar)
        </th>
        <th>
        Duration (sec)
        </th>
        <th>&nbsp;Result</th>
        </tr>
        <tr>
        <td>&nbsp;'. $row['stop_pressure_a'].'</td>
        <td>&nbsp;'. $row['over_all_time'].'</td>
        <td>&nbsp;'. $row['test_result'].'</td>
        </tr>
        <tr>
        <td colspan="4">
        &nbsp;  
        </td>
        </tr>
        </table>
        ';

    }
    $content.='
    <table border="1" width="100%">
    <tr>
    <td width="10%" >Date</td>
    <td width="35%"></td>
    <td width="20%">Initial Sign</td>
    <td  width="35%"></td>
    </tr>
    </table>
    ';

    // $content.='

    // </table>
    // ';


    $output = '';  
    $obj_pdf->writeHTML($content);






    $obj_pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'Report_1377/pdf/REPORT_'.$_GET['valve_serial_no'].'.pdf', 'F');

    $path_copy="C:/wamp64/www/Report_1377/pdf/REPORT_".$_GET['valve_serial_no'].".pdf" ;
    $file_name="REPORT_".$_GET['valve_serial_no'].".pdf";
    copy($path_copy, "D:/report_1377/".$file_name);
    unlink($path_copy);

// }

    ?>
<script>
    alert("PDF SAVED SUCCESSFULLY")
     window.location = "new_vtr_reports.php?valve_serial_no=<?php echo $_GET['valve_serial_no'];?>&test_no=<?php echo $_GET['test_no'];?>&holding=<?php echo $_GET['holding'];?>";
</script>

