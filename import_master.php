<?php

require_once "Classes/PHPExcel.php";

// include('db_config.php');
$connection = new mysqli('localhost', 'root', 'hydro', 'e1254') or trigger_error(mysqli_error(),E_USER_ERROR);
$RecSerialnumber="";
$Serialnumber="";

$output = '';
if (isset($_POST["import"])) {
    $explode_return = explode(".", $_FILES["excel"]["name"]);
//    $explode_return = explode(".", $_FILES["/opt/op_master.xls"]["name"]);
    $extension = end($explode_return); // For getting Extension of selected file
    $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
    if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
    {
        $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
        include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

        $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
        $output .= "<tr>";
        $output .= '<th>Serial Number</th>';
        $output .= '<th>Material</th>';
        $output .= '<th>Size</th>';
        $output .= '<th>Class</th>';
        $output .= '<th>Order</th>';
        $output .= '<th>Type</th>';
        $output .= '<th>SO Number</th>';
        $output .= '<th>Item</th>';
        // $output .= '<th>Customer Name</th>';
        // $output .= '<th>Body</th>';
        // $output .= '<th>Plug</th>';
        // $output .= '<th>Cover</th>';
        // $output .= '<th>Cage</th>';
        $output .= '</tr>';
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();

            for ($row = 2; $row <= $highestRow; $row++) {
                $output .= "<tr>";

                $Serialnumber = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                $Material = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $Size = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $Class = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $Order = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $Type = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                $SONumber = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                $Item = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                $CustomerName = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                $Body = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                $Plug = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                $Cover = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                $Cage = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
echo "rec-".$RecSerialnumber;
echo "ser-".$Serialnumber;
                if($RecSerialnumber!=$Serialnumber){

                $query = "INSERT INTO `master_data`(`serial_number`, `material`, `valve_size`, `valve_class`, `valve_order`, `valve_type`, `so_number`, `item`, `customer_name`, `body`, `plug`, `cover`, `cage`) VALUES ('" . $Serialnumber . "', '" . $Material . "', '".$Size."', '" . $Class  . "', '" . $Order . "', '" . $Type . "', '" .  $SONumber . "', '" . $Item . "', '" . $CustomerName. "', '" . $Body . "', '" . $Plug . "', '" .  $Cover . "', '" . $Cage . "')";

//echo $query;
                mysqli_query($connection, $query);
                $output .= '<td>' . $Serialnumber . '</td>';
                $output .= '<td>' . $Material . '</td>';
                $output .= '<td>' . $Size . '</td>';
                $output .= '<td>' . $Class . '</td>';
                $output .= '<td>' . $Order . '</td>';
                $output .= '<td>' . $Type . '</td>';
                $output .= '<td>' . $SONumber . '</td>';
                $output .= '<td>' . $Item . '</td>';
                // $output .= '<td>' . $CustomerName . '</td>';
                // $output .= '<td>' . $Body . '</td>';
                // $output .= '<td>' . $Plug . '</td>';
                // $output .= '<td>' . $Cover . '</td>';
                // $output .= '<td>' . $Cage . '</td>';
                $output .= '</tr>';
                }
                $RecSerialnumber=$Serialnumber;
            }

        }
        $output .= '</table>';

    } else {
        $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
    }
}else if (isset($_POST["export"])) {
//            $query = mysqli_query($conn, 'select * from demo'); // Get data from Database from demo table


            $delimiter = ",";
            $filename = "Machine_master.xlsx"; // Create file name

            //create a file pointer
            $f = fopen('php://memory', 'w');

            //set column headers
            $fields = array('Serial Number', 'Material', 'Size','Class','Order','Type','SO Number','Item','Customer Name','Body','Plug','Cover','Cage');
            fputcsv($f, $fields, $delimiter);
             $lineData = array('AHC2134', '02501WC8M-M498', '1','150','9291702','XM02','334861','000050','SRF LIMITED','WCB','CF8M','WCB','NA');
             // $lineData2 = array('A', 'CNC Haas ( LATHE)- 3ST-35', 'ST-35');

            fputcsv($f, $lineData, $delimiter);

            //output each row of the data, format line as csv and write to file pointer
//            while($row = $query->fetch_assoc()){
//
//                $lineData = array($row['id'], $row['country'], $row['state'], $row['city'], $row['pin']);
//                fputcsv($f, $lineData, $delimiter);
//            }

            //move back to beginning of file
            fseek($f, 0);

            //set headers to download file rather than displayed
            header('Content-Type: text/xlsx');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //output all remaining data on a file pointer
            fpassthru($f);
            return;
}
?>
<html>
<head>
    <title>Import Master</title>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 700px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 100px;
        }

    </style>
</head>
<body>
<div class="container box">
    <h3 align="center">Import Master Data</h3><br/>
    <form method="post" enctype="multipart/form-data">
        <label>Select Excel File</label>
        <input type="file" name="excel"/>
        <br/>
        <input type="submit" name="import" class="btn btn-info" value="Import"/>
    </form>
    <br/>
    <?php
        echo $output;
    ?>
    <h6 align="center" ><font color="red">Format of Master Data in excel sheet<br/> Please DownLoad</font></h6>

    <form method="post" enctype="multipart/form-data"  style="text-align: center;">
        <input style="alignment: center" type="submit" name="export" class="btn btn-info" value="Export"/>
        <label >(<font color="#EC3B3B">Instruction:</font>If any of the fields are not applicable as per your standard please fill it as 'NA' in cells of excel sheet.Please Do not add or remove extra cells in excel sheet,Please follow the standard format!!)</label>
    </form>
</div>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
