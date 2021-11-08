<?php

class Lecturer{
    public $id;
    public $firstName;
    public $lastName;
    public $jmbg;

    public function __construct($id=null, $firstName=null, $lastName=null, $jmbg=null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->jmbg = $jmbg;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM lecturer";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM lecturer WHERE id=$id";
        return $conn->query($query);
    }

    public static function deleteById($id, mysqli $conn){
        $query = "DELETE FROM lecturer WHERE id=$id";
        return $conn->query($query);
    }

    public function update($id, mysqli $conn){
        $query = "UPDATE lecturer SET FirstName='$this->firstName', LastName = '$this->lastName', JMBG = '$this->jmbg' WHERE id='$id'";
        return $conn->query($query);
    }

    public static function add(Lecturer $lecturer, mysqli $conn){
        $query = "INSERT INTO lecturer(FirstName, LastName, JMBG) VALUES ('$lecturer->firstName', '$lecturer->lastName', '$lecturer->jmbg')";
        return $conn->query($query);
    }

}






?>