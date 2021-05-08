<?php
$hostname = "localhost";
$database = "e1227";
$username = "root";
$password = "hydro";
//$hostname = "166.62.8.9";
//$database = "recruitmentdb";
//$username = "recruitmentdb";
//$password = "CtpL1978!@#";


$page = "";
$subpage = "";
$subsubpage = "";
error_reporting(0);

$conn = new mysqli($hostname, $username, $password, $database) or trigger_error(mysql_error(),E_USER_ERROR);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$allowedExts = array("pdf", "PDF","txt","TXT","csv","log","xls","xlsx");	//, "log", "psv", "csv");





function getSpecificFromTable($table_name, $query_condition){
    $sql = "SELECT * FROM ".$table_name.$query_condition;
    echo $sql;
    $res = mysql_query($sql) or die(mysql_error());
    return $res;
}


function getAllFromTable($table_name){
    $sql = "SELECT * FROM ".$table_name;
    echo $sql;
    $res = mysql_query($sql) or die(mysql_error());
    return $res;
}



?>
