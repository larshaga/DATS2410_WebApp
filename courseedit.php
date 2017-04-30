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

<div class="siteinfo">
    <?php
    ini_set('display_errors',1);
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    ob_start();
    $dbconn = new mysqli($host, $user, $pw, $db);
    if(isset($_GET['editCource']))
    {
        $courseCode = $_GET['editCource'];

        $sql = "SELECT DISTINCT title FROM Course WHERE coursecode='$courceCode'";
        $result = $dbconn->query($sql);
        if(!$result)
        {
            echo "Fail: 1";
        }
        else
        {
            while ($row = $result->fetch_assoc())
            {
                showCourse($courseCode,$row['title']);
            }
        }
    }


    function showCourse($courseCode,$title)
    {
        echo "<div class='form_div'>
            <form method='GET'>
                <input type='hidden' name='editCourse' value='$courseCode'>
                <input class='dblock' type='Text' name='title' value='$title'>
                <input class='dblock' type='submit'>
            </form>
          </div>";
    }

    function updateCourse($courseCode,$title,$dbconn)
    {
        dbconn;
        $sql2 = "UPDATE Course SET title='$title' WHERE coursecode='$courseCode'";
        if ($dbconn->query($sql2) === TRUE) {

            ob_clean();
            showCourse($courseCode,$title);
        } else {
            echo "Fail: 2";
        }
    }

    if(isset($_GET['title']) && isset($_GET['editCource']))
    {

        updateCourse($_GET['editCource'],$_GET['title']);
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
</footer>
</html>
