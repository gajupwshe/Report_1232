<?php

$valve_serial_no = $_GET['valve_serial_no'];

$test_no=$_GET['test_no'];
$holding_set =$_GET['holding'];
$test_type = $_GET['test_type'];
// $tt='';
session_start();
$conn = new mysqli('localhost', $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']) or trigger_error(mysqli_error(),E_USER_ERROR);



// Shell Test

$sql="SELECT `pressure`,`time`,`date_time`,`hold_start` FROM graph_generation WHERE component_serial_no='".$valve_serial_no."'  AND test_type='".$test_type."' AND test_no='".$test_no."'  ORDER BY id ASC "; 
echo $sql;
$result = $conn->query($sql);
$flag=1;
$flag_1=1;
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){ // use fetch_assoc
    try {
            $pressure = round($row['pressure']);
          
    $dataPoints1[] = array("label" => $row['date_time'], "y" => $pressure);
    
    // }
    } catch (\Exception $e) {

    }

}

}else{
    // $dataPoints1[] = array("label" => $row['date_time'], "y" =>  $pressure);
}


    



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

        <!-- /.sidebar -->

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side" style="margin-Left:175px;">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">

<button  id="printbutton" class="btn btn-success"  style="margin-left: 900px;">PRINT</button>


<!-- <p id="text" style="display:none">Checkbox is CHECKED!</p> -->
<!-- <label>Graph not required</label> <input type="checkbox" id="chkVisi" name="Graph" onclick="visible();"/> -->

<div class="row" id="GFG">

    


<p id="displayDiv" style="display:none">
    <!-- <div id="hide_me"> -->
<div class="col-xs-12 connectedSortable">
<div class="col-lg-12 connectedSortable" style="padding: 0%;margin-right: 10px;margin-left: 10px; border: thin solid black; height:800px" >

    <div class="col-lg-12" style="text-align: center; padding: 0%;margin: 0%;">

                    <table width='100%' border="1" rules="all">

<tr>
<!-- <span style="text-align:Right;font-size:20px">MATRIX METALS  </span> -->
<th style="border: 1px solid #000; text-align:center;" colspan="10">
<!-- <img  src="http://dummyimage.com/68x68/000/fff" /> -->
<img  src="img/2072933.png" style="height:48px;width:90px;float:Left;" />

    <img  src="img/xmox.png" style="height:48px;width:90px;float:right;" />
<?php
    echo nl2br("\nPeekay Steel Castings Private Limited");

?>


</th>
</tr>
<tr>

<!-- <th>Report Number : <?php echo $report;?></th> -->
</tr>
</table>

 <div class="col-md-2">
    <?php
    // switch ($test_type) {
    //     case '0':
    //         $tt='Hydrostatic Shell';
    //         break;
    //     case '1':
    //         $tt= 'Hydrostatic Seat A';
    //         break;
    //     case '2':
    //         $tt= 'Hydrostatic Seat B';
    //         break;
    //     case '3':
    //         $tt= 'Air Seat A';
    //         break;
    //     case '4':
    //         $tt= 'Air Seat B';
    //         break;
    //     case '5':
    //         $tt= 'Nitrogen Shell';
    //         break;
    //     case '6':
    //         $tt= 'Nitrogen Seat A';
    //         break;
    //     case '7':
    //         $tt= 'Nitrogen Seat B';
    //         break;
        
    //     default:
    //         # code...
    //         break;
            // }
?>
    Valve Sl.no : <?php echo $valve_serial_no; ?><br>
    Test Type :  <?php echo $test_type; ?>
 </div>
<div class="col-lg-10" style="text-align: center; margin-top: 5%;margin-left: 5%;" >
    

    <div id="chartContainer1"  ></div>
</div>


</div>

</div>
</div>
<label style="float:right;margin-right: 9px; font-size: 8px;"></label>

<br/><br/><br/><br/><br/>
<!-- <label style="float:right;margin-right: 9px;font-size: 8px;">F-PRD-09-HYDRO/C, RO, 04-JUL-20</label> -->

</p>
</div>

</div>

<script type="text/javascript">
    function dispFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("graphCheck");
  // Get the output text
  var x = document.getElementById("displayDiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }

//   function dispFunction() {
//   var x = document.getElementById("graphCheck").checked;
//   document.getElementById("displayDiv").innerHTML = x;
// }
} 
</script>

<script type="text/javascript">
    var print = document.createElement('button')
    var canvas = document.createElement('canvas')
    var ctx = canvas.getContext('2d')

    canvas.width = 300;
    canvas.height = 100;

    ctx.fillStyle = '#000'
    ctx.font = '15px Arial-black'

    document.getElementById('GFG').appendChild(canvas)

    document.getElementById('printbutton').addEventListener('click', function () {
        printJS('GFG', 'html')
    });


</script>
<script src="js/print.js"></script>



<!-- /.col -->
</div>
<!-- /.row -->
<script src="lib/js/canvas.min.js"></script>
<script type="text/javascript">
    function visible(){
         var div = document.getElementById("hide_me");
        if (document.getElementById('chkVisi').checked) 
  {
     
      div.style.display = "none";
  } else {
      div.style.display = "block";
  }
    }
</script>
<!-- Main row -->
<script type="text/javascript">
    function chart1_display(){

        var uom = 'bar';
        // alert(uom)

        var  chart1 = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: false,
            height:380,
      width:600,
            theme: "light1",
            // title: {
            //     text: <?php// echo $tt;?>
            // },
            axisY: {
            title: "Pressure".concat("(").concat(uom).concat(")"),
                labelFontSize: 10,
                gridThickness: 0.4
        // scaleBreaks: {
        //  autoCalculate: true

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
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
        });

    chart1.render();
    }
</script>
<script type="text/javascript">
    function chart2_display(){
        var uom = document.getElementById("uom").value;
        

        var  chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: false,
            height:380,
      width:900,
            theme: "light1",
            title: {
                text: <?php echo $test_type;?>
            },
            axisY: {
            title: "Pressure".concat("(").concat(uom).concat(")"),
                labelFontSize: 10,
                gridThickness: 0.4
        // scaleBreaks: {
        //  autoCalculate: true

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
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
        });

    chart2.render();
    }
</script>
<script type="text/javascript">
    function chart3_display(){
        var uom = document.getElementById("uom").value;
        
var  chart3 = new CanvasJS.Chart("chartContainer3", {
            animationEnabled: false,
            height:380,
      width:900,
            theme: "light1",
            title: {
                text: "Hydro Static Seat B"
            },
            axisY: {
            title: "Pressure".concat("(").concat(uom).concat(")"),
                labelFontSize: 10,
                gridThickness: 0.4
        // scaleBreaks: {
        //  autoCalculate: true

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
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
        });
    chart3.render();
        
    }
</script>
<script type="text/javascript">
    function chart4_display(){
        var uom = document.getElementById("uom").value;
        

        var  chart4 = new CanvasJS.Chart("chartContainer4", {
            animationEnabled: false,
            height:380,
      width:900,
            theme: "light1",
            title: {
                text: "Air Seat A"
            },
            axisY: {
            title: "Pressure".concat("(").concat(uom).concat(")"),
                labelFontSize: 10,
                gridThickness: 0.4
        // scaleBreaks: {
        //  autoCalculate: true

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
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
        });

    chart4.render();
    }
</script>
<script type="text/javascript">
    function chart5_display(){
        var uom = document.getElementById("uom").value;
        
var  chart5 = new CanvasJS.Chart("chartContainer5", {
            animationEnabled: false,
            height:380,
        width:900,
            theme: "light1",
            title: {
                text: "Air Seat B"
            },
            axisY: {
            title: "Pressure".concat("(").concat(uom).concat(")"),
                labelFontSize: 10,
                gridThickness: 0.4
        // scaleBreaks: {
        //  autoCalculate: true

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
        
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
        });

        chart5.render();
    }
</script>
<script>

    // window.onload = function () {
        

        $("#btnprint").click(function(){
            // alert("start");
            html2canvas(document.querySelector("#printArea")).then(canvas => {
                var dataURL = canvas.toDataURL();
                var width = canvas.width;
                var printWindow = window.open("");
                $(printWindow.document.body)
                .html("<img id='Image' src=" + dataURL + " style='" + width + "'></img>")

                .ready(function() {
                    printWindow.focus();
                    printWindow.print();
                });
            });
        });


// }




</script>
<script type="text/javascript">
    window.addEventListener("load", myInit, true); 
    function myInit(){  

        chart1_display();
        // chart2_display();
        // chart3_display();
        // chart4_display();
        // chart5_display();
     }; 
</script>







</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->

<!-- add new calendar event modal -->



<!-- jQuery 2.0.2 -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!-- jQuery UI 1.10.3 -->
<!--<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
<!-- Bootstrap -->

<!-- Morris.js charts -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>-->
<!-- Sparkline -->
<!--<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>-->
<!-- jvectormap -->
<!--<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>-->
<!--<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>-->
<!-- fullCalendar -->
<!--<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>-->
<!-- daterangepicker -->
<!--<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>-->
<!-- Bootstrap WYSIHTML5 -->
<!--<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
<!-- iCheck -->
<!--<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>-->
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
//var a=document.getElementsById("btnprint");
//a.style.visibility='hidden';

// function printDiv(divName) {
//      var printContents = document.getElementById(divName).innerHTML;
//      var originalContents = document.body.innerHTML;
//
//      document.body.innerHTML = printContents;
//
//      chart.print();
//
//      document.body.innerHTML = originalContents;
// }
// FusionCharts.printManager.enabled(true);
// function printDiv(divName) {
//      var printContents = document.getElementById(divName).innerHTML;
//      var originalContents = document.body.innerHTML;
//
//      document.body.innerHTML = printContents;
//
//      window.print();
//
//      document.body.innerHTML = originalContents;
//
// }
</script>

</body>
</html>
