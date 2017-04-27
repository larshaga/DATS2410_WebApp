<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Web</title>
</head>

<body>
<div class="title">
    <h1>Course info</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="currentpage">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="form_div">
    <?php

    $host="10.1.1.130";
    $db="studentinfosys";
    $user="webuser"; $pw="welcomeunclebuild";
    $dbconn = new mysqli($host, $user, $pw, $db);

    $sql = "SELECT * FROM Course;";
    $retult = $dbconn->query($sql);

    echo "<table class='form_div'>";
    echo "<tr><td>Course code</td><td>Year</td><td>Title</td><td>Action</td></tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr><td>{$row['coursecode']}</td><td>{$row['year']}</td><td>{$row['title']}</td>
            <td>
                <form action=\"courseinfo.php\" method=\"GET\">
                    <input type=\"submit\" value=\"Show courseinfo\">
                </form>
            </td></tr>";
    }
    echo "</table>";
    ?>
</div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
