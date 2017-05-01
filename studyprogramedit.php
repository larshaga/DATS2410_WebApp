<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Study program</title>
</head>

<body>
<div class="title">
    <h1>Edit Study program</h1>
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
    if(isset($_GET['editProg']))
    {
        $progCode = $_GET['editProg'];
        $sql = "SELECT DISTINCT title FROM Study_program WHERE progcode='$progCode'";
        $result = $dbconn->query($sql);
        if(!$result)
        {
            echo "Failed to find selected program in the database";
        }
        else
        {
            while ($row = $result->fetch_assoc())
            {
                showProgram($progCode,$row['title'],"");
            }
        }
    }

    function showProgram($progCode,$title,$err)
    {
        echo "<div class='form_div'>
            <p>Program Code: $progCode</p>
            <form method='GET'>
                <input type='hidden' name='editProg' value='$progCode'>
                <label for='title'> Title: </label>
                <input class='dblock' type='Text' name='title' value='$title'>
                <p><span class='errorField'>$err</span></p>
                <input class='dblock' type='submit' value='Save'>
            </form>
          </div>";
    }

    function updateProgram($progCode,$title,$dbconn)
    {
        $titlepattern = "/^[a-zA-Z 0-9]+^$/";
        if (!preg_match($title,$titlepattern))
        {
            ob_clean();
            showProgram($progCode,$title,"Invalid title input");
        }
        else
            {
            $sql2 = "UPDATE Study_program SET title='$title' WHERE progcode='$progCode'";
            if ($dbconn->query($sql2) === TRUE)
            {

                ob_clean();
                showProgram($progCode, $title,"");
                echo "<p>Edit successfull!</p>
                    <form action='studyprogram.php' method='get'>
                        <input type='submit' value='Back to study programs'>
                    </form>";
            }
            else
            {
                echo "<p>Failed to save changes</p>
                    <form action='studyprogram.php' method='get'>
                        <input type='submit' value='Back to study programs'>
                    </form>";
            }
        }
    }

    if(isset($_GET['title']) && isset($_GET['editProg']))
    {
        updateProgram($_GET['editProg'],$_GET['title'], $dbconn);
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
