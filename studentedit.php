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
ini_set('display_errors',1);
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
$id = $_GET['stID'];
ob_start();
$sql = "SELECT firstname AS 'fname', lastname AS 'lname', email AS 'email' from Student WHERE studentID='$id'";
$result = $dbconn->query($sql);
if($result->num_rows >0)
{
    while ($row = $result->fetch_assoc()) {
        showStudent($row['fname'], $row['lname'], $row['email']);
    }
}
else echo "Fail: 1";
showStudent("Gustav","Berggren","test@test.com");
function showStudent($fname,$lname,$email)
{
    global $id;
    echo "<div class='form_div'>
            <form method='GET'>
                <p>ID: '$id'</p>
                <input class='dblock' type='Text' name='fname' value='$fname'>
                <input class='dblock' type='Text' name='lname' value='$lname'>
                <input class='dblock' type='Text' name='email' value='$email'>
                <input class='dblock' type='submit'>
            </form>
          </div>";
}

function updateStudent($fname,$lname,$email)
{
    global $id, $dbconn;
    $sql = "UPDATE Student SET firstname='$fname',lastname='$lname',email='$email' WHERE studentID='$id'";
    if (mysqli_query($dbconn,$sql)){
        ob_clean();
        showStudent($fname,$lname,$email);
    }else{
        echo "Fail: 2";
    }
}
if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['email']))
{
    global $firstName,$lastName,$email;
    updateStudent($_GET['fname'],$_GET['lname'],$_GET['email']);
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
