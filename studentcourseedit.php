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
    if (isset($_GET['stID'])) {
        $stID = $_GET['stID'];
    }
    if (isset($_GET['coursecode'])) {
        $coursecode = $_GET['coursecode'];
    }
    if (isset($_GET['courseyear'])){
        $year=$_GET['courseyear'];
    }
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    function chooseGrade($dbconn, $stID, $coursecode, $year)
    {
        $sql = "select g.stID,g.coursecode,g.year,c.title from Grade g, Course c where g.stID=$stID and g.coursecode='$coursecode' and g.year=$year and g.coursecode=c.coursecode and g.year=c.year;";
        $result = $dbconn->query($sql);
        echo "<table><tr><td>Student ID</td><td>Course Code</td><td>Course Name</td><td>Grade</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['stID']}</td><td>{$row['coursecode']}</td><td>{$row['title']}</td>";
        }
        echo "<td><form action='studentinfo.php' id=\"selectGrade\" method=\"GET\">
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
        </td><td><input class=\"dblock\" type=\"Submit\" value=\"Submit\">
    </form></td></tr></table>";
    }

    if(isset($_GET['grade'])){
        $sqlUpdate="update Grade set grade='{$_GET['grade']}' where stID={$_GET['stID']} and coursecode='{$_GET['coursecode']}' and year={$_GET['year']};";
        if ($dbconn->query($sqlUpdate)){
            echo "<p>Update was successfull!</p>
                    <form action='studentinfo.php' method='get'>
                        <input type='hidden' name='stID' value={$_GET['stID']}>
                        <input type='submit' value='Back to student'>
                    </form>";
        }else{
            echo "<p>Something went wrong. Update was not successfull.</p>
                    <form action='studentinfo.php' method='get'>
                        <input type='hidden' name='stID' value={$_GET['stID']}>
                        <input type='submit' value='Back to student'>
                    </form>";
        }
    }else{
        chooseGrade($dbconn, $_GET['stID'], $_GET['coursecode'], $_GET['courseyear']);
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
