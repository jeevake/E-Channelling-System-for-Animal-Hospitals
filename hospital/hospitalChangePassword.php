<?php

 //OPERATION OF THE LOGOUT BUTTON
 if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
    }

require '../database_connector.php';
require '../functions.php';
require '../core.php';

$hos_id = getfield('hospital','Hospital_id','Hospital_id',$con);
$db_password_old = getfield('login_hospital','Password','Hospital_id',$con);

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
                                echo "<script type='text/javascript'>alert('Please look to maxlength of fields');</script>";
                            }else{ 

                                if ($new_password!=$new_passwordagain){
                                    echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
                                }else{
                                                 //INSERTING VALUES TO THE HOSPITAL TABLE
                                                 $query1 = "UPDATE login_hospital SET Password='".mysqli_real_escape_string($con,$password_hash_new)."' WHERE Hospital_id=$hos_id";


                                                if($query_run1 = mysqli_query($con,$query1)){
                                                    echo "<script type='text/javascript'>alert('Successful');</script>";

                                                    /*--- SENDING A CONFORMATION EMAIL TO CONFIRM REGISTRATION ---*/


                                                    // $to       = $email;
                                                    // $subject  = 'Testing sendmail.exe';
                                                    // $message  = 'Hi, you just received an email using sendmail!';
                                                    // $headers  = 'From: lahiru.lmk98@gmail.com' . "\r\n" .
                                                    // 'MIME-Version: 1.0' . "\r\n" .
                                                    // 'Content-type: text/html; charset=utf-8';
                                                /*  if(mail($to, $subject, $message, $headers))
                                                    //echo "Email sent";
                                                    else
                                                    echo "Email sending failed";
                                                */
                                            

                                                }else{
                                                    echo "<script type='text/javascript'>alert('Please try again');</script>";

                                                }
                                }
                            }   
                    
                
                    }else{
                        echo "<script type='text/javascript'>alert('old password does not match');</script>";

                    }

                }else{
                    echo "<script type='text/javascript'>alert('All fields are required');</script>";

                }
            }
/*--- IF THE USER LOG IN ---*/
}else if(!loggedin()){
    header("Location: ../web/index.php");
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
        <a class="navbar-brand" href="#">
          <img src="./img/logo.png" alt="brand" width="50" height="43" />
          VetHome</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navMenu"
          aria-controls="navMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3" id="navMenu">
          <ul class="nav nav-pills nav-fill ms-auto">
          <li class="nav-item">
                  <a class="nav-link" href="hospital.php" >Hospital Control</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="viewappointments.php" >View Appointments</a>
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
                  <a class="nav-link active" href="#" style="background-color:#7900ff;">Change Password</a>
                </li>

            <li class="nav-item">
              <form method="post">
                <input
                  class="nav-link"
                  type="submit"
                  name="logout"
                  class="button"
                  value="Logout"
                />
              </form>
            </li>
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
                          <form class="form" role="form" action="hospitalChangePassword.php" method="POST" autocomplete="off">
                              <div class="form-group">
                                  <label for="inputPasswordOld">Current Password</label>
                                  <input type="password" class="form-control" name="old_password" id="inputPasswordOld" required=""></br>
                              </div>

                              <div class="form-group">
                                  <label for="inputPasswordNew">New Password</label>
                                  <input type="password" class="form-control" name="new_password" id="inputPasswordNew" required=""></br>
                                  <span class="form-text small text-muted">
                                          The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                      </span>
                              </div>

                              <div class="form-group">
                                  <label for="inputPasswordNewVerify">New Password Again</label>
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
</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>

