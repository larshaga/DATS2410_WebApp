<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Study program</title>
</head>

<body>
<div class="title">
    <h1>Every study program in the database</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="currentpage">Study program</a>
</div>

<?php
  //Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);

if (isset($_GET['deleteprog'])){ //TODO:fix transaction with rollback?
    $sql = "Delete from Enrollment where progcode='{$_GET['progcode']}';";
    if ($dbconn->query($sql1)===TRUE){
        $sql2="Delete from Study_program where progcode='{$_GET['progcode']}';";
        if ($dbconn->query($sql2)===TRUE){
            echo "<p>Succesfully deleted the study program!</p>";
        }
    }else {
        echo "<p>Something went wrong. The study program was not deleted.</p>";
    }
}


$sql="select * from Study_program";
$result=$dbconn->query($sql);

echo "<table class='form_div'>";
echo "<tr><td>Program Code</td><td>Title</td><td>Show more info</td></tr>";
while ($row = $result->fetch_assoc())
{
    echo "<tr><td>{$row['progcode']}</td><td>{$row['title']}</td>
            <td>
                <form action=\"studyprograminfo.php\" method=\"GET\">
                    <input type='hidden' name='progcode' value={$row['progcode']}>
                    <input type=\"submit\" value=\"Show\">
                </form>
            </td><td>
                <form method='get'>
                    <input type='hidden' name='progcode' value={$row['progcode']}>
                    <input type='hidden' name='deleteprog' value='1'>
                    <input type='submit' value='Delete'>
                </form>
            </td></tr>";
}
echo "</table>";


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
