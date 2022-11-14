<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

    if(isset($_GET['hos_id'])){

        //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
        $hos_id=$_GET['hos_id'];
    
        $query_update = "UPDATE hospital SET status='activated', requestActivation = 'no' WHERE Hospital_id=$hos_id";
        $query_run_1 = mysqli_query($con,$query_update);

        $query_update2 = "UPDATE hospital SET requestActivation = 'no' WHERE Hospital_id=$hos_id";
        $query_run_2 = mysqli_query($con,$query_update2);

        header("Location: requestActivation.php");
    
      }else{
        header("Location: requestActivation.php");
      }

?>