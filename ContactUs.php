<?php
   require './core.php';
   require './database_connector.php';
   require './functions.php';

    //OPERATION OF THE LOGIN BUTTON
      if(array_key_exists('login', $_POST)) {
        header("Location: ./login_form.php");
      }

    //OPERATION OF THE REGISTER BUTTON
      if(array_key_exists('register', $_POST)) {
        header("Location: ./registration_form.php");
      }

    //OPERATION OF THE LOGOUT BUTTON
      if(array_key_exists('logout', $_POST)) {
        header("Location: ./logout.php");
      }

    //OPERATION OF THE USER BUTTON
      if(array_key_exists('user', $_POST)) {
        header("Location: ./user.php");
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

  <title>Contact Us</title>
  <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body style="background-color: ghostwhite;">
   <!-- Navigation bar -->
   <nav class="navbar navbar-expand-lg shadow">
            <div class="container mt-2 mb-2">
              <a class="navbar-brand" href="./web/index.php"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
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
                    <a class="nav-link" href="ContactUs.php">Support</a>
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
    <section class="text-dark p-5 text-center text-sm-start "  style="margin-top:2%;" >
  

  


<div class="container bg-ghoustwhite" >
  <div class="row ">
    <div class="col-md">
      <div class="card text-dark bg-white mb-3 shadow-crd shadow p-3" >
        
        <div class="card-body">
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3182065371907!2d80.5364819147154!3d5.950817995689383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae13f2c222ac3c3%3A0x3551ce3f7b705a4f!2sKalidasa%20Rd%2C%20Matara%2C%20Sri%20Lanka!5e0!3m2!1sen!2ssg!4v1611636154101!5m2!1sen!2ssg" width="550vw" height="579vw" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" ></iframe></p>
        </div>
      </div>
    </div>

    <div class="col-md">
      <div class="card text-dark bg-white mb-3 shadow-crd shadow p-3" >
        
        <div class="card-body">
          <h5 class="card-title">Contact Us</h5>
          <p>Do you have any questions about VetHome? We definitely have the answer.</p>
         
          <p>Click any of the links below to talk to us!.</p>
          
          
            <a href="" class="me-4 text-reset" style="float:left;margin-left:1%">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset" style="float:left">
                <i class="fab fa-twitter"></i>
            </a>
            
            <a href="" class="me-4 text-reset" style="float:left">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset" style="float:left">
                <i class="fab fa-linkedin"></i>
            </a></br></br>

            <p>Call Us!.</p>
            <div class="me-4 text-reset">
                <i class="fa fa-phone" style="margin-left:1%"></i> +94765259905
            </div>
            
          
        </div>
        
        <div class="tab-pane fade show active" id="nav-petowner" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

            <form action="ContactMessage.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        
                                
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Name</label>
                                        <input class="form-control" id="name" aria-describedby="name" type="text" name="name" placeholder="name " value="<?php if(isset($name)){ echo $name; } ?>" required>
                                    </div>
                               
                               
                        

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php if(isset($email)){ echo $email; } ?>" required>
                            </div>

                    

                            <div class="mb-3">
                                <label for="address" class="form-label">Your Message</label>
                                <textarea type="address" rows="2" name="message" id="message" class="form-control" value="<?php if(isset($message)){ echo $message; } ?>" required></textarea>
                            </div>

                            
            
              <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Submit">

                   
                
                  

              <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
              
            </form>
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
 </html>