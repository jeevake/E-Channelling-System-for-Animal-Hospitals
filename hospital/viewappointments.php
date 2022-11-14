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
                  <a class="nav-link active" href="#" style="background-color:#7900ff;">View Appointments</a>
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
    </nav>

    <!-- add doctors form -->

    <div class="container mt-5 mb-5 shadow p-4" style="width: 60%; ">
      <form action="viewappointments.php" method="POST">
      <label class="form-label h3 mt-3" style="font-weight:bold;";>Search Appointments Received</label><br>
        <div class="row">
            <div class="col-md-6">
              <label for="appointmentDate" class="form-label">Appointment Date :</label>

              <input type="date" class="form-control" aria-describedby="appointmentDate" id="appointmentDate" name="appointmentDate"  style="width:80%">
              <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Search">
             
            </div>

          
          </div>
      </form>

            
            <?php
                  if(isset($_POST['appointmentDate'])){ ?>

                  <table class="table table-bordered table-sm">
                  <thead>
                  <tr class="table-dark">
                      <th>Petowner Name</th>
                      <th>Animal Category</th>
                      <th>Treatment Type</th>
                      <th>Additional Information</th>
                    </tr>
                  </thead>
                <tbody>

                <?php
                    $appointmentDate = $_POST['appointmentDate'];
                    // $reservedDate = $_POST['reservedDate'];

                    if(!empty($appointmentDate)){
                      echo $appointmentDate;

                      $queryappoint = "SELECT * FROM appointment WHERE Hospital_id='$hos_id' AND appointmentDate='$appointmentDate'";
                      if($query_appoint_run = mysqli_query($con,$queryappoint)){

                        while ($row = mysqli_fetch_assoc($query_appoint_run)){
                          $petowner = $row['Petowner_name'];
                          $treatmentType = $row['Treatment_type'];
                          $animalCategory = $row['Animal_category'];
                          $additionalInfo = $row['additional_info'];

                          echo  "<tr>
                          <td>$petowner</td>
                          <td>$treatmentType</td>
                          <td>$animalCategory</td>
                          <td>$additionalInfo</td>                         
                          </tr>";

                        }
                        
                      }else{
                        echo "Error in query";
                      }

                    }else{
                      echo "Empty appoint";
                    }

                  }else{
                    // echo "Not Set appoint";
                  }
                ?>

        </tbody>
      </table>
      
    </div>
  </body>
  <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
