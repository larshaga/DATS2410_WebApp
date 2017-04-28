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

    $coursecode=$_GET['coursecode'];
    $year=$_GET['year'];

    $sql = "SELECT s.stID, Concat(s.lastname,', ', s.firstname) as name, g.grade FROM Student s, Grade g where g.year=$year and g.coursecode='$coursecode' Order by name asc;";
    $result = $dbconn->query($sql);

    echo "<table class='form_div'>";
    echo "<tr><td>StudentID</td><td>Name</td><td>Grade</td><td>Student info</td></tr>";
    if (empty($result)){

    }else{

    while ($row = $result->fetch_assoc())
    {
        echo "<tr><td>{$row['stID']}</td><td>{$row['name']}</td><td>{$row['grade']}</td>
            <td>
                <form action=\"studentinfo.php\" method=\"GET\">
                    <input type='hidden' name='stID' value={$row['stID']}>
                    <input type=\"submit\" value=\"Show\">
                </form>
            </td></tr>";
    }
    echo "</table>";
    }
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
