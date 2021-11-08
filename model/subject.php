<?php

class Subject{
    public $id;
    public $name;
    public $semester;
    public $espb;

    public function __construct($id=null, $name=null, $semester=null, $espb=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->semester = $semester;
        $this->espb = $espb;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM subject";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM subject WHERE id=$id";
        return $conn->query($query);
    }

    public static function deleteById($id, mysqli $conn){
        $query = "DELETE FROM subject WHERE id=$id";
        return $conn->query($query);
    }

    public function update($id, mysqli $conn){
        $query = "UPDATE subject SET Name='$this->name', Semester = '$this->semester', ESPB = '$this->espb' WHERE id='$id'";
        return $conn->query($query);
    }

    public static function add(Subject $subject, mysqli $conn){
        $query = "INSERT INTO subject(Name, Semester, ESPB) VALUES ('$subject->name', '$subject->semester', '$subject->espb')";
        return $conn->query($query);
    }

}






?>