<nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="adminPanel.php">Dashboard</a>
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            
            <a class="btn btn-primary btn-main btn-main-w" href="../logout.php" style="margin-left:75%;">Logout</a>
           
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav bg-light shadow" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="adminPanel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                           
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Table
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#userOverview" aria-expanded="false" aria-controls="userOverview">
                                        User Overview
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="userOverview" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="registeredUsers.php">Registered Users</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#hospitalOverview" aria-expanded="false" aria-controls="hospitalOverview">
                                        Hospital Overview
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="hospitalOverview" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="registeredHospitals.php">Registered Hospitals</a>
                                            <a class="nav-link" href="deactivatedHospitals.php">Deactivated Hospitals</a>
                                            <a class="nav-link" href="requestActivation.php">Request Activation</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#appointmentOverview" aria-expanded="false" aria-controls="appointmentOverview">
                                        Appointments
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="appointmentOverview" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="appointments.php">Appointments</a>

                                        </nav>
                                    </div>
                                  
                                </nav>
                            </div>
                            <a class="nav-link"  href="ChangePassword.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Change Password
                            </a>
                            <a class="nav-link"  href="AddAdmin.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user-plus"></i></div>
                                Add Admin
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
