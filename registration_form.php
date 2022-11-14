<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="index.css">

  <title>Vet Hospital</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<body>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg shadow">
            <div class="container mt-2 mb-2">
            <a class="navbar-brand" href="web/index.php"> <img src="./img/logo.png" alt="brand" width="50" height="43" > VetHome</a>
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
                  <li class="nav-item">
                    <a href="login_form.php" class="btn btn-primary btn-main-outline btn-main-w ms-3">Login</a>
                  </li>
                  <li class="nav-item">
                    <a href="registration_form.php" class="btn btn-primary btn-main btn-main-w ms-3">Register</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

<!-- Registration Form -->
<div class="container" style="height:3rem">
        </div>
        <div class="container text-center mt-3">
            <h1 class="text-secondary">REGISTER NOW</h1>
          </div>
          
            <div class="container mt-3 mb-5 " style="width:800px">

            <!-- PetOwner / Hospital -->

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link mt-3 active" id="nav-petowner-tab" data-bs-toggle="tab" data-bs-target="#nav-petowner" type="button" role="tab" aria-controls="nav-petowner" aria-selected="true">Pet Owner</button>
                    <button class="nav-link mt-3" id="nav-hospital-tab" data-bs-toggle="tab" data-bs-target="#nav-hospital" type="button" role="tab" aria-controls="nav-hospital" aria-selected="false">Hospital</button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">

            <!-- pet owner register -->
                                <div class="tab-pane fade show active" id="nav-petowner" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0" >

                                <form action="userDisplay.php" method="POST" enctype="multipart/form-data" autocomplete="off" >
                            
                               
                                    <div class="mb-3">
                                        <label for="username" class="form-label">First Name</label>
                                        <input class="form-control" id="firstname" aria-describedby="firstname" type="text" name="firstname" placeholder="first name " value="<?php if(isset($firstname)){ echo $firstname; } ?>" required>
                                    </div>
                               
                                
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Last Name</label>
                                        <input class="form-control" id="lastname" aria-describedby="username" type="text" name="lastname" placeholder="last name " value="<?php if(isset($lastname)){ echo $lastname; } ?>" required >
                                    </div>
                            
                        

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php if(isset($email)){ echo $email; } ?>" required>
                            </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" aria-describedby="username" value="<?php if(isset($username)){ echo $username; } ?>" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="enter password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="Cpassword" name="password_again" placeholder="confirm password" required>
                    </div>
            
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" onclick="showhide()">
                            <label class="form-check-label" for="show-pw" >Show Password</label>
                        </div>

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

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="address" rows="2" name="address" id="address" class="form-control" value="<?php if(isset($address)){ echo $address; } ?>" required></textarea>
                            </div>

                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="district" aria-describedby="district" value="<?php if(isset($district)){ echo $district; } ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" id="phone" placeholder="mobile number" aria-describedby="phone" type="tel" placeholder="0713456789" pattern="[0-9]{10}" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" required>
                    </div>

                    <div class="mb-3" >
                       <label for="propic" class="form-label">Profile Picture</label> 
                       <input type="file" id="propic" name="propic" class="form-control" required>
                    </div>
            <div style="margin-top:5vw">
            <input type="submit"  class="btn btn-primary btn-main mb-3 mt-3" value="Submit">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
            <a href="login_form.php" class="ms-3">Login</a>
          </div>
            </form>
            </div>
        </div>
</div>

                <!-- hospital register -->
           <div class="tab-pane fade container mt-3 mb-5 pt-1" id="nav-hospital" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0" style="width:800px;">

                <form action="hosdisplay.php" method="POST" enctype="multipart/form-data" style="height:78vw;margin-top:-3vw" autocomplete="off">
                            <div class="row">
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="hospital" class="form-label">Hospital Name</label>
                                        <input class="form-control" id="hospitalname" aria-describedby="hospitalname" type="text" name="hospitalname" placeholder="hospital name" value="<?php if(isset($name)){ echo $name; } ?>" required>
                                    </div>
                                </div>
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="hospital" class="form-label">City</label>
                                        <input class="form-control" id="city" aria-describedby="city" type="text" name="city" placeholder="city" value="<?php if(isset($city)){ echo $city; } ?>" required >
                                    </div>
                                </div>
                        </div>  

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php if(isset($email)){ echo $email; } ?>" required>
                            </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" aria-describedby="username" value="<?php if(isset($username)){ echo $username; } ?>" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="hpassword" name="password" placeholder="enter password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="hCpassword" name="password_again" placeholder="confirm password" required>
                    </div>
            
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" onclick="showhidep()">
                            <label class="form-check-label" for="show-pw" >Show Password</label>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" id="phone" placeholder="mobile number" aria-describedby="phone" type="tel" placeholder="0713456789" pattern="[0-9]{10}" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" required>
                        </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="address" rows="2" name="address" id="address" class="form-control" value="<?php if(isset($address)){ echo $address; } ?>" required></textarea>
                            </div>

                    <div class="mb-3">

                        <label for="district" class="form-label">Select District :</label>
                        <select class="form-select" name="district">
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
                    <input type="number" name="slotsperday" class="ms-3" value="<?php if(isset($slotsperday)){ echo $slotsperday; } ?>" required>
                   </div>

                   <div class="mb-3">
                        <label for="about" class="form-label">About Us</label>
                        <textarea type="about" rows="2" name="about" id="about" class="form-control" value="<?php if(isset($about)){ echo $about; } ?>" required></textarea>
                   </div>

                   <div class="mb-3">
                        <label for="facilities" class="form-label">Facilities</label>
                        <textarea type="facilities" rows="2" name="facilities" id="facilities" class="form-control" value="<?php if(isset($facilites)){ echo $facilites; } ?>" required></textarea>
                   </div>

                    <div class="mb-3" >
                       <label for="propic" class="form-label">Main Image</label> 
                       <input type="file" id="image" name="image" class="form-control" required>
                    </div>
         
            <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Submit">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
            <a href="login_form.php" class="ms-3">Login</a>
          
            </form>
            </div>

            </div>

            </div>

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

</body>
<script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>