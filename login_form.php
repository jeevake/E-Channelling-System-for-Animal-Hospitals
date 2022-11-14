<?php 
require 'core.php';
require 'database_connector.php';

if(isset($_POST['username'])&&isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = md5($password);
    
    if(!empty($username)&&!empty($password)){

        //QUERY TO CHECK THE USER LOGIN DETAILS
        $query_u="SELECT `user_id` FROM `login` WHERE `Username`= '$username' AND `Password`= '$password_hash'";

        //QUERY TO CHECK THE HOSPITAL LOGIN DETAILS
        $query_h="SELECT `Hospital_id` FROM `login_hospital` WHERE `Username`= '$username' AND `Password`= '$password_hash'";

        //QUERY TO CHECK THE ADMIN LOGIN DETAILS
         $query_a="SELECT `admin_id` FROM `login_admin` WHERE `Username`= '$username' AND `Password`= '$password_hash'";

        //CHECKING THE USER LOGIN DETAILS
        if($query_run_u = mysqli_query($con,$query_u)){
         $query_num_rows_u = mysqli_num_rows($query_run_u);

            if($query_num_rows_u==0){

                //CHECKING THE HOSPITAL LOGIN DETAILS

                if($query_run_h = mysqli_query($con,$query_h)){
                  $query_num_rows_h = mysqli_num_rows($query_run_h);
                  
           
                       if($query_num_rows_h==0){
                        
                            //CHECKING THE ADMIN LOGIN DETAILS

                                if($query_run_a = mysqli_query($con,$query_a)){
                                $query_num_rows_a = mysqli_num_rows($query_run_a);
                                
                        
                                    if($query_num_rows_a==0){
                                        echo "<script type='text/javascript'>alert('Invalid combination');</script>";
                                    }
                        
                                    else if($query_num_rows_a==1){
                        
                                        /*  FETCHING THE DATA FROM THE DATABASE */ 
                                        while ($admin_id = mysqli_fetch_assoc($query_run_a)){
                                            $id = $admin_id['admin_id'];
                                            $_SESSION['id'] = $id;
                                            header("Location: admin/adminPanel.php");
                                        }
                                                                          
                                    }
                                
                                }else{
                                    echo 'Error in the query';
                                }
                  
                            /* END OF CHECKING ADMIN DETAILS */
                        
                          //  echo 'Invalid combination.';
                       }
           
                       else if($query_num_rows_h==1){
           
                           /*  FETCHING THE DATA FROM THE DATABASE */ 
                         while ($Hospital_id = mysqli_fetch_assoc($query_run_h)){
                             $id = $Hospital_id['Hospital_id'];
                             $_SESSION['id'] = $id;
                             header("Location: hospital/hospital.php");
                         }
                       }
                   
                }else{
                  echo 'Error in the query';
                }
                
                   /* END OF CHECKING HOSPITAL DETAILS */
            }
            
            else if($query_num_rows_u==1){

                /*  FETCHING THE DATA FROM THE DATABASE */ 
              while ($userid = mysqli_fetch_assoc($query_run_u)){
                  $id = $userid['user_id'];
                  $_SESSION['id'] = $id;
                  header("Location: web/index.php");
              }
            }            

        }else{
            echo 'Error in the query';
        }

    }else{
      echo "<script type='text/javascript'>alert('Fill all the fields');</script>";
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
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
          <!-- Navigation bar -->
          <nav class="navbar navbar-expand-lg shadow">
            <div class="container mt-2 mb-2">
              <a class="navbar-brand" href="web/index.php"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse ms-3" id="navMenu">
                <div class="input-group ms-3 ">
                    <!-- <input type="search" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
                    <a class="btn btn-search" href="#">Search</a> -->
                  </div>
                <ul class="navbar-nav ms-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ContactUs.php">Support</a>
                  </li> 
                  <li class="nav-item">
                    <a href="login_form.php" class="btn btn-primary btn-main-outline btn-main-w ms-3">Login</a>
                  </li>
                  <li class="nav-item">
                    <a href="registration_form.php" class="btn btn-primary btn-main btn-main-w ms-3">Register</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

           <!-- Login form -->
           <div class="container" style="height:4rem">
        </div>
        
        <section class="p-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md">
                    <img class="img-fluid d-none d-sm-block" src="./img/login.webp" alt="log-bg">
                    </div>

                    <div class="col-md">

                    <div class="container text-center mt-3">
                    <h1 class="text-secondary">LOGIN NOW</h1>
                </div>

            <div class="container mt-3 shadow" style="width:500px">
            <form action="<?php echo $current_file ?>" method="POST" autocomplete="off">
            <div class="mb-3">
                <label class="mt-3" for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
                <div id="emailHelp" class="form-text">Enter your registered username.</div>
             </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" onclick="showhide()">
                <label class="form-check-label" for="show-pw" >Show Password</label>
            </div>
            <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Login">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-1" style="border-radius:30px" value="Reset">
            <a href="forgot-password.php" class="ms-3">Forgot Password</a>
            <a href="registration_form.php" class="ms-3">Register</a>
            </form>
            </div>

                    </div>
                </div>
            </div>
        </section>
        
                
            
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
        
        

<script>
  function showhide() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>