<?php
require '../database_connector.php';
require '../functions.php';
require '../core.php';

  //OPERATION OF THE LOGOUT BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
    }

    if(!loggedin()){
      header("Location: ../web/index.php");
    }

     

  //VIEW OF THE HOSPITAL 

    if(loggedin()){

       //ASSIGNING THE HOSPITAL ID TO THE VARIABLE
    $id = getfield('hospital','Hospital_id','Hospital_id',$con);

    $status = getfield('hospital','status','Hospital_id',$con);
     
     //OPERATION OF THE BUTTONS TO DEACTIVATE
     if(array_key_exists('active', $_POST)) {

      $query_update = "UPDATE hospital SET status='deactivated' WHERE Hospital_id=$id";
      $query_run = mysqli_query($con,$query_update);
      echo "<script type='text/javascript'>alert('Deactivation Successful');location='hospital.php';</script>";

  }

  //OPERATION OF THE BUTTONS TO REQUEST ACTIVATATION
  if(array_key_exists('request', $_POST)) {
      $query_update = "UPDATE hospital SET requestActivation='yes' WHERE Hospital_id=$id";
      $query_run = mysqli_query($con,$query_update);
      echo "<script type='text/javascript'>alert('Request Send Successfully');</script>";
  }

    $query="SELECT * FROM `hospital` WHERE `Hospital_id`= $id";

    if($query_run = mysqli_query($con,$query)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
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
        echo 'Error in the query';
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
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
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
          <a class="navbar-brand" href="#"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse ms-3" id="navMenu">
            <ul class="nav nav-pills nav-fill ms-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#" style="background-color:#7900ff;">Hospital Control</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="viewappointments.php">View Appointments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hospital-update.php">Update Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="addDoctors.php">Add Doctors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="specialFacilities.php">Special Facilities</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hospitalChangePassword.php">Change Password</a>
                </li>
               

                <li class="nav-item">
                <form method='post'>
                <input class='nav-link' type='submit' name='logout' class='button' value='Logout' />
               </form>  
                </li>
                
            </ul>
          </div>
        </div>
      </nav>   </br>

      <div class="container">
        <div class= "row mt-2">
          <div class="col-sm-6 text-center">
            <h3 class="text-decoration-underline mt-5 " style="font-weight:bold; color:#27010A;">Hospital view to the user</h3>
          </div>

          <div class="col-sm-6 text-center">
            <h4>Activation Status: <?php echo $status; ?></h4>

            <form method="post">
              <input type="submit" name="active"  class="btn btn-danger mb-3 mt-3 ms-3" value="Deactivate" />
              <input type="submit" name="request" class="btn btn-warning mb-3 mt-3 ms-3" value="Request for activation" />
            </form>
          </div>
          
        </div> 

      </div>
     

   
    <!--  VIEW OF THE HOSPITAL -->

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
                       <p style="color:#FF0000;"><b>Please <i><a href="#">sign in</a></i> before making a reservation</b></p>
                       

                        <div class="col-sm-6">
                          <form method="post">
                            <input type="submit" name="reserve" class="btn btn-primary" value="Reservation" style="width:100%; height:12rem; font-size:15pt; font-weight:bold;"/>
                          </form>
                        </div>
                        <div class="col-sm-6">
                          <form method="post">
                            <input type="submit" name="searchSlots" class="btn btn-success" value="Slot Availability" style="font-size:15pt; font-weight:bold; width:100%; height:12rem;" />
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
                      $query2="SELECT * FROM `doctor` WHERE `Hospital_id` = $id";
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

                                           echo '<a class="btn btn-success" href="#">Reserve</a>';
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

                <?php  ?>


                  
                        </br>
                   <!-- Reviews -->
                        
                   <?php 
                      $query2="SELECT * FROM `review` WHERE `Hospital_id` = $id ORDER BY date DESC LIMIT 5;";
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

    <!--  END OF THE HOSPITAL -->

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>