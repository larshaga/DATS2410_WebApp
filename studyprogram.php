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
    <a class="currentpage">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="siteinformation">
    <p>Study program</p>
</div>

<div class="form_div">
    <form action="old_version/handleinput.php" method="GET">
        <input class="dblock" type="Text" placeholder="1" name="fname">
        <input class="dblock" type="Text" placeholder="2" name="lname">
        <!--<input class="dblock" type="Text" placeholder="3" >
        <input class="dblock" type="Text" placeholder="4" > -->
        <input class="dblock" type="Submit" value="BOOM">
        <!-- Add aditional fields here
        -->
    </form>
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
