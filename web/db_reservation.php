<?php

require '../database_connector.php';
require '../functions.php';
require '../core.php';

if(loggedin()){

    $user_id = getfield('petowner','user_id','user_id',$con);
    $hos_id=$_GET['Hospital_id'];
    $doc_id=$_GET['Doctor_id'];

    if(isset($_POST['ptname'])&&
    isset($_POST['hospitalName'])&&
    isset($_POST['hospitalDistrict'])&&
    isset($_POST['email'])&&
    isset($_POST['treatmentType'])&&
    isset($_POST['phone'])&&
    isset($_POST['animalCategory'])&&
    isset($_POST['appointmentDate'])&&
    isset($_POST['payment'])){

        $petowner = $_POST['ptname'];
        $hospitalName = $_POST['hospitalName'];
        $hospitalDistrict = $_POST['hospitalDistrict'];
        $email = $_POST['email'];
        $treatmentType = $_POST['treatmentType'];
        $phone = $_POST['phone'];
        $animalCategory = $_POST['animalCategory'];
        $appointmentDate = $_POST['appointmentDate'];
        $payment = $_POST['payment'];
        $additionalinfo = $_POST['additionalInfo'];
   

        if(!empty($petowner)&&!empty($hospitalName)&&!empty($hospitalDistrict)&&!empty($email)&&!empty($treatmentType)&&!empty($phone)&&!empty($animalCategory)&&!empty($appointmentDate)&&!empty($payment)){

            //GENERATING SLOT NUMBER

            $queryCheck = "SELECT * FROM appointment WHERE appointmentDate = '$appointmentDate' AND Doctor_id = '$doc_id' AND Hospital_ID = $hos_id";
        
            if($queryCheck_run = mysqli_query($con,$queryCheck)){
                $query_num_rows = mysqli_num_rows($queryCheck_run);
                        
                $slotNum = $query_num_rows + 1;
            }else{
                echo "error";
            }

            //END OF GENERATING SLOT NUMBER

            if($doc_id==0){

                //FETCHING THE NUM OF SLOTS PER DAY FROM DATABASE
                $querySlots = "SELECT Num_slotsPerDay FROM hospital WHERE Hospital_id=$hos_id";
                $querySlots_run = mysqli_query($con,$querySlots);
                $row = mysqli_fetch_assoc($querySlots_run);
                $queryAvailable = $row['Num_slotsPerDay'];

                if($queryAvailable<$slotNum){
                    echo "<script type='text/javascript'>alert('No Available Slots for the date '+'$appointmentDate'+' for '+'$treatmentType'+' Please use the search to find dates with available slots');</script>";
                    echo "<script type='text/javascript'>location='singleHospital.php?Hospital_id='+$hos_id;</script>";

                }else{
                    $query = "INSERT INTO `appointment` VALUES (NULL,$hos_id,$user_id,$doc_id,'".mysqli_real_escape_string($con,$petowner)."',NULL, $slotNum ,'".mysqli_real_escape_string($con,$treatmentType)."','".mysqli_real_escape_string($con,$animalCategory)."','".mysqli_real_escape_string($con,$hospitalName)."','".mysqli_real_escape_string($con,$hospitalDistrict)."','".mysqli_real_escape_string($con,$additionalinfo)."','".mysqli_real_escape_string($con,$appointmentDate)."','".mysqli_real_escape_string($con,date('Y-m-d'))."','".mysqli_real_escape_string($con,$payment)."')";

                    if($query_run = mysqli_query($con,$query)){
                         
                        $query3="SELECT * FROM appointment ORDER BY Appoinment_Id DESC LIMIT 1";
                        if($query_run3 = mysqli_query($con,$query3)){
  
                            while ($row2 = mysqli_fetch_assoc($query_run3)){
                                $Treatment_type = $row2['Treatment_type'];
                            }
                                if(strcmp($Treatment_type,'Normal Treatment' ) !== 0){
                                    $message = "Successful";
                                   
                                    echo "<script type='text/javascript'>location='payment.php?id='+$hos_id;</script>";
                                }else {
                                    $message = "Successful";
                                    echo "<script type='text/javascript'>alert('$message');location='paymentSpecial.php?id='+$hos_id;</script>";
                                }
                                
                            }
                                        
                        
                        // echo "<script type='text/javascript'>location='singleHospital.php?Hospital_id='+$hos_id;</script>";
                        

                    }else{
                        echo "<script type='text/javascript'>alert('Error in database');</script>";
                    }
                }

            }else{

                if(isset($_POST['doctorName'])&&isset($_POST['specialistArea'])){
                    $doctorName = $_POST['doctorName'];
                    $specialistArea = $_POST['specialistArea'];

                    if(!empty($doctorName)&&!empty($specialistArea)){

                        //FETCHING THE NUM OF SLOTS PER DAY FOR DOCTOR FROM DATABASE 
                        $querySlots = "SELECT Num_slotsPerDay FROM doctor WHERE Hospital_id=$hos_id AND Doctor_id=$doc_id";
                        $querySlots_run = mysqli_query($con,$querySlots);
                        $row = mysqli_fetch_assoc($querySlots_run);
                        $queryAvailable = $row['Num_slotsPerDay'];

                        if($queryAvailable<$slotNum){
                            echo "<script type='text/javascript'>alert('No Available Slots for the date '+'$appointmentDate'+' for '+'$treatmentType'+'by Doctor '+'$doctorName'+' Please use the search to find dates with available slots');</script>";
                            echo "<script type='text/javascript'>location='singleHospital.php?Hospital_id='+$hos_id;</script>";
                            
        
                        }else{
                            $query = "INSERT INTO `appointment` VALUES (NULL,$hos_id,$user_id,$doc_id,'".mysqli_real_escape_string($con,$petowner)."','".mysqli_real_escape_string($con,$doctorName)."', $slotNum  ,'".mysqli_real_escape_string($con,$treatmentType)."','".mysqli_real_escape_string($con,$animalCategory)."','".mysqli_real_escape_string($con,$hospitalName)."','".mysqli_real_escape_string($con,$hospitalDistrict)."','".mysqli_real_escape_string($con,$additionalinfo)."','".mysqli_real_escape_string($con,$appointmentDate)."','".mysqli_real_escape_string($con,date('Y-m-d'))."','".mysqli_real_escape_string($con,$payment)."')";

                            if($query_run = mysqli_query($con,$query)){
                                if(strcmp($Treatment_type,'Normal Treatment' ) == 0){
                                    $message = "Successful";
                                   
                                    echo "<script type='text/javascript'>location='payment.php?id='+$hos_id;</script>";
                                }else {
                                    $message = "Successful";
                                    echo "<script type='text/javascript'>alert('$message');location='paymentSpecial.php?id='+$hos_id;</script>";
                                }
                       

                            }else{
                                echo "<script type='text/javascript'>alert('Error in database');</script>";
                            }
                        }

                    }else{
                        echo "<script type='text/javascript'>alert('Doctor empty');</script>";
                    }


                }else{
                    echo "<script type='text/javascript'>alert('Doctor Not set');</script>";
                }
                
            }

        }else{
            echo "<script type='text/javascript'>alert('empty');</script>";
        }

    }else{
        echo "<script type='text/javascript'>alert('Not set');</script>";
    }


}else{
    header("Location: index.php");
}

?>