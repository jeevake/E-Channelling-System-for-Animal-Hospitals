<?php

    function inputFields($placeholder,$name,$value,$type){
        $ele = "
            <input type = '$type' name = '$name' placeholder = '$placeholder' value = '$value'> 
        ";
        echo $ele;
    }


?>