 <?php

require '../database_connector.php';
require '../functions.php';
require '../core.php';

  //OPERATION OF THE LOGIN BUTTON
  if(array_key_exists('login', $_POST)) {
    header("Location: ../login_form.php");
  }

  //OPERATION OF THE REGISTER BUTTON
  if(array_key_exists('register', $_POST)) {
    header("Location: ../registration_form.php");
  }

  //OPERATION OF THE LOGOUT BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
  }

  //OPERATION OF THE USER BUTTON
  if(array_key_exists('user', $_POST)) {
    header("Location: ../user/user.php");
  }



  //ARRAY OF FILTERED HOSPITAL IDS
  $filteredHospitals=array();

  //FILTER SECTION FOR THE HOSPITALS
  if (isset($_POST["submit"])) {

        if (isset($_POST["areas"]) && count($_POST["areas"]) > 0) {
            $specialAreas = $_POST["areas"];
            
            foreach ($specialAreas as $specialArea) {
                // echo $specialArea;

                $querySp = "SELECT DISTINCT hospital.Hospital_id FROM hospital LEFT JOIN specialfacilities ON hospital.Hospital_id = specialfacilities.Hospital_id WHERE specialfacilities.specialArea = '$specialArea'";
                if($query_run_sp = mysqli_query($con,$querySp)){ 
                  while ($row = mysqli_fetch_assoc($query_run_sp)){
                    $hospital_ID = $row['Hospital_id'];
                    // echo $hospital_ID;
                    
                    array_push($filteredHospitals,$hospital_ID);
                  }

                }else{
                  echo "Error in qr";
                }
            }

        }else{
            // echo "not 0";
        }
    
    }
?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="index.css">

  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>

      <!-- Navigation bar -->
          <nav class="navbar navbar-expand-lg shadow">
            <div class="container mt-2 mb-2">
              <a class="navbar-brand" href="index.php"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse ms-3" id="navMenu">
                <div class="input-group ms-3 " style="width:45%";>
                    <!-- <input type="search" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
                    <a class="btn btn-search" href="hospitals.html">Search</a> -->
                  </div>
                <ul class="navbar-nav ms-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                   Advance Search
                  </button>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../ContactUs.php">Support</a>
                  </li>

                   <!-- The changing of buttons in navigator bar when user is logged in -->

                  <?php
                  if(loggedin()){

                   echo "<form method='post'>
                       <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='user' class='button' value='User Profile' />
                    </form>
                    <form method='post'>
                    <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='logout' class='button' value='Logout' />
                   </form>";

                  }else{
                     echo " <form method='post'>
                         <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='login' class='button' value='Login' />
                     </form>
                     <form method='post'>
                          <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='register' class='button' value='Register' />
                    </form>";
                  }
                  ?>
                </ul>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Advance Search</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                      <div class="input-group ms-3 ">

                      <form action="selectAllHospital.php" method="POST" style="width:100%">

                          

                      <div class="row">

                    <div class="col-md">
                      <div class="mb-3">
 
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Anesthesia" name="areas[]">
                                  <label class="form-check-label">
                                      Anesthesia
                                  </label>
                              </div>

                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Behavior" name="areas[]">
                                  <label class="form-check-label">
                                      Behavior
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Dentistry" name="areas[]">
                                  <label class="form-check-label">
                                      Dentistry
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Cardiology" name="areas[]">
                                  <label class="form-check-label">
                                      Cardiology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Oncology" name="areas[]">
                                  <label class="form-check-label">
                                      Oncology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Lab Animal" name="areas[]">
                                  <label class="form-check-label">
                                      Lab Animal
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Radiology" name="areas[]">
                                  <label class="form-check-label">
                                      Radiology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Pharmacology" name="areas[]">
                                  <label class="form-check-label">
                                      Pharmacology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Sports Medicine" name="areas[]">
                                  <label class="form-check-label">
                                      Sports Medicine
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Surgery Orthopedics" name="areas[]">
                                  <label class="form-check-label">
                                      Surgery Orthopedics
                                  </label>
                              </div>
                             
                          </div>
                        </div>


                        <div class="col-md">
                          <div class="mb-3">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Behavior" name="areas[]">
                                  <label class="form-check-label">
                                     Behavior
                                  </label>
                              </div>

                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Immunology" name="areas[]">
                                  <label class="form-check-label">
                                      Immunology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Dermatology" name="areas[]">
                                  <label class="form-check-label">
                                      Dermatology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Endocrinology" name="areas[]">
                                  <label class="form-check-label">
                                      Endocrinology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Neurology" name="areas[]">
                                  <label class="form-check-label">
                                      Neurology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Parasitology" name="areas[]">
                                  <label class="form-check-label">
                                      Parasitology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Microbiology" name="areas[]">
                                  <label class="form-check-label">
                                      Microbiology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Nutrition" name="areas[]">
                                  <label class="form-check-label">
                                      Nutrition
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Pathology" name="areas[]">
                                  <label class="form-check-label">
                                      Pathology
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Preventive" name="areas[]">
                                  <label class="form-check-label">
                                      Preventive
                                  </label>
                              </div>

                            </div>
                          </div>
                          </div>

                                <div>
                                    <input class="btn btn-search" type="submit" name="submit" value="Search" >
                                    </div>
                                </form>

                          </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </nav>

    
    <!-- Hospital details cards -->
    <section class="p-5 mt-4">
        <div class="container">
        
        <?php
  
        if(empty($filteredHospitals)){
          $query="SELECT * FROM `hospital` WHERE status='activated'";

          if($query_run = mysqli_query($con,$query)){ 
              while ($row = mysqli_fetch_assoc($query_run)){
                $image = $row['image_main'];
                $hospital_ID = $row['Hospital_id'];
              
                  ?>

              <!-- 1 cards row -->

                  <div class="col">
                      <div class="card mb-3 shadow" style="max-width: 100%;">
                          <div class="row g-0">
                            <div class="col-md-4">
                            
                              <img src="../<?php echo $image; ?>" class="img-fluid rounded-start" alt="hospital image">
                            </div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $row['H_name']; ?></h5>
                                <p class="card-text"><i class='fas fa-map-marker-alt'></i> <?php echo $row['H_address']; ?>
                                <p class="card-text"><i class='fas fa-envelope-square'></i> <?php echo $row['H_email']; ?></p>
                                <p class="card-text"><i class='fas fa-phone-square-alt'></i></i> 0<?php echo $row['H_phoneNumber']; ?></p>
                                <p><a href="singleHospital.php?Hospital_id='<?php echo $row['Hospital_id']; ?>'" class="btn btn-primary">View Details</a></p>

                              </div>
                            </div>

                            <div class="col-md-2">
                            <div class="p-3">

                          <?php  
                              $query2="SELECT * FROM `specialfacilities` WHERE `Hospital_id` = $hospital_ID";
                              $query_run2 = mysqli_query($con,$query2);
                              while ($row2 = mysqli_fetch_assoc($query_run2)){
                                $spArea = $row2['specialArea'];
                                echo "<i class='fas fa-check' style='color:#00E4FF'></i> $spArea</br>";
                              }
                          ?>

                              </div>
                            </div>

                          </div>
                        </div>
                        </div>
                            
                  <?php
              }
          }else{
            echo "<script type='text/javascript'>alert('Database Error ');</script>";
          }
        }else{

          $unique_array = array_unique($filteredHospitals);
          foreach ($unique_array as $hos_id) {

            $query="SELECT * FROM `hospital` WHERE status='activated' AND Hospital_id=$hos_id";

            if($query_run = mysqli_query($con,$query)){ 
                while ($row = mysqli_fetch_assoc($query_run)){
                  $image = $row['image_main'];
                  $hospital_ID = $row['Hospital_id'];
                
                    ?>

              <!-- 1 cards row -->

                  <div class="col">
                      <div class="card mb-3 shadow" style="max-width: 100%;">
                          <div class="row g-0">
                            <div class="col-md-4">
                            
                              <img src="../hospital/<?php echo $image; ?>" class="img-fluid rounded-start" alt="hospital image">
                            </div>
                            <div class="col-md-5">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $row['H_name']; ?></h5>
                                <p class="card-text"><i class='fas fa-map-marker-alt'></i> <?php echo $row['H_address']; ?>
                                <p class="card-text"><i class='fas fa-envelope-square'></i> <?php echo $row['H_email']; ?></p>
                                <p class="card-text"><i class='fas fa-phone-square-alt'></i></i> 0<?php echo $row['H_phoneNumber']; ?></p>
                                <p><a href="singleHospital.php?Hospital_id='<?php echo $row['Hospital_id']; ?>'" class="btn btn-primary">View Details</a></p>

                              </div>
                            </div>

                            <div class="col-md-3">
                            <div class="p-3">

                          <?php  
                              $query2="SELECT * FROM `specialfacilities` WHERE `Hospital_id` = $hospital_ID";
                              $query_run2 = mysqli_query($con,$query2);
                              while ($row2 = mysqli_fetch_assoc($query_run2)){
                                $spArea = $row2['specialArea'];
                                echo "<i class='fas fa-check' style='color:#00E4FF'></i> $spArea</br>";
                              }
                          ?>

                              </div>
                            </div>

                          </div>
                        </div>
                        </div>
                            
                  <?php
              }
            }else{
              echo "<script type='text/javascript'>alert('Database Error ');</script>";
            }

          }
      }
    ?>

   
        </div>
    </section>

    
          <!-- Footer -->
          <section class="p-5 ">
            <div class="container border-top">
              <div class="row text-left mt-5 mb-5 justify-content-between">
                <div class="col-md">
                  <h5>VetHome</h5>
                  <p class="text-sm-start">
                    we are providing high quality service from top rated vet hospitals.
                  </p>
                </div>
                <div class="col-md ms-3">
                  <h5>COMPANY</h5>
                  <p>Petcare
                    <br>NexGuard
                    <br>Omega
                    <br>VetClinic
                  </p>
                  
                </div>
                <div class="col-md ms-3">
                  <h5>SERVICE</h5>
                  <p>Petcare
                    <br>Vaccination
                    <br>Health
                    <br>Training
                  </p>
                </div>
                <div class="col-md">
                  <h5>RESOURCES</h5>
                  <p>Petcare
                    <br>Vaccination
                    <br>Health
                    <br>Training
                  </p>
                </div>
                <div class="col-md">
                  <h5>SOCIAL</h5>
                  <p><a style="color: #3b5998;" href="#!" role="button"><i class="fab fa-facebook-f fa-lg"></i>Facebook</a>
                    <br><a style="color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram fa-lg"></i>Instagram</a>
                    <br><a style="color: #55acee;" href="#!" role="button"><i class="fab fa-twitter fa-lg"></i>Twitter</a>
                    <br><a style="color: #3f1ac4;" href="#!" role="button"><i class="fab fa-linkedin-in"></i>Twitter</a>
                  </p>
                </div>
              </div>
            </div>
          </section>

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>