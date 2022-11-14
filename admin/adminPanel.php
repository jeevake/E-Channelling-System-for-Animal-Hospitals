<?php 
    require '../core.php';
    require '../database_connector.php';
    require '../functions.php';
    
    if(loggedin()){
    

        //COUNT OF  TOTAL HOSPITALS IN THE SYSTEM
        $hos_total_query="SELECT * FROM `hospital`";
    
        if($query_run_total = mysqli_query($con,$hos_total_query)){
            $hos_total_count = mysqli_num_rows( $query_run_total );
        }else{
            $hos_total_count = 0;
        }
    
        //COUNT OF  TOTAL USERS IN THE SYSTEM
        $users_total_query="SELECT * FROM `petowner`";
    
        if($query_run_total = mysqli_query($con,$users_total_query)){
            $users_total_count = mysqli_num_rows( $query_run_total );
        }else{
            $users_total_count = 0;
        }
        
        //COUNT OF  HOSPITALS THAT ARE ACTIVATED
        $hos_active_query="SELECT * FROM `hospital` WHERE `status`= 'activated'";
    
        if($query_run_active = mysqli_query($con,$hos_active_query)){
            $hos_active_count = mysqli_num_rows( $query_run_active );
        }else{
            $hos_active_count = 0;
        }
    
        //COUNT OF HOSPITALS THAT ARE DEACTIVATED
        $hos_deactive_query="SELECT * FROM `hospital` WHERE `status`= 'deactivated'";
    
        if($query_run_deactive = mysqli_query($con,$hos_deactive_query)){
            $hos_deactive_count = mysqli_num_rows( $query_run_deactive );
        }else{
            $hos_deactive_count = 0;
        }
    
        //COUNT OF HOSPITALS THAT REQUEST FOR ACTIVATION
        $hos_req_active_query="SELECT * FROM `hospital` WHERE `status`= 'deactivated' AND requestActivation='yes'";
    
        if($query_run_req_active = mysqli_query($con,$hos_req_active_query)){
            $hos_req_active_count = mysqli_num_rows( $query_run_req_active );
        }else{
            $hos_req_active_count = 0;
        }

        //COUNT OF HOSPITALS THAT REQUEST FOR ACTIVATION
        $todayDate = date('Y-m-d');
        $appoint_query="SELECT * FROM `appointment` WHERE appointmentDate >= '$todayDate'";
    
        if($query_run_appoint = mysqli_query($con,$appoint_query)){
            $appoint_count = mysqli_num_rows( $query_run_appoint );
        }else{
            $appoint_count = 0;
        }
    
    }
    // else{
    //     header("Location: ../mainPage.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Panel</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="../web/index.css">

        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <!-- navbar -->
    <?php require 'navbar.php' ?>
    <!-- /navbar -->
            <!-- Right Content of the page -->

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <!-- USERS OVERVIEW -->

                        <h3>Users Overview</h3>

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4 shadow">
                                    <div class="card-body">Number of Registered Users - <?php echo $users_total_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="registeredUsers.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-dark bg-light mb-4 shadow">
                                    <div class="card-body">Number of Appointments -  <?php echo $appoint_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-dark stretched-link" href="appointments.php">View Details</a>
                                        <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                        <!-- HOSPITALS OVERVIEW -->

                        <h3>Hospital Overview</h3>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4 shadow">
                                    <div class="card-body">Number of Registered Hospitals - <?php echo $hos_total_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="registeredHospitals.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white bg-success mb-4 shadow">
                                    <div class="card-body">Number of Activated Hospitals - <?php echo $hos_active_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="activatedHospitals.php">View Details</a>
                                        <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4 shadow">
                                    <div class="card-body">Number of Deactivated Hospitals - <?php echo $hos_deactive_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="deactivatedHospitals.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light text-dark mb-4 shadow">
                                    <div class="card-body">hospitals requested for activation - <?php echo $hos_req_active_count; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-dark stretched-link" href="requestActivation.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                     
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Today's Reservations -> <?php echo $todayDate; ?>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Hospital Name</th>
                                            <th>Hospital District</th>
                                            <th>Petowner Name</th>
                                            <th>Treatment Type</th>
                                            <th>Animal Category</th>
                                            <th>Appointment Date</th>

                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                              
                              $query2="SELECT * FROM `appointment` WHERE reservedDate = '$todayDate'";

                              if($query_run = mysqli_query($con,$query2)){ 
                                  while ($row = mysqli_fetch_assoc($query_run)){
                                      ?>

                              <tr>
                                  <td><?php echo $row['Hospital_name']; ?></td>
                                  <td><?php echo $row['Hospital_district'] ?></td>
                                  <td><?php echo $row['Petowner_name'] ?></td>
                                  <td><?php echo $row['Treatment_type']?></td>
                                  <td><?php echo $row['Animal_category']?></td>
                                  <td><?php echo $row['appointmentDate']?></td>
                              </tr>
                      <?php
                          }
                          }else{
                              echo "Error in the query";
                          }
                      ?>

                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
