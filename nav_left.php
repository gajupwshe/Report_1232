<?php
// session_start();
?>
<aside class="left-side sidebar-offcanvas" style="height: 100%; background: #ebedec; margin-top: -50px; position: fixed;width:175px;">
    <!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">

            <img src="img/19.jpg" style="width: 150px;" alt="User Image" />


    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        

        
        <li class="active">
            <a href="index.php?db_user=<?php echo $_SESSION['db_user'];?>&db_pass=<?php echo $_SESSION['db_pass'];?>&db_name=<?php echo $_SESSION['db_name'];?>">
                <i class="fa fa-th"></i> <span><b style="font-size: 18px;"><!-- <img src="img/right-arrow.png" style="height: 1em;width: 1em;" alt="User Image" /> --> Daily Reports</b> </span>
            </a>
        </li>
        <li class="active">
            <a href="weekly_details.php">
                <i class="fa fa-th"></i> <span><b style="font-size: 18px;"><!-- <img src="img/right-arrow.png" style="height: 1em;width: 1em;" alt="User Image" /> -->Weekly Reports</b></span>
            </a>
        </li>
        <li class="active">
            <a href="monthly_report.php">
                <i class="fa fa-th"></i> <span><b style="font-size: 18px;"><!-- <img src="img/right-arrow.png" style="height: 1em;width: 1em;" alt="User Image" /> -->Monthly Reports</b></span>
            </a>
        </li>
        <li class="active">
            <a href="admin_activity_report.php">
                <i class="fa fa-th"></i> <span><b style="font-size: 18px;"><!-- <img src="img/right-arrow.png" style="height: 1em;width: 1em;" alt="User Image" /> -->Customized Reports</b></span>
            </a>
        </li>


    </ul>
</section>


    <!-- /.sidebar -->
</aside>
