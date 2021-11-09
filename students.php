<?php
require("dbBroker.php");
require("model/student.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$podaci = Student::getAll($conn);

if (!$podaci) {
    echo ("Nastala je greska pri preuzimanju podataka");
    die();
}

if ($podaci->num_rows == 0) {
    echo ("Nema studenata!");
    die();
} else {


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/students.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Students</title>
    </head>

    <body>
        <div w3-include-html="menu.html" id="w3"></div>
        <div>
            <img src="img/students2.jpg"></img>
        </div>
        <div class="body-wrap">
            <table id="students-table">
                <thead class="thead">
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    while ($red = $podaci->fetch_array()) :

                    ?>
                        <tr">
                            <td><?php echo $red["Indeks"] ?></td>
                            <td><?php echo $red["FirstName"] ?></td>
                            <td><?php echo $red["LastName"] ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $red["ID"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            </tr>
                    <?php
                    endwhile;
                }
                    ?>
                </tbody>
            </table>
            <div class="row">

                <div class="w3-container">

                    <button id="btn-add" onclick="document.getElementById('id01').style.display='block'" style="font-weight: bold;">ADD NEW</button>

                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content" style="text-align: center;">
                            <header class="w3-container w3-teal">
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                <h2>Add new student</h2>
                            </header>
                            <div class="w3-container">
                                <form action="#" method="post" id="addForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="FirstName" type="text" name="FirstName" class="form-control" placeholder="First name" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="LastName" type="text" name="LastName" class="form-control" placeholder="Last name" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="Indeks" type="text" name="Indeks" class="form-control" placeholder="Index" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <button id="btnSave" type="submit" class="btn btn-success btn-block" style="color: white; background-color: teal; border: 1px solid white; padding: 0.5rem 3rem 0.5rem 3rem">Save
                                                </button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- <button id="btn-update" onclick="updateStudent()">Update</button> -->
                <div class="w3-container">

                    <button id="btn-update" onclick="document.getElementById('id02').style.display='block'" style="font-weight: bold;">UPDATE</button>

                    <div id="id02" class="w3-modal">
                        <div class="w3-modal-content" style="text-align: center;">
                            <header class="w3-container w3-teal">
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                <h2>Enter new data</h2>
                            </header>
                            <div class="w3-container">
                                <form action="#" method="post" id="updateForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="FirstName" type="text" name="FirstName" class="form-control" placeholder="First name" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="LastName" type="text" name="LastName" class="form-control" placeholder="Last name" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="Indeks" type="text" name="Indeks" class="form-control" placeholder="Index" value="" />
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <button id="btnUpdate" type="submit" class="btn btn-success btn-block" style="color: white; background-color: teal; border: 1px solid white; padding: 0.5rem 3rem 0.5rem 3rem">Submit
                                                </button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <button id="btn-delete" onclick="deleteStudent()" style="font-weight: bold;">DELETE</button>

                <button id="btn-sort" onclick="sortTable()" style="font-weight: bold;">SORT</button>

            </div>

        </div>

            <script src="script/app.js"></script>
            <script src="script/students.js"></script>
            <script>
                includeHTML();
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    </body>

    </html>