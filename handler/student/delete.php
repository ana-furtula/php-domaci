<?php
require "../../dbBroker.php";
require "../../model/student.php";

if(isset($_POST["ID"])){
    $status = Student::deleteById($_POST["ID"],$conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}

?>