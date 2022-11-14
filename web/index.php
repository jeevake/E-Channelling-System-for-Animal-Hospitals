<?php
   require '../core.php';
   require '../database_connector.php';
   require '../functions.php';

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="index.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
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

              <!-- Search bar -->

                <div class="input-group ms-3 ">
                  

                    <?php
                        $query="SELECT DISTINCT `H_district` FROM `hospital` WHERE status='activated'";
                        if($query_run = mysqli_query($con,$query)){  ?>

                        <form action="districtConnection.php" method="POST" style="width:100%">
                        <div class="row">
                   
                          <div class="col-md">

                            <!-- FETCHING THE DATA FROM THE DATABASE -->
                            <SELECT class="form-select" name="hospital_district" style="width:100%;" >
                            <?php  while ($row = mysqli_fetch_assoc($query_run)){ 
                                      $s_district = $row['H_district'];
                            
                                      echo  "<option value='$s_district'> $s_district </option>";
                                    }  
                             ?>

                            </SELECT>
                          </div>

                          <div class="col-md">
                            <input class="btn btn-search" type="submit" name="submit1" value="Search" >
                          </div> 
                        </div>

                        </form>
                        <?php

                        }else{
                        echo 'Error in the query';
                        }
                    ?>  
                  </div>


                <ul class="navbar-nav ms-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#about">About</a>
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
                         <input class='btn btn-primary btn-main-outline btn-main-w ms-3' type='submit' name='login' class='button' value='Login' />
                     </form>
                     <form method='post'>
                          <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='register' class='button' value='Register' />
                    </form>";
                  }
                  ?>
                  
                 
                </ul>
                                         
                
              </div>
            </div>
          </nav>

          <!-- Online booking section -->

          <section class="text-dark p-5 text-center text-sm-start">
            <div class="container">
              <div class="d-sm-flex align-items-center justify-content-between">
                
                <div class="me-3">
                  <h1>24/7 Online Booking</h1>
                  <p class="lead my-4">
                  With 24/7 real-time online booking from VetHome, you can save your beloved pet's life by making your bookings in advance.
                  Even in case of emergency, there is no need to fear for your pet's life as a separate staff has been set up.
                  </p>
                  <a class="btn btn-primary btn-main" href="selectAllHospital.php">Book an Appointment</a>
                </div>
                <img class="img-fluid w-50 d-none d-sm-block" style="height: 325px;" src="./img/section-img.svg" alt="section-bg">
          </div> 
          </div>            
          </section>
          
          <!-- About us -->

          <section class="text-dark p-5 text-center text-sm-start" id="about">
            <div class="container">
              <div class="d-sm-flex align-items-center justify-content-between"> 
                <img class="img-fluid w-50 d-none d-sm-block" style="height: 325px;" src="./img/about-us.svg" alt="section-bg">
                <div class="ms-5">
                  <p class="lead my-4" style="font-size:16px;">
                  Hospitals in VetHome website are hospitals with top medical facilities in Sri Lanka with highly qualified vets and nurses with international experience and support staff will take good care of your pet in state-of-the-art facilities.
                  </p>
                </div>
              </div>
            </div>
          </section>

          <!-- Our Services -->

          <section class="p-5">
            <div class="container">
              <div class="row text-center">
                <div class="col-md">
                  <div class="card text-dark bg-light mb-3 shadow-crd" >
                    <img src="./img/a1.jpg" class="card-img-top" alt="service">
                    <div class="card-body">
                      <h5 class="card-title">Find a hospital</h5>
                      <p class="card-text"> To get the services your pet needs, visit here to know the details of the nearest animal hospital where you live.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card text-dark bg-light mb-3 shadow-crd" >
                    <img src="./img/a2.jpg" class="card-img-top" alt="service">
                    <div class="card-body">
                      <h5 class="card-title">Channeling Dates</h5>
                      <p class="card-text">Visit here to know the dates and times of channeling services for your pet at your convenience.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card text-dark bg-light mb-3 shadow-crd" >
                    <img src="./img/a3.jpg" class="card-img-top" alt="service">
                    <div class="card-body">
                      <h5 class="card-title">Facilities Of hospitals</h5>
                      <p class="card-text" style=""> Visit here to know all veterinary services like early detection, monitoring and treatment of animal diseases.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card text-dark bg-light mb-3 shadow-crd" >
                    <img src="./img/a4.jpg" class="card-img-top" alt="service">
                    <div class="card-body">
                      <h5 class="card-title">Online Payments</h5>
                      <p class="card-text">All payments for your channeling work, medicines to treat animals can be done through our website.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Our Values -->

          <section class="text-dark p-5 text-center text-sm-start">
            <div class="container">
              <div class="d-sm-flex align-items-center justify-content-between"> 
                <img class="img-fluid w-50 d-none d-sm-block" style="height: 325px;" src="./img/our-values.svg" alt="section-bg">
                <div class="ms-5">
                  <h3>Our Core values</h3>
                  <p class="lead my-4" style="font-size:16px;">
                    Vestibulum sit amet tortor libero lobortis semper at et odio. 
                    In eu tellus tellus. Pellentesque ullamcorper ultrices. Aenean facilisis vitae purus facilisis semper.
                  </p>
                  <div class="row">
                    <div class="col-sm">
                      <div class="row-sm">
                        <img src="./img/icon-check.png" alt="icon-aim">
                        <h4 class="mt-2">Integrity </h4>
                        <p>We work together as a team with strict adherence to customer trust. We establish trust and honesty to build relationships with our customers and make your family pet's environment beautiful.</p>
                      </div>
                      <div class="row-sm">
                        <img src="./img/icon-speedometer.png" alt="icon-speedometer">
                        <h4 class="mt-2"> Commitment</h4>
                        <p>We are committed to providing you with the highest approved standards of service as well as medical and surgical care. We are committed to further enhance the quality of our services and care and provide reliability to consumers.</p>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="row-sm">
                        <img src="./img/Icon-aim.png" alt="icon-aim">
                        <h4 class="mt-2">Compassion</h4>
                        <p>We strongly believe that compassion for your pet is at the heart of our practice, and we demonstrate this through our understanding, compassion and mercy in every aspect of our service to our clients and their pets.</p>
                      </div>
                      <div class="row-sm">
                        <img src="./img/icon-android-bulb.png" alt="icon-speedometer">
                        <h4 class="mt-2">standard of living</h4>
                        <p>We believe the human-pet bond is based on love.It is really an unconditional reationship. With our commitment, integrity and compassion to work to strengthen that bond throughout a pet's life, we ensure that their pets and their clients share a fulfilling, enjoyable and loving experience.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
                  <p style="margin-bottom:0.1vw;"><a style="color: #3b5998;text-decoration:none;" href="#!" role="button"><i class="fab fa-facebook-f  me-3"></i>Facebook</a></p>
                  <p style="margin-bottom:0.1vw;"> <a style="color: #ac2bac;text-decoration:none;" href="#!" role="button"><i class="fab fa-instagram  me-3"></i>Instagram</a></p>
                  <p style="margin-bottom:0.1vw;"><a style="color: #55acee;text-decoration:none;" href="#!" role="button"><i class="fab fa-twitter  me-3"></i>Twitter</a></p>
                  <p style="margin-bottom:0.1vw;"><a style="color: #3f1ac4;text-decoration:none;" href="#!" role="button"><i class="fab fa-linkedin-in me-3"></i>Twitter</a></p>
                </div>
              </div>
            </div>
          </section>

        

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
