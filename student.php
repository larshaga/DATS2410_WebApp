<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Student</title>
</head>

<body>
<div class="title">
    <h1>Every student in the database</h1>
</div>

<div>
    <?php
    $host="10.1.1.130";
    $db="studentinfosys";
    $user="webuser"; $pw="welcomeunclebuild";
    $dbconn = new mysqli($host, $user, $pw, $db);

    $sql = "SELECT stID AS 'Student number', CONCAT(lastname, ', ', firstname) as Name, email as 'Email' from Student ORDER BY Name";
    $result = $dbconn->query($sql);

    echo "<table>";
    echo "<tr><td>Student number</td><td>Name</td><td>Email</td><td>Action</td></tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr><td>{$row['Student number']}</td><td>{$row['Name']}</td><td>{$row['Email']}</td>
            <td>
                <form action=\"studentinfo.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"stID\" value={$row['Student number']}>
                    <input type=\"submit\" value=\"Show Studentpage\">
                </form>
            </td></tr>";
    }
    echo "</table>";
    ?>
</div>

<div>
    <b class="navigation" href="index.php">Home</b>
    <a class="navigation">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study Program</a>
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