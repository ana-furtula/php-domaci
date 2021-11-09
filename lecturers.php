<?php
require("dbBroker.php");
require("model/lecturer.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$data = Lecturer::getAll($conn);

if (!$data) {
    echo ("Error while fetching data");
    die();
}

if ($data->num_rows == 0) {
    echo ("There are no lecturers!");
    die();
} else {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/lecturers.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Lecturers</title>
    </head>

    <body>
        <div w3-include-html="menu.html" id="w3"></div>
        <div style="margin-top: 2%; margin-left: 90%;">
            <div class="w3-container">
                <button id="addBtn" onclick="document.getElementById('id01').style.display='block'" style="background-color:#FAEBD7; border-radius: 8px; border-color: white"><img src="img/addUser.png"></img></button>
                <div id="id01" class="w3-modal" style="display: none;">
                    <div class="w3-modal-content" style="text-align: center;">
                        <header class="w3-container w3-teal">
                            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <h2>Add new lecturer</h2>
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
                                            <input id="JMBG" type="text" name="JMBG" class="form-control" placeholder="JMBG" value="" />
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
        <table>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>JMBG</th>
                <th></th>
            </tr>
            <?php
            while ($red = $data->fetch_array()) :

            ?>
                <tr class="ltr">
                    <td><?php echo $red["FirstName"] ?></td>
                    <td><?php echo $red["LastName"] ?></td>
                    <td><?php echo $red["JMBG"] ?></td>
                    <td style="width: 12%;">
                        <div class="w3-container">

                            <button id="updateBtn" onclick="document.getElementById('id02').style.display='block'; document.getElementById('ID').setAttribute('value','<?php echo $red["ID"] ?>');" style="background-color: #FAEBD7; border-radius: 8px; border-color: white"><img src="img/refresh.png"></img></button>
                            <button id="deleteBtn" value="<?php echo $red["ID"] ?>" onclick="deleteLecturer(this)" style="background-color: #FAEBD7; border-radius: 8px; border-color: white"><img src="img/trash.png"></img></button>

                            <div id="id02" class="w3-modal" style="display: none;">
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
                                                        <input id="ID" type="text" name="ID" class="form-control" readonly style="background-color: lightgray;" />
                                                    </div>
                                                    <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                        <input id="FirstName" type="text" name="FirstName" class="form-control" placeholder="First name" value="" />
                                                    </div>
                                                    <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                        <input id="LastName" type="text" name="LastName" class="form-control" placeholder="Last name" value="" />
                                                    </div>
                                                    <div class="form-group" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                                        <input id="JMBG" type="text" name="JMBG" class="form-control" placeholder="JMBG" value="" />
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


                    </td>
                </tr>
        <?php
            endwhile;
        }
        ?>
        </table>





        <script src="script/lecturers.js"></script>
        <script src="script/app.js"></script>
        <script>
            includeHTML();

            // var elements = document.getElementsByClassName('ltr');
            // for (var i = 0; i < elements.length; i++) {
            //     (elements)[i].addEventListener("click", function() {
            //         // alert(this.innerHTML);
            //         const checked = $(this);
            //         alert(checked.val());
            //     });
            // }
        </script>

    </body>

    </html>