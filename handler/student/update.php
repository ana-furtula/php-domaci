<?php
require "../../dbBroker.php";
require "../../model/student.php";
require "../../model/validation.php";

if (isset($_POST["idBefore"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Indeks"])) {
    if (validateName($_POST["FirstName"]) == 1 && validateName($_POST["LastName"]) == 1) {
        $student = new Student(null, $_POST["FirstName"], $_POST["LastName"], $_POST["Indeks"]);
        $status = $student->update($_POST["idBefore"], $conn);

        if ($status) {
            echo "Success";
        } else {
            echo $status;
            echo "Failed";
        }
    } else {
        echo "Wrong";
    }
}
