<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Course</title>
</head>

<body>
<div class="title">
    <h1>Every course in the database</h1>
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

    if (isset($_GET['deletecourse'])){
        $dbconn->query("START TRANSACTION");

        $sql = "Delete from Grade where coursecode='{$_GET['coursecode']}' and year='{$_GET['year']}';";
        if ($dbconn->query($sql1)===TRUE){
            $sql2="Delete from Course where coursecode='{$_GET['coursecode']}' and year='{$_GET['year']}';";
            if ($dbconn->query($sql2)===TRUE){
                if ($dbconn->query("COMMIT")){
                    echo "<p>Succesfully deleted the course!</p>";
                }
            }
        }else {
            $dbconn->query("ROLLBACK");
            echo "<p>Something went wrong. The course was not deleted.</p>";
        }
    }


    $sql = "SELECT * from Course ORDER BY year DESC";
    $result = $dbconn->query($sql);

    echo "<table class='form_div'>";
    echo "<tr><td>Course code</td><td>Year</td><td>Title</td><td>Action</td></tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr><td>{$row['coursecode']}</td><td>{$row['year']}</td><td>{$row['title']}</td>
            <td>
                <form action=\"courseinfo.php\" method=\"GET\">
                    <input type='hidden' name='coursecode' value={$row['coursecode']}>
                    <input type='hidden' name='year' value={$row['year']}>
                    <input type=\"submit\" value=\"Show courseinfo\">
                </form></td>
                <td><form action=\"courseedit.php\" method=\"GET\">
                    <input type='hidden' name='editCourse' value={$row['coursecode']}>
                    <input type='submit' value=\"Edit\">                
                </form>
            </td><td><form method=\"GET\">
                    <input type='hidden' name='deletecourse' value='1'>
                    <input type='hidden' name='coursecode' value={$row['coursecode']}>
                    <input type='hidden' name='year' value={$_GET['year']}>
                    <input type='submit' value=\"Delete\">                
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
