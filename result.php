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

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="add.php">Add</a>
    <a class="navigation" href="retrive.php">Retrive</a>
    <b class="navigation">Update</b>
    <a class="navigation" href="delete.php">Delete</a>
</div>


<p>Result</p>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_REQUEST["selectB"])
        echo $_POST["selectB"];
    else echo "No result";
}
?>

</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    /*
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    */
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
