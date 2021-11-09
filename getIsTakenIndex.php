<?php

require "dbBroker.php";
require "model/student.php";
// Array with indexes

$q = $_REQUEST["q"];

$indexes = Student::getAllIndexes($conn);
if ($indexes->num_rows == 0) {
    echo "";
} else {
    while ($row = $indexes->fetch_array()) {
        if($row['Indeks'] == $q){
            echo "Taken";
            die();
        }
    }
    echo "Available";
}
?>