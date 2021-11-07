<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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


    <script src="script/app.js"></script>
    <script>
        includeHTML();
        var btnStudents = document.getElementById('btn-students');
        btnStudents.addEventListener('click', function() {
            document.location.href = "students.php";
        });
        var btnSubjects = document.getElementById('btn-subjects');
        btnSubjects.addEventListener('click', function() {
            document.location.href = "subjects.php";
        });
        var btnLecturers = document.getElementById('btn-lecturers');
        btnLecturers.addEventListener('click', function() {
            document.location.href = "lecturers.php";
        });
        var btnErs = document.getElementById('btn-ers');
        btnErs.addEventListener('click', function() {
            document.location.href = "ers.php";
        });
    </script>
</body>

</html>