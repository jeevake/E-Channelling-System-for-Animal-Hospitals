<?php 
    require '../core.php';
    require '../database_connector.php';
    require '../functions.php';
    if( isset($_POST['password_old'])&&
    isset($_POST['password'])&&
    isset($_POST['password_again'])){
        $password_old =  $_POST['password_old'];
        $password =  $_POST['password'];
        $password_again =  $_POST['password_again'];
        
    

    /*--- ENCRYPTING THE PASSWORD ---*/
    $password_hash = md5($password);
    $password_hash_old = md5($password_old);
   
   

  

            if ($password!=$password_again){
                echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
            
            }else{

             $query = "SELECT `Password` FROM `login_admin` WHERE `Password`='$password_hash_old'";
                $query_run = mysqli_query($con,$query);

                if (mysqli_num_rows($query_run)==1){
                    $password1 =  mysqli_real_escape_string($con,$_POST['password']);
                    
                    $query2="UPDATE `login_admin` SET password='$password_hash' WHERE username='Admin'";
                    $query_run = mysqli_query($con,$query2);
                    echo "<script type='text/javascript'>alert('Succesfully Update Your Password')</script>";
                    
                }else{
                    echo "<script type='text/javascript'>alert('Old Password Incorrect');</script>";
                    
                  
                }
            }
        }

    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Change Password</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="../web/index.css">
    </head>
    <body class="sb-nav-fixed">
    <?php require 'navbar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Change Admin Password</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="adminPanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Change Admin Password</li>
                        </ol>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Change Admin Password
                            </div>
            <div class="card-body">
                <form action="CheckPassword.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        
                    <div class="mb-3">
                        <label for="password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="password_old" name="password_old" placeholder="enter password" required>
                    </div>
                            
    
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="enter password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_again" name="password_again" placeholder="confirm password" required>
                    </div>
            
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" onclick="showhide()">
                            <label class="form-check-label" for="show-pw" >Show Password</label>
                        </div>

                            
            
              <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Submit">
              <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
              <a href="login_form.php" class="ms-3">Login</a>
            </form>
                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

<script>
  function showhide() {
  
  var x = document.getElementById("password_old");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  
  var y = document.getElementById("password");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
  var z = document.getElementById("password_again");
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
}

function showhidep() {
  var x = document.getElementById("hOpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  var y = document.getElementById("hpassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
  var z = document.getElementById("hApassword");
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
}
</script>
