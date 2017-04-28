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
$studentInfo = array("fname"=>"", "lname"=>"", "email"=>"");
if(isset($_GET['stID']))
{
    $id = $_GET['stID'];
    $sql = "SELECT firstname AS fname, lastname AS lname, email from Student WHERE studentID=".$id;
    $result = $dbconn->query($sql);
    while ($row=$result->fetch_assoc())
    {
        showStudent($row['fname'],$row['lname'],$row['email']);
    }

}


function showStudent($fname,$lname,$email)
{
    $s = "<div class='form_div'>
            <form method='GET'>
                <input class='dblock' type='Text' name='fname' value='$fname'>
                <input class='dblock' type='Text' name='lname' value='$lname'>
                <input class='dblock' type='Text' name='email' value='$email'>
                <input class='dblock' type='submit'>
            </form>
          </div>";
}
if(isset($_GET['fname']))
{
    echo $_GET['fname'];
}
if(isset($_GET['lname']))
{
    echo $_GET['lname'];
}
if(isset($_GET['email']))
{
    echo $_GET['email'];
}



?>


</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    $result->close();
    $dbconn->close();
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
