<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Course</title>
</head>

<body>
<div class="title">
    <h1>Edit Course</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
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
    if(isset($_GET['editCourse']))
    {
        $courseCode = $_GET['editCourse'];
        $sql = "SELECT DISTINCT title FROM Course WHERE coursecode='$courseCode'";
        $result = $dbconn->query($sql);
        if(!$result)
        {
            echo "Failed to find selected Course in Database.";
        }
        else
        {
            while ($row = $result->fetch_assoc())
            {
                showCourse($courseCode,$row['title'],"");
            }
        }
    }

    function showCourse($courseCode,$title,$err)
    {
        echo "<div class='form_div'>
            <p>Course Code: $courseCode</p>
            <form method='GET'>
                <input type='hidden' name='editCourse' value='$courseCode'>
                <label for='title'> Title: </label>
                <input class='dblock' type='Text' name='title' value='$title'>
                <p><span class='errorField'>$err</span></p>
                <input class='dblock' type='submit' value='Save'>
            </form>
          </div>";
    }

    function updateCourse($courseCode,$title,$dbconn)
    {
        $titlepattern = "/^[a-zA-Z 0-9]+$/";
        if (!preg_match($titlepattern,$title))
        {
            ob_clean();
            showCourse($courseCode,$title,"Invalid title input");
        }
        else
        {

            $sql2 = "UPDATE Course SET title='$title' WHERE coursecode='$courseCode'";
            if ($dbconn->query($sql2) === TRUE) {

                ob_clean();
                showCourse($courseCode, $title,"");
                echo "<p>Edit successful!</p> 
                    <form action='studyprogram.php' method='get'>
                        <input type='submit' value='Back to study programs'>
                    </form>";
            } else {
                echo "<p>Failed to save changes.</p>
                    <form action='studyprogram.php' method='get'>
                        <input type='submit' value='Back to study programs'>
                    </form>";
            }
        }
    }

    if(isset($_GET['title']) && isset($_GET['editCourse']))
    {
        updateCourse($_GET['editCourse'],$_GET['title'], $dbconn);
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
