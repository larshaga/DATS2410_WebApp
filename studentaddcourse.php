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
ob_start();
$stID=$_GET['stID'];
$coursecode;
$grade;
$year;
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);

$getTitle="select coursecode, title from Course group BY title;";
$getTitlecourse = $dbconn->query($getTitle);

echo "<form id=\"selectCourse\" method=\"GET\">
        <select name=\"selectCourse\">
            while($row=$getTitlecourse->fetch_assoc()){
                <option value=\"{$row['coursecode']}\">{$row['title']}</option>
            }
        </select>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";

function selectYear($dbconn){
//    ob_clean();
    global $coursecode;
    $getYear="Select year from Course where coursecode=$coursecode;";
    $getYearcourse = $dbconn->query($getYear);

    $row =[];
    echo "<form id=\"selectYear\" method=\"GET\">
        <select name=\"selectYear\">
            while($row=$getYearcourse->fetch_assoc()){
                <option value=\"{$row['year']}\">{$row['year']}</option>
            }
        </select>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";
}

function chooseGrade(){

    echo "<form id=\"selectGrade\" method=\"GET\">
        <select name=\"selectGrade\">
            <option value='A'>A</option>
            <option value='B'>B</option>
            <option value='C'>C</option>
            <option value='D'>D</option>
            <option value='E'>E</option>
            <option value='F'>F</option>
            <option value=''>Not finished</option>
        </select>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";
}

function insertGrade($dbconn){
    global $stID,$coursecode, $year, $grade;
    $insert="insert into Grade VALUES ($stID, $coursecode, $year, $grade)";
    $dbconn->query($insert);
}


if (isset($_GET["selectCourse"]))
{
    $coursecode = $_GET["selectCourse"];
    selectYear($dbconn);
}
if (isset($_GET["selectYear"])){
    global $year;
    $year=$_GET["selectYear"];
    chooseGrade();
}
if (isset($_GET["selectGrade"])){
    $grade=$_GET["selectGrade"];
    insertGrade($dbconn);
}

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
