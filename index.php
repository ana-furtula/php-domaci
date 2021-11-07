<?php

require("dbBroker.php");
require("model/user.php");

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    $korisnik = new User(1, $uname, $upass);
    

    $response = User::logInUser($korisnik, $conn);

    if ($response->num_rows==1) {
        $_SESSION['user_id'] = $korisnik->id;
        header("Location: home.php");
        exit();
    } else {
       echo '<script> alert("Wrong username or password"); </script>';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Log in</title>

</head>

<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <input type="text" name="username" class="form-control" required placeholder="Unesite korisnicko ime...">
                    <br>
                    <input type="password" name="password" class="form-control" required placeholder="Unesite lozinku...">
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>


    </div>
</body>

</html>