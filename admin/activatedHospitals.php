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
                        <h1 class="mt-4">Activated Hospitals</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="adminPanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">activated Hospitals</li>
                        </ol>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                activated Hospitals
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>District</th>
                                            <!-- <th>Registered Date</th> -->
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php

                              $query2="SELECT * FROM `hospital` WHERE status= 'activated'";

                              if($query_run = mysqli_query($con,$query2)){ 
                                  while ($row = mysqli_fetch_assoc($query_run)){
                                    $h_id = $row['Hospital_id']
                                      ?>

                              <tr>
                                  <td><?php echo $row['H_name']; ?></td>
                                  <td><?php echo $row['H_address'] ?></td>
                                  <td><?php echo $row['H_email'] ?></td>
                                  <td><?php echo $row['H_phoneNumber']?></td>
                                  <td><?php echo $row['H_district']?></td>
                                  <!-- <td></td> -->
                                  <td><?php echo $row['status']?></td>

                                  <td>
                                    <a class="btn btn-success" href="activatedHospitals_db.php?hos_id=<?php echo $h_id; ?>"> Deactivate </a>
                                  
                              </td>
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
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                           
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
