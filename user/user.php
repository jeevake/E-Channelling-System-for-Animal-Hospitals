<?php
    require '../database_connector.php';
    require '../functions.php';
    require '../core.php';

  //OPERATION OF THE LOGOUT BUTTON
  if(array_key_exists('logout', $_POST)) {
  header("Location: ../logout.php");
  }

  //OPERATION OF THE USER BUTTON
  if(array_key_exists('user', $_POST)) {
  header("Location: user.php");
  }

  if(loggedin()){

    $username = getfield('login','Username','user_id',$con);

    $user_id = getfield('petowner','user_id','user_id',$con);

    $query="SELECT * FROM `petowner` WHERE `user_id`= $user_id";

    if($query_run = mysqli_query($con,$query)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
              $fname = $row['F_name'];
              $lname = $row['L_name'];
              $email = $row['Email'];
              $phone = $row['Phone_number'];
              $address = $row['Address'];
              $gender = $row['Gender'];
              $image = $row['profilepic'];
              $district = $row['District'];
          }


    }else{
        echo 'Error in the query';
    }



}else{
    header("Location: web/index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="userdashboard.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  
  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
          <!-- Navigation bar -->
          <nav class="navbar navbar-expand-lg shadow">
            <div class="container mt-2 mb-2">
              <a class="navbar-brand" href="../web/index.php"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
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
                    <a class="nav-link" href="#">Support</a>
                  </li> 
                  <form method='post'>
                       <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='' class='button' value='User Profile' />
                    </form>
                    <form method='post'>
                    <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='logout' class='button' value='Logout' />
                   </form>
                </ul>
              </div>
            </div>
          </nav>


          <!--User Proile-->

          <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
        <div class="col-xl-10 col-md-12">
                                                        <div class="card user-card-full">
                                                            <div class="row m-l-0 m-r-0">
                                                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                                                    <div class="card-block text-center text-white">
                                                                        <div class="m-b-25">
                                                                            <img src="../<?php echo $image; ?>" class="img-radius" alt="User-Profile-Image">
                                                                        </div>
                                                                        <h6 class="f-w-600 user-name-size"><?php echo $username; ?></h6>
                                                                        <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="card-block">
                                                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">First Name</p>
                                                                                <h6 class="text-muted f-w-400"><?php echo $fname; ?></h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Last Name</p>
                                                                                <h6 class="text-muted f-w-400"><?php echo $lname; ?></h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Email</p>
                                                                                <h6 class="text-muted f-w-400"><?php echo $email; ?></h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Phone</p>
                                                                                <h6 class="text-muted f-w-400">0<?php echo $phone; ?></h6>
                                                                            </div>
                                                                        </div>
                                                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Other</h6>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Gender</p>
                                                                                <h6 class="text-muted f-w-400"><?php echo $gender; ?></h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Address</p>
                                                                                <h6 class="text-muted f-w-400"><?php echo $address; ?></h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                              <p class="m-b-10 f-w-600">Living District</p>
                                                                              <h6 class="text-muted f-w-400"><?php echo $district; ?></h6>
                                                                          </div>
                                                                        </div> <br/>
                                                                        <div class="col-sm-12">
                                                                        
                                                                          <div class="row" style="width:100%">
                                                                            <div class="col-sm-4">  <a class='btn btn-outline-primary' href="userUpdate.php"><b>Update details</b></a></div>
                                                                            <div class="col-sm-4"> <a class='btn btn-outline-primary' href="userChangePassword.php"><b>Update Password</b></a></div>
                                                                            <div class="col-sm-4"> <a class='btn btn-outline-primary' href="userappointments.php"><b>View appointment</b></a></div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
