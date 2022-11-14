<?php
session_start();

require 'database_connector.php';
require 'functions.php';

    if( isset($_POST['name'])&&
        isset($_POST['email'])&&
        isset($_POST['message'])){
            $name =  $_POST['name'];
            $email =  $_POST['email'];
            $message =  $_POST['message'];

       

        if(!empty($name)&&!empty($email)&&!empty($message)){
        
           
                  
                        //INSERTING VALUES TO THE MESSAGE TABLE
                        $query2 = "INSERT INTO `message` VALUES (NULL,'".mysqli_real_escape_string($con,$name)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$message)."')";


                       mysqli_query($con,$query2);
                       $message = "Successfully Registered";
                       echo "<script type='text/javascript'>alert('$message');location='ContactUs.php';</script>";
                      

                          
               
                      

        }else{
            echo "All fields are required";
        }
    }




?>