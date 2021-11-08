<?php
require "../../dbBroker.php";
require "../../model/examRegistration.php";

if(isset($_POST["ID"])){
    $status = ExamRegistration::deleteById($_POST["ID"],$conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}

?>