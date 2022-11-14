<?php


require '../database_connector.php';
 require '../functions.php';

$email = "";
$username = "";
$errors = array();
$a_id=$_GET['a_id'];


$query="SELECT * FROM `appointment` WHERE `Appoinment_Id`= $a_id";
     

if($query_run = mysqli_query($con,$query)){

 
  while ($row = mysqli_fetch_assoc($query_run)){
      
    $Petowner_name = $row['Petowner_name'];
    $Treatment_type = $row['Treatment_type'];
    $Hospital_name = $row['Hospital_name'];
    $appointmentDate = $row['appointmentDate'];
    $reservedDate = $row['reservedDate'];
    $slotno = $row['Slot_num'];
    $hos_id =$row['Hospital_Id'];
    $user_Id = $row['User_Id'];
      
  }

  $query2="SELECT * FROM `petowner` WHERE `user_id`= $user_Id";
     

  if($query_run2 = mysqli_query($con,$query2)){
  
    while ($row2 = mysqli_fetch_assoc($query_run2)){
        $sendEmail = $row2['Email'];
        
    }



    
      
        $to = $sendEmail;
        $subject = "Succefully Booked";
        
        $message = "<h1>$Petowner_name You Succefully Booked A Slot On $Hospital_name</h1> \r\n";
        $message .= "<h3>Your Reservation Detail</h1> \r\n";
        $message .= "<h4>Your Reserved Date : $reservedDate</h4> \r\n";
        $message .= "<h4>Your Appoinment Date : $appointmentDate</h4> \r\n";
        $message .= "<h4>Your Treatment Type : $Treatment_type</h4> \r\n";
        $message .= "<h4>Your Slot No : $slotno</h4> \r\n";
        $message .= "<h4>Thank You...</h4>";
        
        
        $header = "From:vethomeservice@gmail.com \r\n";
        $header .= "Cc:vethomeservice@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $retval = mail ($to,$subject,$message,$header);
        
        if( $retval == true ) {
            
            echo "<script type='text/javascript'>location='index.php';</script>";
        }else {
           
            echo "<script type='text/javascript'>location='index.php';</script>";
        }
    
                   
                   

    }
}               
       

?>