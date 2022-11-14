<?php

session_start();
require './database_connector.php';
require './functions.php';

/*--- IF THE USER NOT LOG IN ---*/
if(!loggedin()){

    if( isset($_POST['username'])&&
        isset($_POST['password'])&&
        isset($_POST['password_again'])&&
        isset($_POST['hospitalname'])&&
        isset($_POST['address'])&&
        isset($_POST['city'])&&
        isset($_POST['district'])&&
        isset($_POST['email'])&&
        isset($_POST['phone'])&&
        isset($_POST['slotsperday'])&&
        isset($_POST['about'])&&
        isset($_POST['facilities'])&&
        isset($_FILES['image'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_again = $_POST['password_again'];
            $name = $_POST['hospitalname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $slotsperday = $_POST['slotsperday'];
            $about = $_POST['about'];
            $facilities = $_POST['facilities'];
            $image = $_FILES['image'];

            $imagefilename = $image['name'];
            
            $imagefileerror = $image['error'];
            
            $imagefiletemp = $image['tmp_name'];
            
            $filename_separate = explode('.',$imagefilename);
            
            $file_extension = strtolower(end($filename_separate));
            
           
            $upload_images = 'hospital/image/'.$imagefilename;
            move_uploaded_file($imagefiletemp,$upload_images);

            /*--- ENCRYPTING THE PASSWORD ---*/
             $password_hash = md5($password);
    

        if(!empty($username)&&!empty($password)&&!empty($password_again)&&!empty($name)&&!empty($address)&&!empty($city)&&!empty($district)&&!empty($email)&&!empty($phone)&&!empty($slotsperday)&&!empty($about)&&!empty($facilities)&&!empty($upload_images)){

            /*--- CHECKING THE MAXIMUM LENGTH ---*/
            if(strlen($username)>30||strlen($name)>40||strlen($phone)>10){
                echo 'Please look to maxlength of fields';
            }else{  
                
                    if ($password!=$password_again){
                        echo 'Passwords do not match';
                    }else{

                        /*--- CHECKING USERNAME DUPLICATION ---*/
                        $query = "SELECT `Username` FROM `login_hospital` WHERE `Username`='$username'";
                        $query_run = mysqli_query($con,$query);

                        if (mysqli_num_rows($query_run)==1){
                            echo 'The username '.$username.' already exists.';
                        
                            }else{ 
                                    //INSERTING VALUES TO THE HOSPITAL TABLE
                                    $query2 = "INSERT INTO `hospital` VALUES (NULL,'".mysqli_real_escape_string($con,$name)."','".mysqli_real_escape_string($con,$address)."','".mysqli_real_escape_string($con,$city)."','".mysqli_real_escape_string($con,$district)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$phone)."','".mysqli_real_escape_string($con,$slotsperday)."','".mysqli_real_escape_string($con,$about)."','".mysqli_real_escape_string($con,$facilities)."','".mysqli_real_escape_string($con,$upload_images)."','deactivated','no')";


                                    if($query_run2 = mysqli_query($con,$query2)){
                                        
                
                                        $encpass = md5($password);
                                        $code = rand(999999, 111111);
                                        $status = "notverified";
                                        
                                        
                
                
                                        $insert_data = "INSERT INTO login_hospital (Username, Password, code) values('$username','$encpass', '$code')";
                                        $data_check = mysqli_query($con, $insert_data);
                                        if($data_check){
                                            $subject = "Email Verification Code";
                                            $message = "Your Hospital Verification code is $code";
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

                                    }else{
                                        echo "Plz register again";
                                        echo $query2;

                                    }
                            }
                    }
            }

        }else{
            echo "All fields are required";
        }
    }else{
        echo "Not set";
    }


}
/*--- IF THE USER LOG IN ---*/
else if(loggedin()){
  echo 'Already registed user'; 
}
?>
