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

//ASSIGNING THE USER DETAILS TO THE VARIABLES

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

    if(isset($_POST['firstname'])&&
    isset($_POST['lastname'])&&
    isset($_POST['gender'])&&
    isset($_POST['email'])&&
    isset($_POST['phone'])&&
    isset($_POST['district'])&&
    isset($_POST['address'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $district = $_POST['district'];


     if(!empty($firstname)&&!empty($lastname)&&!empty($gender)&&!empty($email)&&!empty($phone)&&!empty($address)&&!empty($district)){

        /*--- CHECKING THE MAXIMUM LENGTH ---*/
        if(strlen($firstname)>20||strlen($lastname)>20||strlen($phone)>10){
            echo 'Please look to maxlength of fields';

        }else{  

                    //UPDATING VALUES TO THE PETOWNER TABLE
                    $query2 = "UPDATE PETOWNER SET F_name='".mysqli_real_escape_string($con,$firstname)."',L_name='".mysqli_real_escape_string($con,$lastname)."',Gender='".mysqli_real_escape_string($con,$gender)."',Email='".mysqli_real_escape_string($con,$email)."',Phone_number='".mysqli_real_escape_string($con,$phone)."',Address='".mysqli_real_escape_string($con,$address)."',District='".mysqli_real_escape_string($con,$district)."' WHERE user_id=$user_id";
                   

                    if($query_run2 = mysqli_query($con,$query2)){

                      $message = "Update Successful";
                      echo "<script type='text/javascript'>alert('$message');location='user.php';</script>";
                      
                        /*--- SENDING A CONFORMATION EMAIL ---*/

                        
                        // $to= 'jeevakeperera@gmail.com';
                        // $subject = 'This is an email';
                        // $body = 'This is a test email. hope you got it';
                        // $headers = 'From: voiceofnewlife123@gmail.com';

                        // if(mail($to,$subject,$body,$headers)){
                        //     echo 'Email successful';
                        // }else{
                        //     echo 'Error';
                        // }


                    }else{
                        $message = "Update Not Successful";
                        echo "<script type='text/javascript'>alert('$message');location='user.php';</script>";
                        
                      
                    }  
        }

    }else{
        echo "All fields are required";
    }
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
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

<!-- User Update Form -->
<div class="container" style="height:3rem">
        </div>
        <div class="container text-center mt-3">
            <h1 class="text-secondary">UPDATE YOUR DETAILS</h1>
          </div>
          
            <div class="container mt-3 mb-5 shadow" style="width:800px">
            <form action="userUpdate.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md mt-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">First Name</label>
                        <input class="form-control" id="firstname" aria-describedby="firstname" type="text" name="firstname" placeholder="first name " value="<?php echo $fname;  ?>" required>
                    </div>
                </div>
                <div class="col-md mt-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Last Name</label>
                        <input class="form-control" id="lastname" aria-describedby="username" type="text" name="lastname" placeholder="last name " value="<?php echo $lname; ?>" required >
                    </div>
                </div>
          </div>  

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php echo $email; ?>" required>
                            </div>


                        <?php
                        if($gender=='Male'){ ?>
                            
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                     <?php } else{ ?>
                       
                        <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" >
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female" checked>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>

                        <?php } ?>


                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="address" rows="2" name="address" id="address" class="form-control" value="" required><?php echo $address ?></textarea>
                            </div>

                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="district" aria-describedby="district" value="<?php echo $district; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" id="phone" placeholder="mobile number" aria-describedby="phone" type="tel" placeholder="0713456789" pattern="[0-9]{10}" name="phone" value="<?php echo '0'.$phone;?>" required>
                    </div>

                    <!-- <div class="mb-3">
                       <label for="propic" class="form-label">Profile Picture</label> 
                       <input type="file" id="propic" name="propic" class="form-control">
                    </div> -->
            
            <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Update">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
            </form>
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

        
        

<script>
  function showhide() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var y = document.getElementById("Cpassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
</script>

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>