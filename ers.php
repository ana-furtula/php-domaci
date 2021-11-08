<?php
require("dbBroker.php");
require("model/examRegistration.php");
require("model/student.php");
require("model/subject.php");
require("model/lecturer.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$podaci = ExamRegistration::getAll($conn);

if (!$podaci) {
    echo ("Nastala je greska pri preuzimanju podataka");
    die();
}

if ($podaci->num_rows == 0) {
    echo ("Nema prijava!");
    die();
} else {


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/ers.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Students</title>
    </head>

    <body>
        <div w3-include-html="menu.html" id="w3"></div>

        <div class="body-wrap">
            <div style=" width:100%; display: inline-flex; margin-top: 2rem; background-color:rgb(211, 188, 166); padding-top: 4px; padding-bottom: 4px; text-align: center;">
                <div style="padding-right: 3rem; padding-left: 30%;">
                    <button id="btn-add" onclick="document.getElementById('id01').style.display='block'" style=" font-weight: bold; background-color: transparent; border-color: transparent;"><img src="img/plus.png"></img></button>
                </div>
                <div class="sortDiv" style="padding-right: 3rem; ">
                    <button class="btn-sort" onclick="sortTable()" style=" font-weight: bold; background-color: transparent; border-color: transparent;"><img src="img/sort.png"></img></button>
                </div>
                <div style="padding-right: 3rem; padding-top: 3px; ">
                    <label for="subjectss">Select subject:</label>
                    <select name="SubjectID" id="subjectss">
                        <option value="all">All</option>

                        <?php
                        $data = Subject::getAll($conn);
                        while ($row = $data->fetch_array()) :
                        ?>
                            <option value="<?php echo $row["ID"] ?>"><?php echo $row["Name"] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button id="btn-search" onclick="filterTable()" style="font-weight: bold; background-color: transparent; border-color: transparent;"><img src="img/zoom.png"></img></button>
                </div>
            </div>
            <table id="ers-table">
                <thead class="thead">
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Grade</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    while ($red = $podaci->fetch_array()) :

                    ?>
                        <tr">
                            <td><?php $id = $red["StudentID"];
                                $data = Student::getById($id, $conn);
                                $result = $data->fetch_array();
                                echo $result["Indeks"] ?></td>
                            <td id="<?php echo $red["SubjectID"] ?>"><?php $id = $red["SubjectID"];
                                                                    $data = Subject::getById($id, $conn);
                                                                    $result = $data->fetch_array();
                                                                    echo $result["Name"] ?></td>
                            <td><?php $id = $red["LecturerID"];
                                $data = Lecturer::getById($id, $conn);
                                $result = $data->fetch_array();
                                echo ($result["FirstName"] . " " . $result["LastName"]) ?></td>
                            <td><?php echo $red["Date"] ?></td>
                            <td><?php echo $red["Grade"] ?></td>
                            <td style="padding-left: 1rem;">
                                <button id="deleteBtn" value="<?php echo $red["ID"] ?>" onclick="deleteLecturer(this)" style="background-color: rgb(214, 198, 183); border-radius: 8px; border-color: white"><img src="img/trash.png"></img></button>
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


                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content" style="text-align: center;">
                            <header class="w3-container w3-teal">
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                <h2>Add new exam registration</h2>
                            </header>
                            <div class="w3-container">
                                <form action="#" method="post" id="addForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="Indeks" type="text" name="Indeks" class="form-control" placeholder="Indeks" value="" />
                                            </div> -->
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem; text-align: left;">
                                                <label for="students">Student:</label>
                                                <select name="StudentID" id="students">
                                                    <?php
                                                    $podaci = Student::getAll($conn);
                                                    while ($red = $podaci->fetch_array()) :
                                                    ?>

                                                        <option value="<?php echo $red["ID"] ?>"><?php echo $red["Indeks"] ?></option>

                                                    <?php endwhile; ?>
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem; text-align: left;">
                                                <label for="subjects">Subject:</label>
                                                <select name="SubjectID" id="subjects">
                                                    <?php
                                                    $podaci = Subject::getAll($conn);
                                                    while ($red = $podaci->fetch_array()) :
                                                    ?>

                                                        <option value="<?php echo $red["ID"] ?>"><?php echo $red["Name"] ?></option>

                                                    <?php endwhile; ?>
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem; text-align: left;">
                                                <label for="lecturers">Lecturer:</label>
                                                <select name="LecturerID" id="lecturers">
                                                    <?php
                                                    $podaci = Lecturer::getAll($conn);
                                                    while ($red = $podaci->fetch_array()) :
                                                    ?>

                                                        <option value="<?php echo $red["ID"] ?>"><?php echo ($red["FirstName"] . " " . $red["LastName"]) ?></option>

                                                    <?php endwhile; ?>
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem; text-align: left;">
                                                <input id="Grade" type="text" name="Grade" class="form-control" placeholder="Grade" value="" />
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

            </div>
            <div class="row">
                <div class="w3-container">

                    <div id="id02" class="w3-modal">
                        <div class="w3-modal-content" style="text-align: center;">
                            <header class="w3-container w3-teal">
                                <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                <h2>Search exam registrations by choosen subject</h2>
                            </header>
                            <div class="w3-container">
                                <form action="#" method="post" id="searchForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <input id="Indeks" type="text" name="Indeks" class="form-control" placeholder="Indeks" value="" />
                                            </div> -->

                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem; text-align: left;">
                                                <label for="subjects">Subject:</label>
                                                <select name="SubjectID" id="subjectss">
                                                    <?php
                                                    $podaci = Subject::getAll($conn);
                                                    while ($red = $podaci->fetch_array()) :
                                                    ?>

                                                        <option value="<?php echo $red["ID"] ?>"><?php echo $red["Name"] ?></option>

                                                    <?php endwhile; ?>
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                <button id="btnOK" type="submit" class="btn btn-success btn-block" style="color: white; background-color: teal; border: 1px solid white; padding: 0.5rem 3rem 0.5rem 3rem">OK
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

            </div>

        </div>

        <script src="script/app.js"></script>
        <script src="script/ers.js"></script>
        <script>
            includeHTML();
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    </body>

    </html>