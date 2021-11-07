<?php
require "../../dbBroker.php";
require "../../model/student.php";

if(isset($_POST["idBefore"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Indeks"])){
    $student = new Student(null,$_POST["FirstName"],$_POST["LastName"],$_POST["Indeks"]);
    $status = $student->update($_POST["idBefore"], $conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}

?>