<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

    if(isset($_GET['hos_id'])){

        //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
        $hos_id=$_GET['hos_id'];
    
        $query3="DELETE FROM `hospital` WHERE Hospital_id=$hos_id";
        $query_run = mysqli_query($con,$query3);

        $query4="DELETE FROM `login_hospital` WHERE Hospital_id=$hos_id";
        $query_run = mysqli_query($con,$query4);


        header("Location: registeredHospitals.php");
    
      }else{
        header("Location: registeredHospitals.php");
      }

?>