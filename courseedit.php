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
    if(isset($_GET['editCource']))
    {
        $id = $_GET['editCource'];

        $sql = "\"SELECT title, year from Course WHERE coursecode='$courceCode'";
        $result = $dbconn->query($sql);
        if(!$result)
        {
            echo "Fail: 1";
        }
        else
        {
            while ($row = $result->fetch_assoc())
            {
                //TODO: Method call
            }
        }
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
