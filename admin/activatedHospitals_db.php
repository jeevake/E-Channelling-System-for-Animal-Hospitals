<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

    if(isset($_GET['hos_id'])){

        //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
        $hos_id=$_GET['hos_id'];
    
        $query3="UPDATE hospital SET status = 'deactivated' WHERE Hospital_id=$hos_id";
        $query_run = mysqli_query($con,$query3);


        header("Location: activatedHospitals.php");
    
      }else{
        header("Location: activatedHospitals.php");
      }

?>