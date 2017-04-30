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
    <form id="selectForm" method="get">
        <select name="selectInfo">
            <option value="1">Search for course by coursecode</option>
            <option value="2">Show every course in database</option>
            <option value="3">Add new course</option>
        </select>
        <input class="dblock" type="Submit" value="Submit">
    </form>

    <?php
    ob_start();

    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    EveryCourse($dbconn); //As a standard show every course, but when something else is chosen, it disappears.

    function EveryCourse($dbconn)
    {
        ob_clean();

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
                        <input type='hidden' name='coursetitle' value={$row['title']}>
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
                        <input type='hidden' name='year' value={$row['year']}>
                        <input type='submit' value=\"Delete\">                
                    </form>
                </td></tr>";
        }
        echo "</table>";
    }

    function AddCourse()
    {
        ob_clean();

        echo "
                <form method='GET'>
                    <p>Course code (four letteres):</p>
                    <input name='coursecode' type='text' maxlength='4' required>
                    
                    <p>What year is this course run:</p>
                    <input name='courseyear' type='number' min='1000' max='".date("Y")."' required>
                    
                    <p>Title of course:</p>
                    <input name='coursetitle' type='text' required>
                    
                    <input type='submit' value='Add course'>
                </form>";
    }

    function AddNewCourse($coursecode, $courseyear, $coursetitle, $dbconn)
    {
        /* Regular expressions to check if input is valid. */
        $codepattern = "[a-zA-Z]{4}";
        $titlepattern = "[a-zA-Z]+";
        $yearpattern = "[1-2][0-9]{3}";
        $coursecode = strtoupper($coursecode); //Makes sure course-code is uppercase.

        if (sizeof(preg_match($codepattern, $coursecode)) == 1 && sizeof(preg_match($titlepattern, $coursetitle)) == 1 && sizeof(preg_match($yearpattern, $courseyear)) == 1)
        {
            $sql = "INSERT INTO Course VALUES ('$coursecode', '$courseyear', '$coursetitle')";

            if ($result = $dbconn->query($sql) === TRUE)
            {
                echo "<p>Course was successcully added.</p>";
            } else
            {
                echo "<p>There was a problem adding the new course.</p>";
            }
        } else
        {
            echo "<p>Invalid input. Course code must be exactly four characters, year must be valid, and none of the input-fields can be null.</p>";
        }
    }

    function Search()
    {
        ob_clean();
        echo "
            <form method='GET'>
                <p>Search by course code:</p><br>
                <input name='searchcode' type='search'>
                <input type='submit' value='Search'>
            </form>
            ";
    }

    function SearchResult($id, $dbconn)
    {
        ob_clean();
        $sql = "SELECT * from Course WHERE coursecode='$id' ORDER BY year DESC";
        $result = $dbconn->query($sql);

        echo "<table class='form_div'>";
        echo "<tr><td>Course code</td><td>Year</td><td>Title</td><td>Action</td></tr>";
        while ($row = $result->fetch_assoc())
        {
            echo "<tr><td>{$row['coursecode']}</td><td>{$row['year']}</td><td>{$row['title']}</td>
                <td>
                    <form action=\"courseinfo.php\" method=\"GET\">
                        <input type='hidden' name='coursecode' value={$row['coursecode']}>
                        <input type='hidden' name='coursetitle' value={$row['title']}>
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
                        <input type='hidden' name='year' value={$row['year']}>
                        <input type='submit' value=\"Delete\">                
                    </form>
                </td></tr>";
        }
        echo "</table>";
    }

    if (isset($_GET["selectInfo"]))
    {
        $info = $_GET["selectInfo"];
        if ($info=="1") Search();
        elseif ($info=="2") EveryCourse($dbconn);
        else AddCourse();
    }

    if (isset($_GET['deletecourse'])){
        ob_clean();

        $dbconn->query("START TRANSACTION");

        $sql1 = "Delete from Grade where coursecode='{$_GET['coursecode']}' and year={$_GET['year']};";
        if ($dbconn->query($sql1)===TRUE){
            echo "Kom meg forbi første delete.";
            $sql2="Delete from Course where coursecode='{$_GET['coursecode']}' and year={$_GET['year']};";
            if ($dbconn->query($sql2)===TRUE){
                $dbconn->query("COMMIT");
                echo "<p>Succesfully deleted the course!</p>";
            }
        }else {
            $dbconn->query("ROLLBACK");
            echo "<p>Something went wrong. The course was not deleted.</p>";
        }
    } elseif (isset($_GET["coursecode"]) && isset($_GET["courseyear"]) && isset($_GET["coursetitle"]))
    {
        AddNewCourse($_GET["coursecode"], $_GET["courseyear"], $_GET["coursetitle"], $dbconn);
    } elseif (isset($_GET["searchcode"]))
    {
        SearchResult($_GET["searchcode"], $dbconn);
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
