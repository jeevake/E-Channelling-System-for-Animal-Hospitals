<?php

require '../database_connector.php';
require '../functions.php';
require '../core.php';

//OPERATION OF THE LOGOUT BUTTON
if(array_key_exists('logout', $_POST)) {
  header("Location: ../logout.php");
  }


//ASSIGNING THE HOSPITAL ID TO THE VARIABLE
$hos_id = getfield('hospital','Hospital_id','Hospital_id',$con);

/*--- IF THE USER NOT LOG IN ---*/
if(loggedin()){

    if( isset($_POST['firstname'])&&
        isset($_POST['lastname'])&&
        isset($_POST['email'])&&
        isset($_POST['channellingDay'])&&
        isset($_POST['channellingTime'])&&
        isset($_POST['numOfSlots'])&&
        isset($_POST['specialistArea'])&&
        isset($_POST['phone'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $channellingDay = $_POST['channellingDay'];
            $channellingTime = $_POST['channellingTime'];
            $numOfSlots = $_POST['numOfSlots'];
            $specialistArea = $_POST['specialistArea'];
            $phone = $_POST['phone'];


        if(!empty($firstname)&&!empty($lastname)&&!empty($email)&&!empty($channellingDay)&&!empty($channellingTime)&&!empty($numOfSlots)&&!empty($specialistArea)&&!empty($phone)){

            /*--- CHECKING THE MAXIMUM LENGTH ---*/
            if(strlen($phone)>10){
                echo 'Please look to maxlength of fields';
            }else{  
                        $query2 = "INSERT INTO `doctor` VALUES (NULL,'".mysqli_real_escape_string($con,$hos_id)."','".mysqli_real_escape_string($con,$firstname)."','".mysqli_real_escape_string($con,$lastname)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$channellingDay)."','".mysqli_real_escape_string($con,$channellingTime)."','".mysqli_real_escape_string($con,$numOfSlots)."','".mysqli_real_escape_string($con,$specialistArea)."','".mysqli_real_escape_string($con,$phone)."')";

                        if($query_run2 = mysqli_query($con,$query2)){
                          $message = "Successful";
                          echo "<script type='text/javascript'>alert('$message');location='hospital.php';</script>";
                   

                        }else{
                            echo "Plz register again";
                            echo $query2;
                        }
                    
    
            }

        }else{
            echo "All fields are required";
        }
    }

}

/*--- IF THE USER LOG IN ---*/
else if(!loggedin()){
  header("Location: ../web/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="index.css" />

    <title>Vet Hospital</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  </head>
  <body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg shadow">
      <div class="container mt-2 mb-2">
        <a class="navbar-brand" href="./web/index.php">
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
                  <a class="nav-link active" href="addDoctors.php" style="background-color:#7900ff;">Add Doctors</a>
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
    </nav>

    <!-- add doctors form -->

    <div class="container" style="height: 3rem"></div>

    <div class="container mt-3 mb-5 shadow" style="width: 800px">
      <form action="addDoctors.php" method="POST">
        <div class="row">
          <div class="col-md">
            <div class="mb-3">
              <label for="username" class="form-label mt-3">First Name</label>
              <input
                class="form-control"
                id="firstname"
                aria-describedby="firstname"
                type="text"
                name="firstname"
                placeholder="first name "
                value="<?php if(isset($firstname)){ echo $firstname; } ?>"
                required
              />
            </div>
          </div>
          <div class="col-md">
            <div class="mb-3">
              <label for="username" class="form-label mt-3">Last Name</label>
              <input
                class="form-control"
                id="lastname"
                aria-describedby="username"
                type="text"
                name="lastname"
                placeholder="last name "
                value="<?php if(isset($lastname)){ echo $lastname; } ?>"
                required
              />
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="example@gmail.com"
            value="<?php if(isset($email)){ echo $email; } ?>"
            required
          />
        </div>

        <div class="mb-3">
          <label for="channelday" class="form-label">Channelling Day</label>
          <input
            type="text"
            class="form-control"
            id="channelday"
            name="channellingDay"
            placeholder="channelday"
            aria-describedby="channelday"
            value="<?php if(isset($channellingDay)){ echo $channellingDay; } ?>"
            required
          />
        </div>

        <div class="mb-3">
          <label for="channeltime" class="form-label">Channelling Time</label>
          <input
            type="text"
            class="form-control"
            id="channeltime"
            name="channellingTime"
            placeholder="enter time"
            value="<?php if(isset($channellingTime)){ echo $channellingTime; } ?>"
            required
          />
        </div>

        <div class="mb-3">
          <label for="numOfSlots" class="form-label"
            >Number of slots per day</label
          >
          <input
            type="text"
            class="form-control"
            id="numOfSlots"
            name="numOfSlots"
            placeholder="numOfSlots"
            value="<?php if(isset($numOfSlots)){ echo $numOfSlots; } ?>"
            required
          />

        <div class="mb-3">
          <label for="sp-area" class="form-label">Specialist Area</label>
          <textarea
            type="sp-area"
            rows="2"
            name="specialistArea"
            id="sp-area"
            class="form-control"
            value="<?php if(isset($specialistArea)){ echo $specialistArea; } ?>"
            required
          ></textarea>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Mobile No</label>
          <input
            type="text"
            class="form-control"
            id="phone"
            placeholder="mobile number"
            aria-describedby="phone"
            type="tel"
            placeholder="0713456789"
            pattern="[0-9]{10}"
            name="phone"
            value="<?php if(isset($phone)){ echo $phone; } ?>"
            required
          />
        </div>

        <input
          type="submit"
          class="btn btn-primary mb-3 mt-3"
          value="Submit"
          style="background-color: #7900ff"
        />
        <input
          type="reset"
          class="btn btn-secondary mb-3 mt-3 ms-3"
          value="Reset"
        />
      </form>
    </div>
  </body>
  <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
