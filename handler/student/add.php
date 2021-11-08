<?php
require "../../dbBroker.php";
require "../../model/student.php";

if (isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Indeks"])) {

    $student = new Student(null, $_POST["FirstName"], $_POST["LastName"], $_POST["Indeks"]);
    $status = Student::add($student, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}
