<?php
require("dbBroker.php");
require("model/subject.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$podaci = Subject::getAll($conn);

if (!$podaci) {
    echo ("Error while fetching data");
    die();
}

if ($podaci->num_rows == 0) {
    echo ("There are no subjects!");
    die();
} else {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/subjects.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Subjects</title>
    </head>

    <body>
        <div w3-include-html="menu.html" id="w3"></div>
        <table id="subjects-table">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">ESPB</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <?php
                while ($red = $podaci->fetch_array()) :

                ?>
                    <tr>
                        <td><?php echo $red["ID"] ?></td>
                        <td><?php echo $red["Name"] ?></td>
                        <td><?php echo $red["Semester"] ?></td>
                        <td><?php echo $red["ESPB"] ?></td>
                    </tr>
            <?php
                endwhile;
            }
            ?>
            </tbody>
        </table>

        <script src="script/app.js"></script>
        <script>
            includeHTML();
        </script>
    </body>

    </html>