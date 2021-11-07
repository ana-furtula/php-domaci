<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/home.css">

    <title>Home page</title>
</head>

<body>
    <div w3-include-html="menu.html" id="w3"></div>
    <div class="main-div">
        <button id="btn-students" value="students">STUDENTS</button>
        <br>
        <button id="btn-lecturers" value="lecturers">LECTURERS</button>
        <br>
        <button id="btn-subjects" value="subjects">SUBJECTS</button>
        <br>
        <button id="btn-ers" value="examRegistrations">EXAM REGISTRATIONS</button>
    </div>


    <script src="app.js"></script>
    <script>
        includeHTML();
    </script>
</body>

</html>

