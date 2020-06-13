<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="index.php" class="logo">
                <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Natours</span>
            </a>
        </div>
        <ul class="nav user-menu">
            <li><?php echo $_SESSION['full_name'] ?>
                <a class="dropdown-item" href="logout">Logout</a>
            </li>
        </ul>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li><a href="dashboard"><span>Dashboard</span></a></li>
                    <li><a href="doctors"><span>Doctors</span></a></li>
                    <li><a href="patients"></i> <span>Patients</span></a></li>
                <!--     <li><a href="appointments"><span>Appointments</span></a></li> -->
                    <li><a href="schedules"><span>Doctor Schedule</span></a></li>
                    <li><a href="invoices"><span>Invoices</span></a></li>
                    <li><a href="medicines"><span>Medicine</span></a></li>
                    <li><a  href="insurances"><span>Insurance</span></a></li>
                </ul>
            </div>
        </div>
    </div>