<?php 
    require '../core.php';
    require '../database_connector.php';
    require '../functions.php';
    
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


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Appointments</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="adminPanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Appointments</li>
                        </ol>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                APPOINTMENTS
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
                                            <th>Reserved Date</th>
                                            <th>Appointment Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                        $todayDate = date('Y-m-d');
                                        $query2="SELECT * FROM `appointment` WHERE appointmentDate >= '$todayDate'";

                                        if($query_run = mysqli_query($con,$query2)){ 
                                            while ($row = mysqli_fetch_assoc($query_run)){
                                                ?>

                                        <tr>
                                            <td><?php echo $row['Hospital_name']; ?></td>
                                            <td><?php echo $row['Hospital_district'] ?></td>
                                            <td><?php echo $row['Petowner_name'] ?></td>
                                            <td><?php echo $row['Treatment_type']?></td>
                                            <td><?php echo $row['Animal_category']?></td>
                                            <td><?php echo $row['reservedDate']?></td>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
