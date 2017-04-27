<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="old_version/stylesheet.css">
    <title>Dats04 - a</title>
</head>

<body>
<div class="title">
    <h1>HiOA student information system</h1>
</div>

<?php
/* Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
*/
?>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="currentpage">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study Program</a>
</div>

<div class="siteinformation">
    <p>Above you can go to another site, from there you can follow your intuition</p>
</div>

<?php


$host="10.1.1.130";
$db="studentinfosys";
$user="webuser"; $pw="welcomeunclebuild";
$dbconn = new mysqli($host, $user, $pw, $db);

if(isset($_GET['stID']))
{
    $id = $_GET['stID'];
    $sql = "SELECT * from Student WHERE studentID=".$id;
    $result = $dbconn->query($sql);

}


function showStudent($name,$email,$program)
{
    $s = "<div class='form_div'>
            <form action='old_version/handleinput.php' method='GET'>
                <input class='dblock' type='Text' name='name' value='$name'>
                <input class='dblock' type='Text' name='email' value='$email'>
            </form>
          </div>";
}



?>


</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
