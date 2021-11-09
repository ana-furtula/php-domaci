<?php
require "../../dbBroker.php";
require "../../model/examRegistration.php";
require "../../model/validation.php";

if (isset($_POST["SubjectID"]) && isset($_POST["StudentID"]) && isset($_POST["LecturerID"]) && isset($_POST["Grade"])) {
    if (validateGrade($_POST["Grade"]) != 1) {
        echo "Wrong grade";
    } else {
        $exists = ExamRegistration::getByStudentAndSubjectIDs($_POST["StudentID"], $_POST["SubjectID"], $conn);

        if ($exists->num_rows > 0) {
            echo "Exists";
        } else {

            $er = new ExamRegistration(null, null, $_POST["Grade"], $_POST["StudentID"], $_POST["SubjectID"], $_POST["LecturerID"]);
            $status = ExamRegistration::add($er, $conn);

            if ($status) {
                echo "Success";
            } else {
                echo "Failed";
            }
        }
    }
}
