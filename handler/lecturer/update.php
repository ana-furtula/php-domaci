<?php
require "../../dbBroker.php";
require "../../model/lecturer.php";
require "../../model/validation.php";


if (isset($_POST["ID"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["JMBG"])) {
    if (validateName($_POST["FirstName"]) == 1 && validateName($_POST["LastName"]) == 1 && validateJMBG($_POST["JMBG"]) == 1) {
        $lecturer = new Lecturer(null, $_POST["FirstName"], $_POST["LastName"], $_POST["JMBG"]);
        $status = $lecturer->update($_POST["ID"], $conn);

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
?>