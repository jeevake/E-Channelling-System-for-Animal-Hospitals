<?php
    require '../database_connector.php'; //DATABASE CONNECTION

    if( isset($_POST['hospital_district'])&&isset($_POST["submit1"])){
        $hospital_district = $_POST['hospital_district'];
        header("Location: selectHospital.php?H_district=$hospital_district");
    }else{
        echo "Not Set";
    }

?>