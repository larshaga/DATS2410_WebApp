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
$stID=$_GET['stID'];
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);

$getTitle="select title from Course group BY title;";
$getTitlecourse = $dbconn->query($getTitle);

echo "<form id=\"selectForm\" method=\"get\">
        <select name=\"selectInfo\">
            $i=1;
            while($row=$getTitlecourse->fetch_assoc()){
                <option value=\"$i\">{$row['title']}</option>
                $i++;
            }
        </select>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";
?>


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
