<?php
require "../../dbBroker.php";
require "../../model/student.php";
require "../../model/validation.php";

if (isset($_POST["idBefore"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"])) {
    if (validateName($_POST["FirstName"]) == 1 && validateName($_POST["LastName"]) == 1) {
        $index = (Student::getIndexById($_POST["idBefore"],$conn))->fetch_array();
        $student = new Student(null, $_POST["FirstName"], $_POST["LastName"], $index["Indeks"]);
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
