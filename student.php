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
    <a class="navigation" href="index.php">Home</a>
    <a class="currentpage">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study Program</a>
</div>

<div>

    <form id="selectForm" method="get">
        <select name="selectInfo">
            <option value="1">Search for student by studentnumber</option>
            <option value="2">Show every student in database</option>
        </select>
        <input class="dblock" type="Submit" value="Submit">
    </form>
<!-- Could be that we should close div tag here, open php tag, ob_start(), then new div tag -->
    <?php
    ob_start();

    $host="10.1.1.130";
    $db="studentinfosys";
    $user="webuser"; $pw="welcomeunclebuild";
    $dbconn = new mysqli($host, $user, $pw, $db);

    function ListAll($dbconn)
    {
        ob_clean();
        $sql = "SELECT stID AS 'Student number', CONCAT(lastname, ', ', firstname) as Name, email as 'Email' from Student ORDER BY Name";
        $result = $dbconn->query($sql);

        echo "<table class='form_div'>";
        echo "<tr><td>Student number</td><td>Name</td><td>Email</td><td>Action</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['Student number']}</td><td>{$row['Name']}</td><td>{$row['Email']}</td>
            <td>
                <form action=\"studentinfo.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"stID\" value={$row['Student number']}>
                    <input type=\"submit\" value=\"Show Studentpage\">
                </form>
            </td></tr>";
        }
        echo "</table>";
    }

    function Search()
    {
        ob_clean();
        echo "
            <form method='GET'>
                <p>Search by student number:</p><br>
                <input name='stID' type='search'>
                <input type='submit' value='Search'>
            </form>
        ";
    }
    
    function SearchResult($id, $dbconn)
    {
        $sql = "SELECT stID AS 'Student number', CONCAT(lastname, ', ', firstname) as Name, email as 'Email' from Student WHERE stID='$id' ORDER BY Name";
        $result = $dbconn->query($sql);

        echo "<table class='form_div'>";
        echo "<tr><td>Student number</td><td>Name</td><td>Email</td><td>Action</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['Student number']}</td><td>{$row['Name']}</td><td>{$row['Email']}</td>
            <td>
                <form action=\"studentinfo.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"stID\" value={$row['Student number']}>
                    <input type=\"submit\" value=\"Show Studentpage\">
                </form>
            </td></tr>";
        }
        echo "</table>";
    }

    /*
     * Checking if you are to search for single student, or list every student
     */
    if (isset($_GET["selectInfo"]))
    {
        $info = $_GET["selectInfo"];
        if ($info=="1") Search();
        else ListAll($dbconn);
    }

    /*
     * Check if you have submitted a studentnumber in the case of you choosing to search for student
     */
    if (isset($_GET['stID']))
    {
      SearchResult($_GET['stID'],$dbconn);
    }

    $result->close();
    $dbconn->close();
    ?>
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