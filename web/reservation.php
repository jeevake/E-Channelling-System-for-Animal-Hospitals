<?php
 require '../database_connector.php';
 require '../functions.php';
 require '../core.php';

     //OPERATION OF THE LOGOUT BUTTON
     if(array_key_exists('logout', $_POST)) {
      header("Location: ../logout.php");
    }

 if(loggedin()){

    //GETTING USER DETAILS
    $user_id = getfield('petowner','user_id','user_id',$con);

    $query1="SELECT * FROM `petowner` WHERE `user_id`= $user_id";

    if($query_run = mysqli_query($con,$query1)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
              $u_fname = $row['F_name'];
              $u_lname = $row['L_name'];
              $u_email = $row['Email'];
              $u_phone = $row['Phone_number'];
          }

    }else{
        echo 'Error in the query';
    }

   //GETTING HOSPITAL DETAILS
    $hos_id=$_GET['Hospital_id'];

    $query2="SELECT * FROM `hospital` WHERE `Hospital_id`= $hos_id";

    if($query_run = mysqli_query($con,$query2)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
                $h_name = $row['H_name'];
                $h_district = $row['H_district'];
          
          }
    }else{
        echo 'Error in the query';
    }

    //GETTING DOCTOR DETAILS
    $doc_id=$_GET['Doctor_id'];

    $query3="SELECT * FROM `doctor` WHERE `Doctor_id`= $doc_id";

    if($query_run = mysqli_query($con,$query3)){

        /*  FETCHING THE DATA FROM THE DATABASE */ 
      while ($row = mysqli_fetch_assoc($query_run)){
            $d_fname = $row['F_name'];
            $d_lname = $row['L_name'];
            $speacialistArea = $row['Specialist_area'];
      }
    }    

 }else{
    header("Location: index.php");
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

<!-- Appointment Form -->
<div class="container" style="height:3rem">
        </div>
        <div class="container text-center mt-3">
            <h1 class="text-secondary">RESERVATION DETAILS</h1>
          </div>
          
            <div class="container mt-3 mb-5 shadow" style="width:800px">
            <form action="db_reservation.php?Hospital_id=<?php echo $hos_id; ?>&Doctor_id=<?php echo $doc_id; ?>" method="POST" enctype="multipart/form-data">

            <label style="color:#ff0000;" for="regdate" class="form-label"><?php echo date('Y-m-d');  ?> </label>
           
              <div class="row">
                <div class="col-md mt-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Petowener Name</label>
                        <input class="form-control" id="name" aria-describedby="name" type="text" name="ptname" placeholder="Name " value="<?php echo $u_fname." ".$u_lname;  ?>" required>
                    </div>
                </div>

                <div class="col-md mt-3">
                    <div class="mb-3">
                        <label for="hospitalName" class="form-label">Hospital Name</label>
                        <input class="form-control" id="hospitalName" aria-describedby="hospitalName" type="text" name="hospitalName" placeholder="hospitalName " value="<?php echo $h_name;  ?>" required READONLY>
                    </div>
                </div>
              </div>  
                   <div class="mb-3">
                        <label for="hospitalDistrict" class="form-label"> Hospital District</label>
                        <input class="form-control" id="hospitalDistrict" aria-describedby="hospitalDistrict" type="text" name="hospitalDistrict" placeholder="hospitalDistrict " value="<?php echo $h_district;  ?>" required READONLY>
                    </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php echo $u_email;?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="treatmentType" class="form-label">Treatment Type</label>
                            <input class="form-control" id="treatmentType" aria-describedby="treatmentType" type="text" name="treatmentType" placeholder="treatmentType " value="<?php if($doc_id==0){echo "Normal Treatment";}else{echo "Special Treatment";} ?> " required READONLY>
                            </div>


                    <?php if($doc_id>0){echo " 
                     <div class='row'>
                      <div class='col-md mt-3'>
                          <div class='mb-3'>
                            <label for='username' class='form-label'>Doctor Name</label>
                            <input class='form-control' id='doctorName' aria-describedby='doctorName' type='text' name='doctorName' placeholder='doctorName' value='$d_fname $d_lname' required READONLY>
                          </div>
                       </div>
     
                       <div class='col-md mt-3'>
                          <div class='mb-3'>
                            <label for='specialistArea' class='form-label'>Specialist Area</label>
                            <input class='form-control' id='specialistArea' aria-describedby='specialistArea' type='text' name='specialistArea' placeholder='specialistArea' value='$speacialistArea' required READONLY>
                          </div>
                      </div>
                    </div>  
                         
                    ";}?>


                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" id="phone" placeholder="mobile number" aria-describedby="phone" type="tel" placeholder="0713456789" pattern="[0-9]{10}" name="phone" value="0<?php echo $u_phone;  ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="animalCategory" class="form-label">Animal Catergory</label>
                        <select class="form-select" name="animalCategory">
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Bird">Bird</option>
                            <option value="Small Mammal">Small Mammal</option>
                            <option value="Horse">Horse</option>
                            <option value="Reptile Amphibians">Reptile Amphibians</option>
                            <option value="Farm Animals">Farm Animals</option>
                            <option value="Other Exotic">Other Exotic</option>
                        </select>
                    </div>

                 
                    <div class="mb-3">

                        <label for="appointmentDate" class="form-label">Select Appointment Date :</label>
                        <input type="date" class="form-control" aria-describedby="appointmentDate" id="appointment" name="appointmentDate">
                        </div>

                    <div class="mb-3">


                    <div class="mb-3">
                                <label for="additionalInfo" class="form-label">Additional Info</label>
                                <textarea type="additionalInfo" rows="2" name="additionalInfo" id="additionalInfo" class="form-control" value="<?php if(isset($address)){ echo $address; } ?>"></textarea>
                    </div>

                    <div class="mb-3">
                                <label for="payment" class="form-label">Payment Method</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment" id="debitCard" value="debitCard" checked>
                                    <label class="form-check-label" for="debitCard">Debit Card</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="creditCard" name="payment" value="creditCard">
                                    <label class="form-check-label" for="creditCard">Credit Card</label>
                                </div>
                    </div>
            
            <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Make an appointment">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
            &nbsp;<a href="singleHospital.php?Hospital_id=<?php echo $hos_id; ?>">Go back to hospital</a>
            </form>
            </div>

        
</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>