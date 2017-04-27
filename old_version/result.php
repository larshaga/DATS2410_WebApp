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
ob_start();
/*
// Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
*/
?>

<div>
    <a class="navigation" href="../index.php">Home</a>
    <a class="navigation" href="add.php">Add</a>
    <a class="navigation" href="retrieve.php">Retrieve</a>
    <b class="navigation">Update</b>
    <a class="navigation" href="delete.php">Delete</a>
</div>


<p>Result</p>


<?php

if (!isset($_GET['search']))
{
    echo "<p>No result</p>";
}
else
{
    echo "<p>Success!</p>";
}
?>

</body>

<footer class="bottomofpage">
    <?php
    //echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    //echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
