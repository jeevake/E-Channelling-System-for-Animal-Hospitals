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

  if (isset($_POST["submit"])) {
    $query1 = "DELETE FROM specialFacilities WHERE Hospital_id = $hos_id";
    $query_run1 = mysqli_query($con,$query1);

      if (isset($_POST["areas"]) && count($_POST["areas"]) > 0) {
          $specialAreas = $_POST["areas"];

          foreach ($specialAreas as $specialArea) {
            
            //IF THE HOSPITAL DOES NOT EXITS IN THE SPECIALFACILITIES TABLE
              
              $query2 = "INSERT INTO specialfacilities VALUES (NULL,'".mysqli_real_escape_string($con,$hos_id)."','".mysqli_real_escape_string($con,$specialArea)."')";
  
                          if($query_run2 = mysqli_query($con,$query2)){
                            $message = "Successful";
                            echo "<script type='text/javascript'>location='specialFacilities.php';</script>";
                     
  
                          }else{
                            echo "<script type='text/javascript'>alert('Unsuccessful')</script>";
                          }
          }
                    
      }else{
          
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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>
  <body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg shadow">
      <div class="container mt-2 mb-2">
        <a class="navbar-brand" href="./web/index.php">
        <a class="navbar-brand" href="#"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
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
                  <a class="nav-link active" href="#" style="background-color:#7900ff;">Special Facilities</a>
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

    <div class="container mt-3 mb-5 shadow p-3" style="width: 50%">
      <form action="specialFacilities.php" method="POST">
      <label class="form-label h3" style="font-weight:bold;";>Special Facilities offered by the hospital</label><br>
        <div class="row">

          <div class="col-md">
            <div class="mb-3">
           
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Anesthesia" name="areas[]">
                                            <label class="form-check-label">
                                                Anesthesia
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Behavior" name="areas[]">
                                            <label class="form-check-label">
                                                Behavior
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Dentistry" name="areas[]">
                                            <label class="form-check-label">
                                                Dentistry
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Cardiology" name="areas[]">
                                            <label class="form-check-label">
                                                Cardiology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Oncology" name="areas[]">
                                            <label class="form-check-label">
                                                Oncology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Lab Animal" name="areas[]">
                                            <label class="form-check-label">
                                                Lab Animal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Radiology" name="areas[]">
                                            <label class="form-check-label">
                                                Radiology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Pharmacology" name="areas[]">
                                            <label class="form-check-label">
                                                Pharmacology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Sports Medicine" name="areas[]">
                                            <label class="form-check-label">
                                                Sports Medicine
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Surgery Orthopedics" name="areas[]">
                                            <label class="form-check-label">
                                                Surgery Orthopedics
                                            </label>
                                        </div>
                                       
            </div>
          </div>


          <div class="col-md">
            <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Behavior" name="areas[]">
                                            <label class="form-check-label">
                                               Behavior
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Immunology" name="areas[]">
                                            <label class="form-check-label">
                                                Immunology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Dermatology" name="areas[]">
                                            <label class="form-check-label">
                                                Dermatology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Endocrinology" name="areas[]">
                                            <label class="form-check-label">
                                                Endocrinology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Neurology" name="areas[]">
                                            <label class="form-check-label">
                                                Neurology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Parasitology" name="areas[]">
                                            <label class="form-check-label">
                                                Parasitology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Microbiology" name="areas[]">
                                            <label class="form-check-label">
                                                Microbiology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Nutrition" name="areas[]">
                                            <label class="form-check-label">
                                                Nutrition
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Pathology" name="areas[]">
                                            <label class="form-check-label">
                                                Pathology
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Preventive" name="areas[]">
                                            <label class="form-check-label">
                                                Preventive
                                            </label>
                                        </div>

            </div>
          </div>
        </div>

        <input type="submit" name="submit" class="btn btn-primary mb-3 mt-3" value="Update" style="background-color: #7900ff"/>
        <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" value="Reset"/>
      </form>
    </div>

            <div class="card shadow" style="width: 50%; margin: 0 auto 0;" >
            <div class="card-body">
            <h5 class="card-title">Special Facilities Available</h5>
            <?php  
                              $query2="SELECT * FROM `specialfacilities` WHERE `Hospital_id` = $hos_id";
                              $query_run2 = mysqli_query($con,$query2);
                              while ($row2 = mysqli_fetch_assoc($query_run2)){
                                $spArea = $row2['specialArea'];
                                echo "<i class='fas fa-check' style='color:#00E4FF'></i> $spArea</br>";
                              }
                          ?>
          </div>
        </div>

  </body>
  <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
