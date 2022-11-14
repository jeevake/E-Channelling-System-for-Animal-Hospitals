<?php
    require '../database_connector.php';
    require '../functions.php';
    require '../core.php';

//ASSIGNING THE SEARCHED HOSPOTAL TO THE VARIABLE
$hos_id=$_GET['Hospital_id'];

$user_id = getfield('petowner','user_id','user_id',$con);

$user_name = getfield('login','Username','user_id',$con);

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

  
  $query="SELECT * FROM `hospital` WHERE `Hospital_id`= $hos_id";

    if($query_run = mysqli_query($con,$query)){

          /*  FETCHING THE HOSPITAL DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
              $name = $row['H_name'];
          }


    }else{
      echo "<script type='text/javascript'>alert('Database Error');</script>";
    }


    if (isset($_POST["submit"])) {
      if( isset($_POST['review'])&&
        isset($_POST['comment'])){

          $review = $_POST['review'];
          $comment = $_POST['comment'];

          if(!empty($review)&&!empty($comment)){

            $query2 = "INSERT INTO `review` VALUES (NULL,$hos_id,$user_id,'".mysqli_real_escape_string($con,$review)."','".mysqli_real_escape_string($con,$comment)."','".mysqli_real_escape_string($con,date('Y-m-d'))."','".mysqli_real_escape_string($con,$user_name)."')";

            if($query_run2 = mysqli_query($con,$query2)){
              echo "<script type='text/javascript'>alert('Review given successfully');</script>";
            }

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
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <style>
      table, th, td {
        border: 1px solid black;
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


          <!-- Review -->

          <div class="container" style="width:30%">
            <div class="card mb-3 mt-5 shadow-sm">
              <h5 class="card-header">Give a review for the hospital - <?php echo $name; ?></h5>
            
            <div class="card-body">
              <h5 class="card-title">Review</h5>
              <form action="review.php?Hospital_id=<?php echo $hos_id; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">

                              <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="review" id="Awesome" value="Awesome" checked>
                                    <label class="form-check-label" for="Awesome">Awesome</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="review" id="Excellent" value="Excellent">
                                    <label class="form-check-label" for="Excellent">Excellent</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="review" id="Good" value="Good">
                                    <label class="form-check-label" for="Good">Good</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="review" id="Average" value="Average">
                                    <label class="form-check-label" for="Average">Average</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="Poor" name="review" value="Poor">
                                    <label class="form-check-label" for="Poor">Poor</label>
                                </div>
                            </div>

                    <div class="col-md mt-3">
                          <div class="mb-3">
                             <label for="comment" class="form-label">Comment</label>
                             <textarea type="comment" rows="3" name="comment" id="comment" class="form-control" value="" required></textarea>
                          </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Submit">
                    <a href="singleHospital.php?Hospital_id=<?php echo $hos_id; ?>">Go back to hospital</a>
              </form>
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
