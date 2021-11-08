<?php

class Student{
    public $id;
    public $firstName;
    public $lastName;
    public $indeks;

    public function __construct($id=null, $firstName=null, $lastName=null, $indeks=null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->indeks = $indeks;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM student";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM student WHERE id=$id";
        return $conn->query($query);
    }

    public static function deleteById($id, mysqli $conn){
        $query = "DELETE FROM student WHERE id=$id";
        return $conn->query($query);
    }

    public function update($id, mysqli $conn){
        $query = "UPDATE student SET FirstName='$this->firstName', LastName = '$this->lastName', Indeks = '$this->indeks' WHERE id='$id'";
        return $conn->query($query);
    }

    public static function add(Student $student, mysqli $conn){
        $query = "INSERT INTO student(FirstName, LastName, Indeks) VALUES ('$student->firstName', '$student->lastName', '$student->indeks')";
        return $conn->query($query);
    }

}

?>