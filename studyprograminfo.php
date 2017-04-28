<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Course</title>
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
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    $progcode=$_GET['progcode'];

    $sql = " select s.stID, concat(s.lastname,', ',s.firstname) as name, p.title, e.startyear from Student s, Enrollment e, Study_program p where p.progcode='$progcode';";
    $result = $dbconn->query($sql);

    echo "<table class='form_div'>";
    echo "<tr><td>StudentID</td><td>Name</td><td>Title</td><td>Year</td><td>Show more info</td></tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr><td>{$row['stID']}</td><td>{$row['name']}</td><td>{$row['title']}</td><td>{$row['startyear']}</td>
            <td>
                <form action=\"studentinfo.php\" method=\"GET\">
                    <input type='hidden' name='stID' value={$row['stID']}>
                    <input type=\"submit\" value=\"Show\">
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
    $result->close();
    $dbconn->close();
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
