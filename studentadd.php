<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Student</title>
</head>

<body>
<div class="title">
    <h1>HiOA student information system</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="currentpage">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study Program</a>
</div>

<div class="siteinfo">
    <p>Above you can go to another site, from there you can follow your intuition</p>
</div>

<?php
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
?>

<div class="form_div">
    <form action="old_version/handleinput.php" method="GET">
        <input class="dblock" type="Text" placeholder="name" name="name">
        <input class="dblock" type="Text" placeholder="email" name="email">
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
//    $result->close();
    $dbconn->close();
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
