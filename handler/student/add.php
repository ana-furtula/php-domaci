<?php
require "../../dbBroker.php";
require "../../model/student.php";
require "../../model/validation.php";

if (isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Indeks"])) {
    if (validateName($_POST["FirstName"]) == 1 && validateName($_POST["LastName"]) == 1 && validateIndex($_POST["Indeks"]) == 1) {
        $student = new Student(null, $_POST["FirstName"], $_POST["LastName"], $_POST["Indeks"]);
        $status = Student::add($student, $conn);

        if ($status) {
            echo "Success";
        } else {
            echo "Failed";
        }
    } else {
        echo "Wrong";
    }
}
