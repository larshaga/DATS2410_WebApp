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
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="siteinfo">
    <form id="selectForm" method="get">
        <select name="selectInfo">
            <option value="1">Search for student by studentnumber</option>
            <option value="2">Show every student in database</option>
            <option value="3">Add new student</option>
        </select>
        <input class="dblock" type="Submit" value="Submit">
    </form>
<!-- Could be that we should close div tag here, open php tag, ob_start(), then new div tag -->
    <?php

    echo "<form id='selectForm' method='get'>
        <select name='selectInfo'>
            <option value='1'"; isChosen(1, $_GET['selectInfo']); echo ">Search for student by studentnumber</option>
            <option value='2'"; isChosen(2, $_GET['selectInfo']); echo ">Show every student in database</option>
            <option value='3'"; isChosen(3, $_GET['selectInfo']); echo ">Add new student</option>
        </select>
        <input class='dblock' type='Submit' value='Submit'>
    </form>";

        ob_start();
        //Connection to dats04-dbproxy
        $host="10.1.1.130";
        $user="webuser";
        $pw="welcomeunclebuild";
        $db="studentinfosys";
        $dbconn = new mysqli($host, $user, $pw, $db);
        ListAll($dbconn, FALSE);
        
        function ListAll($dbconn, $clean)
        {
            if ($clean === TRUE)
            {
                ob_clean();
            }

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
            ob_clean();
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

        function Add($dbconn)
        {
            ob_clean();
            $result = $dbconn->query("SELECT * FROM Study_program");
            echo "
                <form method='GET'>
                    <p>Last name of student:</p>
                    <input name='lastname' type='text' required>
                    
                    <p>First name of student:</p>
                    <input name='firstname' type='text' required>
                    
                    <p>Email of student:</p>
                    <input name='email' type='text' required>
                    
                    <input type='submit' value='Add student'>
                </form>";

        }

        function AddNew($lastname, $firstname, $email, $dbconn)
        {
             /* Regular expressions to check if input is valid. */
            $namepattern = "[a-zA-Z]+";
            $emailpattern = "[a-zA-Z0-9]+@[a-zA-Z]+.[a-zA-Z]+";

            ob_clean();

            if (sizeof(preg_match($namepattern, $lastname)) == 1 && sizeof(preg_match($namepattern, $firstname)) == 1 && sizeof(preg_match($emailpattern, $email)) == 1)
            {
                $sql = "INSERT INTO Student(lastname, firstname, email) VALUES ('$lastname', '$firstname', '$email')";

                if ($result = $dbconn->query($sql) === TRUE)
                {
                    echo "<p>Student was successcully added.</p>";
                } else
                {
                    echo "<p>There was a problem adding the new student.</p>";
                }
                ListAll($dbconn, FALSE);
            } else
            {
                echo "<p>Invalid input. Names can only be normal characters, Email can only be on the form \"foo@bar.baz\".</p>";
            }
        }
    /*
     * Checking if you are to search for single student, or list every student
     */
    if (isset($_GET["selectInfo"]))
    {
        $info = $_GET["selectInfo"];
        if ($info=="1") Search();
        elseif ($info=="2") ListAll($dbconn, TRUE);
        else Add($dbconn);
    }

    /*
     * Check if you have submitted a studentnumber in the case of you choosing to search for student
     */
    if (isset($_GET['stID']))
    {
      SearchResult($_GET['stID'],$dbconn);
    } elseif (isset($_GET['lastname']) && isset($_GET['firstname']) && isset($_GET['email']))
    {
        AddNew($_GET['lastname'], $_GET['firstname'], $_GET['email'], $dbconn);
    }

    function isChosen($var, $const){
        if ($var===$const){
            echo "selected='selected'";
        }else{
            echo "";
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
</footer>
</html>