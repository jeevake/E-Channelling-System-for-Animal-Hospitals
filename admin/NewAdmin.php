<?php

    require '../database_connector.php';
    require '../functions.php';

    if( isset($_POST['name'])&&
        isset($_POST['password'])&&
        isset($_POST['password_again'])){
            $name =  $_POST['name'];
            $password =  $_POST['password'];
            $password_again =  $_POST['password_again'];
            
        

        /*--- ENCRYPTING THE PASSWORD ---*/
        $password_hash = md5($password);
       
       
       

        if(!empty($name)&&!empty($password)&&!empty($password_again)){
    
                if ($password!=$password_again){
                    echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
                
                }else{

                 $query = "SELECT `Username` FROM `login_admin` WHERE `Username`='$name'";
                    $query_run = mysqli_query($con,$query);

                    if (mysqli_num_rows($query_run)!==1){
                        $query2 = "INSERT INTO login_admin (Username, Password) values('$name','$password_hash')";
                       
                        
                       
                        $query_run = mysqli_query($con,$query2);
                        echo "<script type='text/javascript'>alert('Succesfully Add Admin');location='AddAdmin.php';</script>";
                        
                    }else{
                        echo "<script type='text/javascript'>alert('Username Already Exist');</script>";
                        
                      
                    }
                }
            }

        }else{
            echo "<script type='text/javascript'>alert('All fields are required');</script>";
          
        }


?>