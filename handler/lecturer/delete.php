<?php
require "../../dbBroker.php";
require "../../model/lecturer.php";

if(isset($_POST["ID"])){
    $status = Lecturer::deleteById($_POST["ID"],$conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}

?>