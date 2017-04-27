<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="old_version/stylesheet.css">
    <title>Dats04 - Web</title>
</head>

<body>
<div class="title">
    <h1>HiOA student information system</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study Program</a>
</div>

<div class="siteinformation">
    <p>Student info:</p>
    <a class="goBack" href="student.php">Back</a>

</div>
<div class="editdelete">

</div>

<div>
    <?php

    $stID=$_GET['stID'];
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    $sql = "select s.stID, concat(s.lastname,', ',s.firstname) as name, s.email from Student s where s.stID=$stID";
    $result = $dbconn->query($sql);

    echo "<table border='1'>";
    echo "<tr><td>StudentID</td><td>Name</td><td>E-mail</td></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['stID']}</td><td>{$row['name']}</td> <td>{$row['email']}</td></tr>";
    }
    echo "</table>";

        $sql = "select p.title, e.startyear as 'Start Year' from Student s, Enrollment e, Study_program p where s.stID=e.stID and e.progcode=p.progcode and s.stID=$stID";
        $result = $dbconn->query($sql);

    echo "<table border='1'>";
    echo "<tr><td>Study Program</td><td>Enrolled (Year)</td><tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['title']}</td><td>{$row['Start Year']}</td></tr>";
    }
    echo "</table>";

    $sql = "select c.title as 'Course name', g.year, g.grade from Student s, Grade g, Course c where s.stID=g.stID and g.coursecode=c.coursecode and g.year=c.year and s.stID=$stID";
    $result = $dbconn->query($sql);

    echo "<table border='1'>";
    echo "<tr><td>Course Name</td><td>Year</td><td>Grade</td></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['Course name']}</td><td>{$row['year']}</td> <td>{$row['grade']}</td></tr>";
    }
    echo "</table>";

    $result->close();
    $dbconn->close();
    ?>
</div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
//    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
