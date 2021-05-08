<?php
 $host_name = "localhost";
$database = "e1227"; // Change your database name
$username = "root";          // Your database user id
$password = "hydro";          // Your password

//error_reporting(0);// With this no error reporting will be there
//////// Do not Edit below /////////
// $valve_serial_no = $_GET['valve_serial_no'];
session_start();
$conn = mysqli_connect($host_name, $username, $password, $database);
// $sql="SELECT month,sale FROM chart_data_column";
// $sql="SELECT `pressure`,`time` FROM graph_generation WHERE component_serial_no='$valve_serial_no' ORDER BY id ASC";
// // echo $sql;
// $result = $conn->query($sql);
//
//     if($result->num_rows > 0){
//         while($row = $result->fetch_assoc()){ // use fetch_assoc
//             $dataPoints[] = array("label" => substr($row['time'],11), "y" => $row['pressure']);
//             // $dataPoints[] = array("label" => $row['time'], "y" => $row['pressure']);
//
//
//         }
//         // echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
//     }

dataPoints: [
			{ y: 450 },
			{ y: 414},
			{ y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }
		]
	// echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1",
	title: {
		text: "Hydro"
	},

	axisY: {
		title: "Pressure",
		labelFontSize: 10,
		gridThickness: 0.4
		// scaleBreaks: {
		// 	autoCalculate: true

		// }



	},
	axisX: {
		title: "Time",
		labelFontSize: 10,
		options: {
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 90
                }
            }]
        }
    }

		},
	data: [{
		type: "line",
		// yValueFormatString: "#,##0\"%\"",
		// indexLabel: "{y}",
		// indexLabelPlacement: "None",
		// indexLabelFontColor: "red",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
  var x = document.getElementsByClassName("canvasjs-chart-credit");
 x[0].style.visibility = 'hidden';
}
</script>
</head>
<body>
<!-- <div id="chartContainer" style="height: 80px; width: 100%; margin-top: 50% ;transform: rotate(90deg);"></div> -->

<div class="col-lg-10" style="text-align: center; margin-left: 0%;margin-top: 0%;">
   <div id="chartContainer"></div>

    </div>
<script src="lib/js/canvas.min.js"></script>
</body>
</html>
