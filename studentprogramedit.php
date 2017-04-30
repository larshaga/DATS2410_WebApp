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
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    if (isset($_GET['year'])){
        $sqlUpdate="update Enrollment set startyear={$_GET['year']} where stID={$_GET['stID']} and progcode='{$_GET['progcode']}'";
        if ($dbconn->query($sqlUpdate)){
            echo "<p>Update was successfull!</p>";
        }else{
            echo "<p>Something went wrong. Update was not successfull.</p>";
        }
    }else{
        chooseYear($dbconn, $_GET['stID'], $_GET['progcode']);
    }

    function chooseYear($dbconn, $stID, $progcode){
        $sql="select e.stID, p.progcode, p.title from Enrollment e, Study_program p where e.stID=$stID and e.progcode=p.progcode and e.progcode='$progcode'";
        $result=$dbconn->query($sql);

        echo "<table><tr><td>Student ID</td><td>Program Code</td><td>Program Name</td><td>Year</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['stID']}</td><td>{$row['progcode']}</td><td>{$row['title']}</td>";
        }
        echo "<td><form method=\"GET\">
                <input type='number' name='year' min='1000' max='".date("Y")."' value='".date("Y")."' required>
                <input type='hidden' name='stID' value='$stID'>
                <input type='hidden' name='progcode' value='$progcode'>
                </td><td><input type='submit' value='Change'>
                </form></td></tr></table>";
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
