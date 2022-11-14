<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

    if(isset($_GET['user_id'])){

        //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
        $user_id=$_GET['user_id'];
    
        $query3="DELETE FROM `petowner` WHERE user_id=$user_id";
        $query_run = mysqli_query($con,$query3);

        $query4="DELETE FROM `login` WHERE user_id=$user_id";
        $query_run = mysqli_query($con,$query4);


        header("Location: registeredUsers.php");
    
      }else{
        header("Location: registeredUsers.php");
      }

?>