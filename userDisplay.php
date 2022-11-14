<?php
session_start();

require 'database_connector.php';
require 'functions.php';
$email = "";
$username = "";
$errors = array();

/*--- IF THE USER NOT LOG IN ---*/
if(!loggedin()){

    if( isset($_POST['username'])&&
        isset($_POST['password'])&&
        isset($_POST['password_again'])&&
        isset($_POST['firstname'])&&
        isset($_POST['lastname'])&&
        isset($_POST['gender'])&&
        isset($_POST['email'])&&
        isset($_POST['phone'])&&
        isset($_POST['district'])&&
        isset($_POST['address'])&&
        isset($_FILES['propic'])){
            $username =  $_POST['username'];
            $password =  $_POST['password'];
            $password_again =  $_POST['password_again'];
            $firstname =  $_POST['firstname'];
            $lastname =  $_POST['lastname'];
            $gender =  $_POST['gender'];
            $email =  $_POST['email'];
            $phone =  $_POST['phone'];
            $address =  $_POST['address'];
            $district =  $_POST['district'];
            $image = $_FILES['propic'];

            $imagefilename = $image['name'];
            
            $imagefileerror = $image['error'];
            
            $imagefiletemp = $image['tmp_name'];
            
            $filename_separate = explode('.',$imagefilename);
            
            $file_extension = strtolower(end($filename_separate));

            
            
           
            $upload_images = 'user/userpics/'.$imagefilename;
            
            move_uploaded_file($imagefiletemp,$upload_images);

        

        /*--- ENCRYPTING THE PASSWORD ---*/
       

        if(!empty($username)&&!empty($password)&&!empty($password_again)&&!empty($firstname)&&!empty($lastname)&&!empty($gender)&&!empty($email)&&!empty($phone)&&!empty($address)&&!empty($district)&&!empty($upload_images)){

            /*--- CHECKING THE MAXIMUM LENGTH ---*/
            if(strlen($username)>30||strlen($firstname)>20||strlen($lastname)>20||strlen($phone)>10){
                echo 'Please look to maxlength of fields';
            }else{  
                
                if ($password!=$password_again){
                    echo 'Passwords do not match';
                }else{

                    /*--- CHECKING USERNAME DUPLICATION ---*/
                    $query = "SELECT `Username` FROM `login` WHERE `Username`='$username'";
                    $query_run = mysqli_query($con,$query);

                    if (mysqli_num_rows($query_run)==1){
                        echo 'The username '.$username.' already exists.';
                    }else{

                        //INSERTING VALUES TO THE PETOWNER TABLE
                        $query2 = "INSERT INTO `petowner` VALUES (NULL,'".mysqli_real_escape_string($con,$phone)."','".mysqli_real_escape_string($con,$district)."','".mysqli_real_escape_string($con,$firstname)."','".mysqli_real_escape_string($con,$lastname)."','".mysqli_real_escape_string($con,$gender)."','".mysqli_real_escape_string($con,$address)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$upload_images)."')";


                        if(($query_run2 = mysqli_query($con,$query2))){

                   



                        $username1 =  mysqli_real_escape_string($con,$_POST['username']);
                        $password1 =  mysqli_real_escape_string($con,$_POST['password']);
                        $encpass = md5($password);
                        $code = rand(999999, 111111);
                        $status = "notverified";
                        
                        


                        $insert_data = "INSERT INTO login (Username, Password, code, status) values('$username1','$encpass', '$code', '$status')";
                        $data_check = mysqli_query($con, $insert_data);
                        if($data_check){
                            $subject = "Email Verification Code";
                            $message = "Your User Verification code is $code";
                            $sender = "From: vethomeservice@gmail.com";
                            if(mail($email, $subject, $message, $sender)){
                                $info = "We've sent a verification code to your email - $email";
                                $_SESSION['info'] = $info;
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;
                                $message = "Successfully Registered";
                                echo "<script type='text/javascript'>alert('$message');location='user-otp.php';</script>";
                                exit();
                            }else{
                                $errors['otp-error'] = "Failed while sending code!";
                            }
                        }else{
                            $errors['db-error'] = "Failed while inserting data into database!";
                        }

                        }   

                        
                    }
                }
            }

        }else{
            echo "All fields are required";
        }
    }

}

/*--- IF THE USER LOG IN ---*/
else if(loggedin()){
  echo 'Already registed user'; 
}
?>