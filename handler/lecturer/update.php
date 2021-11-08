<?php
require "../../dbBroker.php";
require "../../model/lecturer.php";

if(isset($_POST["ID"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["JMBG"])){
    $lecturer = new Lecturer(null,$_POST["FirstName"],$_POST["LastName"],$_POST["JMBG"]);
    $status = $lecturer->update($_POST["ID"], $conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}

?>