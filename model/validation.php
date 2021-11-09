<?php
function validateName($name)
{
    $pattern = "/[A-Z]+[a-z]+/";
    return preg_match($pattern, $name);
}

function validateIndex($index)
{
    $pattern = "/[0-9]{4}\/[0-9]{4}/";
    return preg_match($pattern, $index);
}

function validateJMBG($jmbg)
{
    $pattern = "/[0-9]{13}/";
    return preg_match($pattern, $jmbg);
}

function validateGrade($grade)
{
   if($grade>=5 && $grade<=10){
       return true;
   }
   return false;
}