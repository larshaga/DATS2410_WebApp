<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Study program</title>
</head>

<body>
<div class="title">
    <h1>Every study program in the database</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="currentpage">Study program</a>
</div>

<div class="siteinfo">
    <form id="selectForm" method="get">
        <select name="selectInfo">
            <option value="1">Search for study program by program code</option>
            <option value="2">Show every study program in database</option>
            <option value="3">Add new study program</option>
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

    EveryProgram($dbconn, FALSE);

    function EveryProgram($dbconn, $clean)
    {
        if ($clean === TRUE)
        {
            ob_clean();
        }

        $sql = "select * from Study_program";
        $result = $dbconn->query($sql);

        echo "<table class='form_div'>";
        echo "<tr><td>Program Code</td><td>Title</td><td>Show more info</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['progcode']}</td><td>{$row['title']}</td>
                <td>
                    <form action=\"studyprograminfo.php\" method=\"GET\">
                        <input type='hidden' name='progcode' value={$row['progcode']}>
                        <input type=\"submit\" value=\"Show\">
                    </form>
                </td><td>
                    <form action=\"studyprogramedit.php\" method='get'>
                        <input type='hidden' name='editProg' value={$row['progcode']}>
                        <input type='submit' value='Edit'>
                    </form>
                </td><td>
                    <form method='get'>
                        <input type='hidden' name='progcode' value={$row['progcode']}>
                        <input type='hidden' name='deleteprog' value='1'>
                        <input type='submit' value='Delete'>
                    </form>
                </td></tr>";
        }
        echo "</table>";
    }

    function AddProgram()
    {
        ob_clean();

        echo "
                <form method='GET'>
                    <p>Program code (four letters):</p>
                    <input name='progcode' type='text' maxlength='4' required>
                    
                    <p>Title of study program:</p>
                    <input name='progtitle' type='text' required>
                    
                    <input type='submit' value='Add program'>
                </form>";
    }

    function AddNewProgram($progcode, $progtitle, $dbconn)
    {
        /* Regular expressions to check if input is valid. */
        $codepattern = "/^[a-zA-Z]{4}$/";
        $titlepattern = "/^[a-zA-Z0-9 ]+$/";
        $progcode = strtoupper($progcode); //Makes sure program-code is uppercase.

        if (preg_match($codepattern, $progcode) && preg_match($titlepattern, $progtitle))
        {
            $sql = "INSERT INTO Study_program VALUES ('$progcode', '$progtitle')";

            if ($result = $dbconn->query($sql) === TRUE)
            {
                echo "<p>Program was successcully added.</p>";
            } else
            {
                echo "<p>There was a problem adding the new program.</p>";
            }
        } else
        {
            echo "<p>Invalid input. Program-code must be exactly four characters, and none of the input-fields can be null.</p>";
        }
    }

    function Search()
    {
        ob_clean();
        echo "
            <form method='GET'>
                <p>Search by study-program code:</p><br>
                <input name='searchcode' type='search'>
                <input type='submit' value='Search'>
            </form>
            ";
    }

    function SearchResultProg($id, $dbconn)
    {
        ob_clean();
        $idpattern = "/^[a-zA-Z]{4}$/";
        if (preg_match($idpattern, $id))
        {
            $sql = "SELECT * from Study_program WHERE progcode='$id' ORDER BY title";
            $result = $dbconn->query($sql);

            echo "<table class='form_div'>";
            echo "<tr><td>Program Code</td><td>Title</td><td>Show more info</td></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['progcode']}</td><td>{$row['title']}</td>
                <td>
                    <form action=\"studyprograminfo.php\" method=\"GET\">
                        <input type='hidden' name='progcode' value={$row['progcode']}>
                        <input type=\"submit\" value=\"Show\">
                    </form>
                </td><td>
                    <form method='get'>
                        <input type='hidden' name='progcode' value={$row['progcode']}>
                        <input type='hidden' name='deleteprog' value='1'>
                        <input type='submit' value='Delete'>
                    </form>
                </td></tr>";
            }
            echo "</table>";
        } else
        {
            echo "<p>Invalid search. You can only use four letters and they need to be a-z</p>";
        }
    }

    if (isset($_GET["selectInfo"]))
    {
        $info = $_GET["selectInfo"];
        if ($info=="1") Search();
        elseif ($info=="2") EveryProgram($dbconn, TRUE);
        else AddProgram();
    }

    if (isset($_GET['deleteprog'])){
        $dbconn->query("START TRANSACTION");

        $sql1 = "Delete from Enrollment where progcode='{$_GET['progcode']}';";
        if ($dbconn->query($sql1)===TRUE){
            $sql2="Delete from Study_program where progcode='{$_GET['progcode']}';";
            if ($dbconn->query($sql2)===TRUE){
                $dbconn->query("COMMIT");
                echo "<p>Succesfully deleted the study program!</p>";
            }
        }else {
            $dbconn->query("ROLLBACK");
            echo "<p>Something went wrong. The study program was not deleted.</p>";
        }
    } elseif (isset($_GET["progcode"]) && isset($_GET["progtitle"]))
    {
        AddNewProgram($_GET["progcode"], $_GET["progtitle"], $dbconn);
    } elseif (isset($_GET["searchcode"]))
    {
        SearchResultProg($_GET["searchcode"], $dbconn);
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
