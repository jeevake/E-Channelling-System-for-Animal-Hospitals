<?php

require '../database_connector.php';
require '../functions.php';
require '../core.php';

$user_id = getfield('petowner','user_id','user_id',$con);
$db_password_old = getfield('login','Password','user_id',$con);

 //OPERATION OF THE LOGOUT BUTTON
 if(array_key_exists('logout', $_POST)) {
  header("Location: ../logout.php");
  }

   //OPERATION OF THE USER BUTTON
  if(array_key_exists('user', $_POST)) {
  header("Location: user.php");
  }

    if(loggedin()){

        if( isset($_POST['old_password'])&&
            isset($_POST['new_password'])&&
            isset($_POST['new_passwordagain'])){

                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $new_passwordagain = $_POST['new_passwordagain'];

                /*--- ENCRYPTING THE OLD PASSWORD ---*/
                $password_hash_old = md5($old_password);
        

            if(!empty($old_password)&&!empty($new_password)&&!empty($new_passwordagain)){

                    if($db_password_old == $password_hash_old){

                     /*--- ENCRYPTING THE NEW PASSWORD ---*/
                     $password_hash_new = md5($new_password);

                            /*--- CHECKING THE MAXIMUM LENGTH ---*/
                            if(strlen($new_password)>20){
                                echo "<script type='text/javascript'>alert('Please look to maxlength of fields');location='user.php';</script>";

                            }else{ 

                                if ($new_password!=$new_passwordagain){
                                 
                                  echo "<script type='text/javascript'>alert('Passwords do not match');location='user.php';</script>";

                                }else{
                                                 //UPDATING USER PASSWORD TABLE
                                                 $query1 = "UPDATE login SET Password='".mysqli_real_escape_string($con,$password_hash_new)."' WHERE user_id=$user_id";


                                                if($query_run1 = mysqli_query($con,$query1)){

                                                  $message = "Password Successfully changed";
                                                  echo "<script type='text/javascript'>alert('$message');location='user.php';</script>";
                                            

                                                }else{
                                                  echo "<script type='text/javascript'>alert('Try again');location='user.php';</script>";


                                                }
                                }
                            }   
                    
                
                    }else{
                         echo "old password does not match";
                    }

                }else{
                    echo "All fields are required";
                }
            }
/*--- IF THE USER LOG IN ---*/
}else if(!loggedin()){
  echo 'Already registed user'; 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="changePassword.css">
  
  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

  <script>
    $("#btnLogin").click(function(event) {
    
    var form = $("#loginForm");
    
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    
    // if validation passed form
    // would post to the server here
    
    form.addClass('was-validated');
});
  </script>

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
                       <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='user' class='button' value='User Profile' />
                    </form>
                    <form method='post'>
                    <input class='btn btn-primary btn-main btn-main-w ms-3' type='submit' name='logout' class='button' value='Logout' />
                   </form>
                </ul>
              </div>
            </div>
          </nav>


                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                      <div class="card-header">
                          <h3 class="mb-0">Change Password</h3>
                      </div>
                      <div class="card-body">
                          <form class="form" role="form" action="userChangePassword.php" method="POST" autocomplete="off">
                              <div class="form-group">
                                  <label for="inputPasswordOld">Current Password</label>
                                  <input type="password" class="form-control" name="old_password" id="inputPasswordOld" required="">
                              </div>
                              <div class="form-group">
                                  <label for="inputPasswordNew">New Password</label>
                                  <input type="password" class="form-control" name="new_password" id="inputPasswordNew" required="">
                                  <span class="form-text small text-muted">
                                          The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                      </span>
                              </div>
                              <div class="form-group">
                                  <label for="inputPasswordNewVerify">Verify</label>
                                  <input type="password" class="form-control" name="new_passwordagain" id="inputPasswordNewVerify" required="">
                                  <span class="form-text small text-muted">
                                          To confirm, type the new password again.
                                      </span>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-main btn-main-w float-right" >Update Password</button>
                              </div>
                          </form>
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
