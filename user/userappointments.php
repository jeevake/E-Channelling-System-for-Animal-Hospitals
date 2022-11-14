<?php
    require '../database_connector.php';
    require '../functions.php';
    require '../core.php';

    if(loggedin()){

        //ASSIGNING THE USER DETAILS TO THE VARIABLES
        
        $user_id = getfield('petowner','user_id','user_id',$con);

    }

  //OPERATION OF THE LOGOUT BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
    }
  
    //OPERATION OF THE USER BUTTON
    if(array_key_exists('user', $_POST)) {
    header("Location: user.php");
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
            <h1 class="text-secondary">YOUR APPOINTMENTS</h1>
          </div>

          <?php
           $query_appointments = "SELECT * FROM appointment WHERE User_ID=$user_id";
           $query_appoint_run = mysqli_query($con,$query_appointments);
          
          ?>
          
            <div class="container mt-3 mb-5 p-3 shadow" style="width:80%">
            <table class="table table-bordered table-sm">
                  <thead>
                  <tr class="table-dark">
                      <th>Reserved Date</th>
                      <th>Hospital Name</th>
                      <th>Hospital Address</th>
                      <th>Treatment_type</th>
                      <th>Doctore Name</th>
                      <th>Slot Number</th>
                      <th>Appointment Date</th>
                    </tr>
                  </thead>

                <tbody>
               <?php
                    while ($row1 = mysqli_fetch_assoc($query_appoint_run)){
                        $rDate=$row1['reservedDate'];
                        $hospital_id=$row1['Hospital_Id'];
                        $doctor_name=$row1['Doctor_name'];
                        $doctor_id=$row1['Doctor_id'];
                        $Treatment_type=$row1['Treatment_type'];
                        $aDate=$row1['appointmentDate'];
                        $slotNum = $row1['Slot_num'];

                        $query_hospital = "SELECT * FROM hospital WHERE Hospital_id=$hospital_id";
                        $query_hospital_run = mysqli_query($con,$query_hospital);

                        while ($row2 = mysqli_fetch_assoc($query_hospital_run)){
                            $hospital_address = $row2['H_address'];
                            $hospital_name = $row2['H_name'];
                            $hospital_phone = $row2['H_phoneNumber'];
                        }

                        echo "<tr>
                            <td>$rDate</td>
                            <td>$hospital_name</td>
                            <td>$hospital_address</td>
                            <td>$Treatment_type</td>";
                            
                            if($doctor_id==0){
                                echo "<td> - </td>";
                            }else{
                                echo "<td>$doctor_name</td>";
                            }

                        echo "<td>$slotNum</td>";    
                        
                        if($aDate>=date('Y-m-d')){
                            echo "<td style='color:#ff0000;'>$aDate</td>";
                        }else{
                            echo "<td>$aDate</td>";
                        }

                        echo "</tr>";
                    }
               ?>
              
                  
                </tbody>
              </table>

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