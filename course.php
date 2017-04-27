<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Web</title>
</head>

<body>
<div class="title">
    <h1>HiOA student information system</h1>
</div>

<?php
/*
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
*/
?>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="currentpage">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="siteinformation">
    <p>What to you want to retrive about course?</p>
</div>

<div class="form_div">
    <form id="selectForm" method="get">
        <select name="course">
            <option value="1">Show all courses</option>
            <option value="2">Update a course</option>
            <option value="3">Delete a course</option>
            <option value="4"></option>
        </select>
    </form>
    <input class="dblock" type="submit">
    <?php
        function showAllCourses()
        {

        }

        function updateCourse()
        {

        }

        function deleteCourse()
        {

        }

        function testing()
        {

        }


    ?>
</div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
