<?php

require '../database_connector.php';
require '../functions.php';
require '../core.php';

 //OPERATION OF THE LOGOUT BUTTON
 if(array_key_exists('logout', $_POST)) {
  header("Location: ../logout.php");
  }


//ASSIGNING THE HOSPITAL DETAILS TO THE VARIABLES
$hos_id = getfield('hospital','Hospital_id','Hospital_id',$con);


/*--- IF THE USER NOT LOG IN ---*/
if(loggedin()){

    if( isset($_POST['hospitalname'])&&
        isset($_POST['address'])&&
        isset($_POST['city'])&&
        isset($_POST['district'])&&
        isset($_POST['email'])&&
        isset($_POST['phone'])&&
        isset($_POST['slotsperday'])&&
        isset($_POST['about'])&&
        isset($_POST['facilities'])){
            $name = $_POST['hospitalname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $slotsperday = $_POST['slotsperday'];
            $about = $_POST['about'];
            $facilities = $_POST['facilities'];

        if(!empty($name)&&!empty($address)&&!empty($city)&&!empty($district)&&!empty($email)&&!empty($phone)&&!empty($slotsperday)&&!empty($about)&&!empty($facilities)){

            /*--- CHECKING THE MAXIMUM LENGTH ---*/
            if(strlen($name)>40||strlen($phone)>10){
                echo 'Please look to maxlength of fields';
            }else{  
                
                                    //INSERTING VALUES TO THE HOSPITAL TABLE
                                    $query1 = "UPDATE hospital SET H_name='".mysqli_real_escape_string($con,$name)."',H_address='".mysqli_real_escape_string($con,$address)."',H_city='".mysqli_real_escape_string($con,$city)."',H_district='".mysqli_real_escape_string($con,$district)."',H_email='".mysqli_real_escape_string($con,$email)."',H_phoneNumber='".mysqli_real_escape_string($con,$phone)."',Num_slotsPerDay='".mysqli_real_escape_string($con,$slotsperday)."',About_us='".mysqli_real_escape_string($con,$about)."',Facilities='".mysqli_real_escape_string($con,$facilities)."' WHERE Hospital_id=$hos_id";
                                    
                                    if($query_run1 = mysqli_query($con,$query1)){
                                      $message = "Successful";
                                      echo "<script type='text/javascript'>alert('$message');location='hospital-update.php';</script>";

                                        /*--- SENDING A CONFORMATION EMAIL TO CONFIRM REGISTRATION ---*/


                                        // $to       = $email;
                                        // $subject  = 'Testing sendmail.exe';
                                        // $message  = 'Hi, you just received an email using sendmail!';
                                        // $headers  = 'From: lahiru.lmk98@gmail.com' . "\r\n" .
                                        // 'MIME-Version: 1.0' . "\r\n" .
                                        // 'Content-type: text/html; charset=utf-8';
                                    /*  if(mail($to, $subject, $message, $headers))
                                        //echo "Email sent";
                                        else
                                        echo "Email sending failed";
                                    */
                                

                                    }else{
                                        echo "Plz try again";

                                    }       
                    
            }

        }else{
            echo "All fields are required";
        }
    }


}
/*--- IF THE USER LOG IN ---*/
else{
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
        <a class="navbar-brand" href="#">
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
                  <a class="nav-link active" href="hospital-update.php" style="background-color:#7900ff;">Update Details</a>
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
              <form method="post">
                <input
                  class="nav-link"
                  type="submit"
                  name="logout"
                  class="button"
                  value="Logout"
                />
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Update Hospital -->

    <div class="container" style="height: 3rem"></div>

    <div class="container mt-3 mb-5 shadow" style="width: 800px">
      <form action="hospital-update.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md mt-3">
            <div class="mb-3">
              <label for="hospital" class="form-label">Hospital Name</label>
              <input
                class="form-control"
                id="hospitalname"
                aria-describedby="hospitalname"
                type="text"
                name="hospitalname"
                placeholder="hospital name"
                value="<?php  echo getfield('hospital','H_name','Hospital_id',$con); ?>"
                required
              />
            </div>
          </div>
          <div class="col-md mt-3">
            <div class="mb-3">
              <label for="hospital" class="form-label">City</label>
              <input
                class="form-control"
                id="city"
                aria-describedby="city"
                type="text"
                name="city"
                placeholder="city"
                value="<?php echo getfield('hospital','H_city','Hospital_id',$con); ?>"
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
            value="<?php echo getfield('hospital','H_email','Hospital_id',$con);  ?>"
            required
          />
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
            value="<?php echo "0".getfield('hospital','H_phoneNumber','Hospital_id',$con); ?>"
            required
          />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea
            type="address"
            rows="2"
            name="address"
            id="address"
            class="form-control"
            required
          ><?php echo getfield('hospital','H_address','Hospital_id',$con); ?></textarea>
        </div>

        <div class="mb-3">
          <label for="district" class="form-label">Select District :</label>
          <select name="district" value="Pick a district">
                <option value="<?php echo getfield('hospital','H_district','Hospital_id',$con); ?>" selected><?php echo getfield('hospital','H_district','Hospital_id',$con); ?></option>
            <option value="Gampaha">Gampaha</option>
            <option value="Colombo">Colombo</option>
            <option value="Kalutara">Kalutara</option>
            <option value="Anuradhapura">Anuradhapura</option>
            <option value="Polonnaruwa">Polonnaruwa</option>
            <option value="Matale">Matale</option>
            <option value="Kandy">Kandy</option>
            <option value="Nuwara Eliya">Nuwara Eliya</option>
            <option value="Puttalam">Puttalam</option>
            <option value="Kurunegala">Kurunegala</option>
            <option value="Kegalle">Kegalle</option>
            <option value="Ratnapura">Ratnapura</option>
            <option value="Jaffna">Jaffna</option>
            <option value="Kilinochchi">Kilinochchi</option>
            <option value="Mannar">Mannar</option>
            <option value="Mullaitivu">Mullaitivu</option>
            <option value="Vavuniya">Vavuniya</option>
            <option value="Trincomalee">Trincomalee</option>
            <option value="Batticaloa">Batticaloa</option>
            <option value="Ampara">Ampara</option>
            <option value="Badulla">Badulla</option>
            <option value="Monaragala">Monaragala</option>
            <option value="Hambantota">Hambantota</option>
            <option value="Matara">Matara</option>
            <option value="Galle">Galle</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="slots" class="form-label">Slots per day : </label>
          <input
            type="number"
            name="slotsperday"
            class="ms-3"
            value="<?php echo getfield('hospital','Num_slotsPerDay','Hospital_id',$con); ?>"
            required
          />
        </div>

        <div class="mb-3">
          <label for="about" class="form-label">About Us</label>
          <textarea
            type="about"
            rows="8"
            name="about"
            id="about"
            class="form-control"
            required
          ><?php echo getfield('hospital','About_us','Hospital_id',$con); ?></textarea>
        </div>

        <div class="mb-3">
          <label for="facilities" class="form-label">Facilities</label>
          <textarea
            type="facilities"
            rows="8"
            name="facilities"
            id="facilities"
            class="form-control"
            required
          ><?php echo getfield('hospital','Facilities','Hospital_id',$con); ?></textarea>
        </div>

        <!-- <div class="mb-3">
          <label for="propic" class="form-label">Main Image</label>
          <input type="file" id="image"name="image" class="form-control" required          />
        </div> -->

        <input
          type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Update"/>
        <input
          type="reset" class="btn btn-secondary mb-3 mt-3 ms-3"   style="border-radius: 30px"  value="Reset"/>
        <a href="index.php" class="btn btn-warning mt-3 mb-3 ms-3"
          >Hospital Main Menu</a
        >
      </form>
    </div>

    <script>
      function showhidep() {
        var x = document.getElementById("hpassword");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
        var y = document.getElementById("hCpassword");
        if (y.type === "password") {
          y.type = "text";
        } else {
          y.type = "password";
        }
      }
    </script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
