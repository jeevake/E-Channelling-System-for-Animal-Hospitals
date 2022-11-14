<?php
    require '../database_connector.php';
    require '../functions.php';
    require '../core.php';

//ASSIGNING THE SEARCHED HOSPOTAL TO THE VARIABLE
$hos_id=$_GET['Hospital_id'];

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

   //OPERATION OF THE SEARCH BUTTON
   if(array_key_exists('searchSlots', $_POST)) {
    header("Location: slotAvailability.php?Hospital_id=$hos_id");
  }



  
  $query="SELECT * FROM `hospital` WHERE `Hospital_id`= $hos_id";

    if($query_run = mysqli_query($con,$query)){

          /*  FETCHING THE HOSPITAL DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
              $name = $row['H_name'];
              $address = $row['H_address'];
              $city = $row['H_city'];
              $district = $row['H_district'];
              $email = $row['H_email'];
              $phone = $row['H_phoneNumber'];
              $image = $row['image_main'];
              $about = $row['About_us'];
              $facilities = $row['Facilities'];
              $slots = $row['Num_slotsPerDay'];
          }


    }else{
      echo "<script type='text/javascript'>alert('Database Error');</script>";
    }

    
    if(loggedin()){

      //OPERATION OF THE REVIEW BUTTON IF THE USER IS LOGGED IN
      if(array_key_exists('review', $_POST)) {
        header("Location: review.php?Hospital_id=$hos_id");
      }
      
      //OPERATION OF THE RESERVATION BUTTON IF THE USER IS LOGGED IN
      
      if(array_key_exists('reserve', $_POST)) {
            header("Location: reservation.php?Hospital_id=$hos_id&&Doctor_id=0");
      }

    }else{
      if(array_key_exists('review', $_POST)) {
        $message = "Please Login to give a review";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }

      //OPERATION OF THE REVIEW BUTTON IF THE USER IS NOT LOGGED IN

      if(array_key_exists('reserve', $_POST)) {
          $message = "Please Login to book an appointment";
          echo "<script type='text/javascript'>alert('$message');</script>";
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
  

  <style>
      table, th, td {
        border: 1px solid black;
      }

      .star{
        color:#d4af37;
      }
</style>

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
                <div class="input-group ms-3 ">
                    
                  </div>
                <ul class="navbar-nav ms-3">
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
              </div>
            </div>
          </nav>


          <!-- Hospital details -->

          <div class="container">
            <div class="card mb-3 mt-5 shadow-sm">

            <div class="card-header border-primary text-center">
                  <h2 class="mt-3"><b><?php echo $name ?></b></h2>
                  <h5 style="color:#3200FF"><?php echo $address ?></h5>
                  <h5 style="color:#003EFF">Email: <i><?php echo $email ?></i></h5>
                  <h5 style="color:#003EFF">Tel: <?php echo "0".$phone ?></h5></br>
            </div>

                <div class="card-body p-4 ">

                  <div class="row">
                    <div class="col-sm-6">       
                        <img src="../<?php echo $image; ?>" class="card-img-top shadow" alt="..." style="width:100%;" ></br></br>    
                    </div>

                    <div class="col-sm-6">

                      <div class="row mt-4"> 
                        <p class="card-text h3 text-center">Number of Slots per day:  <?php echo $slots ?></p>
                      </div>

                      <div class="row mt-4"> 
                        <?php if(!loggedin()){
                            echo ' <p style="color:#FF0000;"><b>Please <i><a href="../login_form.php">sign in</a></i> before making a reservation</b></p>'; 
                        }?>
                       

                        <div class="col-sm-6">
                          <form method="post">
                            <input type="submit" name="reserve" class="btn btn-primary" value="Reservation" style="width:100%;  font-size:15pt; font-weight:bold;"/>
                          </form>
                        </div>
                        <div class="col-sm-6">
                          <form method="post">
                            <input type="submit" name="searchSlots" class="btn btn-success" value="Slot Availability" style="font-size:15pt; font-weight:bold; width:100%;" />
                          </form>
                        </div> 
                        
                        <div class="col-sm-12">
                          <form method="post">
                            <input type="submit" name="review" class="btn btn-outline-warning" value="Give us a review" style="font-size:15pt; font-weight:bold; width:60%; margin:5% 15% 0" />
                          </form>
                        </div>
                      </div>

                    </div>
                 
                  <h3 class="card-title"><b>About Us </b></h3>
                  <p class="card-text" style="text-align:justify; padding:1% 3% 1%;"><?php echo $about ?></p>
                  <h3 class="card-title"><b>Facilities we offer </b></h3>
                  <p class="card-text" style="text-align:justify; padding:1% 3% 1%;"><?php echo $facilities?></p>


                  <!-- Doctor Details -->
                  <?php 
                      $query2="SELECT * FROM `doctor` WHERE `Hospital_id` = $hos_id";
                      if($query_run = mysqli_query($con,$query2)){ 
                       
                        //CHECKING WHETHER THERE ARE SPECIALIST DOCTORS IN THE HOSPITAL
                        $query_num_rows = mysqli_num_rows($query_run);
                        if($query_num_rows>0){
                          echo '<h3 class="card-title"><b>Specialist Doctors </b></h3>';
                  ?>
                  
                <div class="row" style="padding:1% 2% 1% 3%;">
                  <table class="table">
                          <tr class="table-success">
                              <th>Name</th>
                              <th>Email</th>
                              <th>Channelling day</th>
                              <th>Channelling time</th>
                              <th>Num_slotsPerDay</th>
                              <th>Specialist_area</th>
                              <th>Reserve</th>
                          </tr>

                          <?php
                            

                             
                                  while ($row = mysqli_fetch_assoc($query_run)){
                                    $doc_id=$row['Doctor_id'];
                                      ?>

                              <tr>
                                  <td><?php echo $row['F_name']." ".$row['L_name']; ?></td>
                                  <td><?php echo $row['Email'] ?></td>
                                  <td><?php echo $row['Channelling_day'] ?></td>
                                  <td><?php echo $row['Channelling_time']?></td>
                                  <td><?php echo $row['Num_slotsPerDay']?></td>
                                  <td><?php echo $row['Specialist_area']?></td>
                                  
                                  <td>
                                  <!-- RESERVE BUTTON FOR THE DOCTOR -->

                                      <?php
                                        if(loggedin()){

                                           echo '<a class="btn btn-success" href="reservation.php?Hospital_id='.$hos_id.'&Doctor_id='.$doc_id.'">Reserve</a>';
                                        }else{

                                          echo '<a class="btn btn-success" href="#">Reserve</a>';
                                        }
                                      ?>
                         

                                  </td>

                              </tr>
                      <?php
                                  }
                          }
                          }else{
                              echo "Error in the query";
                          }
                      ?>

                  </table>
                </div>                  
                        </br>

                      <!-- Reviews -->
                        
                        <?php 
                      $query2="SELECT * FROM `review` WHERE `Hospital_id` = $hos_id ORDER BY date DESC LIMIT 5;";
                      if($query_run = mysqli_query($con,$query2)){ 
                       
                        //CHECKING WHETHER THERE ARE SPECIALIST DOCTORS IN THE HOSPITAL
                        $query_num_rows = mysqli_num_rows($query_run);
                        if($query_num_rows>0){
                          echo '<h3 class="card-title"><b>Reviews </b></h3>';
                  ?>
                  
                <div class="row" style="padding:1% 2% 1% 3%;">
                  <table class="table">
                          <tr class="table-success">
                              <th>Review</th>
                              <th>Rating</th>
                              <th>Given by</th>
                              <th>Date</th>

                          <?php

                                  while ($row = mysqli_fetch_assoc($query_run)){
                                      ?>

                              <tr>
                                  <td><?php echo $row['comment']?></td>
                                  <td>
                                    <?php 
                                    
                                      echo $row['review'] ;
                                      if($row['review']=='Awesome'){
                                       echo '<i class="fas fa-star star"></i>
                                        <i class="fas fa-star star"></i>
                                        <i class="fas fa-star star"></i>
                                        <i class="fas fa-star star"></i>
                                        <i class="fas fa-star star"></i>';
                                      }else if($row['review']=='Excellent'){
                                        echo '<i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="far fa-star star"></i>';
                                       }else if($row['review']=='Average'){
                                        echo '<i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>';
                                       }else if($row['review']=='Good'){
                                        echo '<i class="fas fa-star star"></i>
                                         <i class="fas fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>';
                                       }else if($row['review']=='Poor'){
                                        echo '<i class="fas fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>
                                         <i class="far fa-star star"></i>';
                                       }

                                    ?>

                                  </td>
                                  <td><?php echo $row['petowner_name'] ?></td>
                                  <td><?php echo $row['date']?></td>
                                
                              </tr>
                      <?php
                                  }
                          }
                          }else{
                              echo "Error in the query";
                          }
                      ?>

                  </table>
                </div>    

                </div>

                
              </div>
          </div>
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
