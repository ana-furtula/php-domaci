<?php
require "../../dbBroker.php";
require "../../model/examRegistration.php";

if(isset($_POST["SubjectID"]) && isset($_POST["StudentID"]) && isset($_POST["LecturerID"]) && isset($_POST["Grade"])){
    $er = new ExamRegistration(null, null, $_POST["Grade"], $_POST["StudentID"], $_POST["SubjectID"],$_POST["LecturerID"]);
    $status = ExamRegistration::add($er, $conn);

    if($status){
        echo "Success";
    } else{
        echo $status;
        echo "Failed";
    }
}
?>