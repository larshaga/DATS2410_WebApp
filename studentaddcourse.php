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
    <a class="currentpage" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>
<div class="siteinfo">
<?php
ob_start();
ini_set('display_errors',1);
$stID=$_GET['stID'];
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);

$getTitle="select coursecode, title from Course group BY title;";
$getTitlecourse = $dbconn->query($getTitle);

echo "<form id=\"selectCourse\" method=\"GET\">
        <select name=\"coursecode\">";
            while($row=$getTitlecourse->fetch_assoc()){
                echo "<option value=\"{$row['coursecode']}\" name='coursecode'>{$row['title']}</option>";
            }
        echo "</select>
        <input type='hidden' name='stID' value='$stID'>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";

function selectYear($dbconn,$stID,$coursecode){
//    ob_clean();
    $getYear="Select year from Course where coursecode='$coursecode';";
    $getYearcourse = $dbconn->query($getYear);
    $row =[];
    echo "<form id=\"selectYear\" method=\"GET\">
        <select name=\"year\">";
            while($row=$getYearcourse->fetch_assoc()){
                echo "<option value=\"{$row['year']}\" name='year'>{$row['year']}</option>";
            }
        echo "</select>
        <input type='hidden' name='coursecode' value='$coursecode'>
        <input type='hidden' name='stID' value='$stID'>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";
}

function chooseGrade($stID,$coursecode,$year){

    echo "<form id=\"selectGrade\" method=\"GET\">
        <select name=\"grade\">
            <option value='A'>A</option>
            <option value='B'>B</option>
            <option value='C'>C</option>
            <option value='D'>D</option>
            <option value='E'>E</option>
            <option value='F'>F</option>
            <option value=''>Not finished</option>
        </select>
        <input type='hidden' name='coursecode' value='$coursecode'>
        <input type='hidden' name='stID' value='$stID'>
        <input type='hidden' name='year' value='$year'>
        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form>";
}

function insertGrade($dbconn, $stID, $coursecode, $year, $grade){
    $insert="insert into Grade values ($stID,'$coursecode',$year,'$grade');";
    if ($dbconn->query($insert)===TRUE){
        echo "<p>Succesfully added the course to student $stID</p>";
    }else {
        echo "<p>Something went wrong. The course was not added to student $stID</p>";
    }
}


if (isset($_GET["coursecode"])){
    selectYear($dbconn,$_GET['stID'],$_GET['coursecode']);
}
if (isset($_GET["year"])){
    chooseGrade($_GET['stID'],$_GET['coursecode'],$_GET['year']);
}
if (isset($_GET["grade"])){
    insertGrade($dbconn, $_GET['stID'],$_GET['coursecode'],$_GET['year'],$_GET['grade']);
}

?>
</div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    $dbconn->close();
    ?>
</footer>
</html>
