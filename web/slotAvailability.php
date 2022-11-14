<?php
 require '../database_connector.php';
 require '../functions.php';
 require '../core.php';

 $hos_id=$_GET['Hospital_id'];

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

if(loggedin()){
  


}else{
    // header("Location: index.php");
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

<!-- Appointment Form -->
<div class="container" style="height:3rem;">
        </div>
        <div class="container text-center mt-3">
        
            <h1 class="text-secondary">SEARCH DATES FOR AVAILABLE SLOTS</h1>
          </div>
          
            <div class="container mt-3 mb-5 shadow" style="width:70%; padding:2%">
            
              <form action="" method="POST" enctype="multipart/form-data">

              <label for="searchDate" class="form-label">Search Appointment Date :</label>
              <input type="date" class="form-control" aria-describedby="searchDate" id="searchDate" name="searchDate"  style="width:50%">
                       
              <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Search">
              <a href="singleHospital.php?Hospital_id=<?php echo $hos_id; ?>">Go back to hospital</a>
              </form>

              


                <?php
                  $hos_id=$_GET['Hospital_id'];

                  if(isset($_POST['searchDate'])){
                    $searchDate = $_POST['searchDate'];
                
                    if(!empty($searchDate)){
                ?>

                <p class="h4" style="color:#0000ff; text-align:center;";>Normal Treatment</p>

                <div style="padding: 0px;	margin: 0px auto 0px auto; overflow: auto;">

                <table class="table table-bordered">
                  <thead>
                  <tr class="table-dark">
                      <th>Hospital Name</th>
                      <th>Email</th>
                      <th>Total Number of slots per day</th>
                      <th>Number of slots available</th>
                    </tr>
                  </thead>

                <tbody>

                <?php
                 

                      //GETTING THE NUMBER OF APPOINTMENTS IN THE SEARCHED DATE
                      $query_appoint = "SELECT * FROM appointment WHERE Hospital_id=$hos_id AND Doctor_id='0' AND appointmentDate='$searchDate'";
                      $query_appoint_run = mysqli_query($con,$query_appoint);
                      $numOfAppoint = mysqli_num_rows($query_appoint_run);
                     
                      //GETTING THE NUMBER OF SLOTS PER DAY BY THE HOSPITAL
                      $query_slots = "SELECT * FROM hospital WHERE Hospital_id=$hos_id";
                      $query_slots_run = mysqli_query($con,$query_slots);
                      $row = mysqli_fetch_assoc($query_slots_run);
                      
                      $hospitalName = $row['H_name'];
                      $email = $row['H_email'];
                      $slotsPerDay = $row['Num_slotsPerDay'];
                                                     
                      $availableSlots = $slotsPerDay - $numOfAppoint;

                      echo "<tr>
                              <td>$hospitalName</td>
                              <td>$email</td>
                              <td>$slotsPerDay</td>
                              <td style='color:#ff0000;'>$availableSlots</td>
                            </tr>";
                
                   
                
                ?> 
                  
                </tbody>
              </table>
                  </div>

              <p class="h4" style="color:#0000ff; text-align:center; margin-top:2%;";>Special Treatment</p>

              <div style="padding: 0px;	margin: 0px auto 0px auto; overflow: auto;">

              <?php
                  $querydoc = "SELECT * FROM doctor WHERE Hospital_id=$hos_id";
                  $query_doc_run = mysqli_query($con,$querydoc);

                  $numOfDoctors = mysqli_num_rows($query_doc_run);
                  
                  if($numOfDoctors>0){

                    echo '<table class="table table-bordered table-sm">
                    <thead>
                    <tr class="table-dark">
                        <th>Doctor Name</th>
                        <th>Email</th>
                        <th>Total Number of slots per day</th>
                        <th>Number of slots available</th>
                      </tr>
                    </thead>
  
                  <tbody>';

                    while ($row = mysqli_fetch_assoc($query_doc_run)){

                      $doc_id=$row['Doctor_id'];
                      $fname=$row['F_name'];
                      $lname=$row['L_name'];
                      $d_email=$row['Email'];
                      $numOfSlots=$row['Num_slotsPerDay'];

                       //GETTING THE NUMBER OF DOCTOR APPOINTMENTS IN THE SEARCHED DATE
                       $query_docAppoint = "SELECT * FROM appointment WHERE Hospital_id=$hos_id AND Doctor_id='$doc_id' AND appointmentDate='$searchDate'";
                       $query_docAppoint_run = mysqli_query($con,$query_docAppoint);
                       $numOfDocAppoint = mysqli_num_rows($query_docAppoint_run);

                       $docAvailableSlots = $numOfSlots - $numOfDocAppoint;

                      echo  "<tr>
                      <td>$fname $lname</td>
                      <td>$d_email</td>
                      <td>$numOfSlots</td>
                      <td style='color:#ff0000;'>$docAvailableSlots</td>                         
                  </tr>";
                    
                    }
                    echo ' </tbody>
                          </table>';

                  }  
              }else{

                }
              }else{
                // echo "Empty";
              }
              ?>
          </div>
              </div>


</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>