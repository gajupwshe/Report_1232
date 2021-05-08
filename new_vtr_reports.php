<?php

$valve_serial_no = $_GET['valve_serial_no'];

$test_no=$_GET['test_no'];
$holding_set =$_GET['holding'];

session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(),E_USER_ERROR);

// Shell Test

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

	<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<style>
/* th, td {
  padding: 10px;
  } */
</style>
</head>
<body class="skin-black">
	<!-- header logo: style can be found in header.less -->


	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->

		<?php include('nav_left.php');?>

		
		<aside class="right-side" style="margin-Left:175px;">

			<section class="content">


				<button  id="generate_pdf" class="btn btn-success"  style="margin-left: 1000px;">
					<a href="new_vtr_pdf.php?valve_serial_no=<?php echo $valve_serial_no ?>&test_no=<?php echo $test_no;?>&holding=<?php echo $holding_set;?>" style="color: white;"><b>Export to PDF</b></a>
				</button>


				<div class="col-xs-12 connectedSortable">

					<table width="90%" border="1">
						<table width="90%" border="1">
							<?php
								$sql = "SELECT vsn,docNo,pcd,allowable_leakage,bodyHeat,discHeat,noOfHole FROM valve_data WHERE vsn='".$_GET['valve_serial_no']."' ORDER BY id  DESC LIMIT 1";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {

									$row = $result->fetch_assoc();
								
							?>
						<tr>
							<th rowspan="2" colspan="1" width="10%">
								<img src="img/AVK.png" style="width: 100px;">
							</th>
							<th colspan="2">
								<center>Test Report</center>
							</th>
						</tr>
						<tr>
							<th width="40%"></th>
							<th>Doc No. <?php echo $row['docNo'];?></th>
						</tr>

						<tr>
							<th rowspan="2" colspan="1" width="10%">
								Valve Serial No.
							</th>
							<th colspan="2">
								<center>Heat Number</center>
							</th>
						</tr>
						<tr>
							<th width="40%">Body</th>
							<th>Disc</th>
						</tr>
						<tr>
							<td><?php echo $row['vsn'];?></td>
							<td><?php echo $row['bodyHeat'];?></td>
							<td><?php echo $row['discHeat'];?></td>

						</tr>
						<tr>
							<td colspan="3" >
									&nbsp;
							</td>
						</tr>
					</table>
					<table width="90%" border="1">
						<tr>
							<th width="25%">
								Allowable SeatLeakage Volume(ml)
							</th>
							<td width="25%">
								<?php echo $row['allowable_leakage'];?>
							</td>
							<th width="25%">
								No Of Holes
							</th>
							<td width="25%">
								<?php echo $row['noOfHole'];?>
							</td>
						</tr>

						<tr>
							<th width="25%">
								 SeatLeakage Rate(ml)
							</th>
							<td width="25%">
								<?php echo '';?>
							</td>
							<th width="25%">
								PCD
							</th>
							<td width="25%">
								<?php echo $row['pcd'];?>
							</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
					</table>
				<?php } ?>
					<table border="1" width="90%">
						<?php
							$sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Body Test' AND  valve_serial_no='".$_GET['valve_serial_no']."'";
							$result= $conn->query($sql_body);
							if ($result->num_rows>0) {
								$row = $result->fetch_assoc();
							
						?>
						<tr>
							<th colspan="3">
								<center>Body Test</center>
							</th>
						</tr>
						<tr>
							<th>
								pressure(bar)
							</th>
							<th>
								Duration (sec)
							</th>
							<th>Result</th>
						</tr>
						<tr>
							<td><?php echo $row['stop_pressure_a'];?></td>
							<td><?php echo $row['over_all_time'];?></td>
							<td><?php echo $row['test_result'];?></td>
							
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					<?php }	?>

					</table>
					<!-- Seat Test -->
					<table border="1" width="90%">
						<?php
							$sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Seat Test (Preffered Dummy)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
							$result= $conn->query($sql_body);
							if ($result->num_rows>0) {
								$row = $result->fetch_assoc();
							
						?>
						<tr>
							<th colspan="3">
								<center>Seat Test (Flow Direction</center>
							</th>
						</tr>
						<tr>
							<th>
								pressure(bar)
							</th>
							<th>
								Duration (sec)
							</th>
							<th>Result</th>
						</tr>
						<tr>
							<td><?php echo $row['stop_pressure_a'];?></td>
							<td><?php echo $row['over_all_time'];?></td>
							<td><?php echo $row['test_result'];?></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					<?php } ?>
					</table>
					<!-- Seat test 1 -->
					<table border="1" width="90%">
						<?php
							$sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE test_type='Seat Test (Non Preffered)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
							$result= $conn->query($sql_body);
							if ($result->num_rows>0) {
								$row = $result->fetch_assoc();
							
						?>
						<tr>
							<th colspan="3">
								<center>Seat test 1</center>
							</th>
						</tr>
						<tr>
							<th>
								pressure(bar)
							</th>
							<th>
								Duration (sec)
							</th>
							<th>Result</th>
						</tr>
						<tr>
							<td><?php echo $row['stop_pressure_a'];?></td>
							<td><?php echo $row['over_all_time'];?></td>
							<td><?php echo $row['test_result'];?></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					<?php } ?>
					</table>
					<!-- Disc strength test -->

					<table border="1" width="90%">
						<?php
							$sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE  test_type='Disc Strength Test' AND valve_serial_no='".$_GET['valve_serial_no']."'";
							$result= $conn->query($sql_body);
							if ($result->num_rows>0) {
								$row = $result->fetch_assoc();
							
						?>
						<tr>
							<th colspan="3">
								<center>Disc strength test</center>
							</th>
						</tr>
						<tr>
							<th>
								pressure(bar)
							</th>
							<th>
								Duration (sec)
							</th>
							<th>Result</th>
						</tr>
						<tr>
							<td><?php echo $row['stop_pressure_a'];?></td>
							<td><?php echo $row['over_all_time'];?></td>
							<td><?php echo $row['test_result'];?></td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
					<?php } ?>
					</table>

					<!-- Seat test 2 -->
					<table border="1" width="90%">
						<?php
							$sql_body = "SELECT stop_pressure_a,over_all_time,test_result FROM test_result WHERE  test_type='Seat Test ( Preffered)' AND valve_serial_no='".$_GET['valve_serial_no']."'";
							$result= $conn->query($sql_body);
							if ($result->num_rows>0) {
								$row = $result->fetch_assoc();
							
						?>
						<tr>
							<th colspan="3">
								<center>Seat test 2</center>
							</th>
						</tr>
						<tr>
							<th>
								pressure(bar)
							</th>
							<th>
								Duration (sec)
							</th>
							<th>Result</th>
						</tr>
						<tr>
							<td><?php echo $row['stop_pressure_a'];?></td>
							<td><?php echo $row['over_all_time'];?></td>
							<td><?php echo $row['test_result'];?></td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;	
							</td>
						</tr>
					<?php } ?>
					</table>
					<table border="1" width="90%">
						<th width="10%">Date</th>
						<th width="35%"></th>
						<th width="10%">Initial Sign</th>
						<th></th>
					</table>
					</table>
				</div>
			</section>
		</aside>
	</div>






	<!-- AdminLTE App -->
	<script src="js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
	<!-- jQuery 2.0.2 -->
	<script src="js/jquery.min.js"></script>
	<!-- DATA TABES SCRIPT -->
	<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/html2canvas.js" type="text/javascript"></script>
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
	<script type="text/javascript">

	</script>

</body>
</html>
