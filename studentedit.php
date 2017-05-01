<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>DATS04 - Student</title>
    <meta charset="UTF-8">
</head>

<body>
<div class="title">
    <h1>Edit Student</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="siteinfo"
<?php
//Connection to dats04-dbproxy
$host="10.1.1.130";
$user="webuser";
$pw="welcomeunclebuild";
$db="studentinfosys";
$dbconn = new mysqli($host, $user, $pw, $db);
//start the output buffer
ob_start();
//check if form on previous page is submitted
if(isset($_GET['stID']))
{
    $id = $_GET['stID'];

    $sql = "SELECT firstname AS 'fname', lastname AS 'lname', email AS 'email' from Student WHERE stID='$id'";
    $result = $dbconn->query($sql);
    if(!$result)
    {
        //feedback if not able to find Student in database
        echo "Failed to find selected Student in Database.";
    }
    else
    {
        while ($row = $result->fetch_assoc())
        {
            showStudent($row['fname'], $row['lname'], $row['email'],$id,"","","");
        }
    }
}

//prints a new form to the screeen
function showStudent($fname,$lname,$email,$id,$fnErr,$lnErr,$emErr)
{
    echo "<div class='form_div'>
            <form method='GET'>
                <input type='hidden' name='stID' value='$id'>
                <label for='fname'> Firstname: </label>
                <input class='dblock' type='Text' name='fname' value='$fname'>
                <p><span class='errorField'>$fnErr</span></p>
                <label for='lname'> Lastname: </label>
                <input class='dblock' type='Text' name='lname' value='$lname'>
                <p><span class='errorField'>$lnErr</span></p>
                <label for='email'> Email: </label>
                <input class='dblock' type='Text' name='email' value='$email'>
                <p><span class='errorField'>$emErr</span></p>
                <input class='dblock' type='submit' value='Save'>
            </form>
          </div>";
}

//check if input is valid and updates database if it is
function updateStudent($fname,$lname,$email,$id,$dbconn)
{
    //check if the users input is valid
    $namepattern = "/^[a-zA-Z]+$/";
    $emailpattern = "/^[a-zA-Z0-9]+@[a-zA-Z]+.[a-zA-Z]+$/";
    if(!preg_match($namepattern, $lname) || !preg_match($namepattern, $fname) || !preg_match($emailpattern, $email))
    {
        //clear the outputbuffer
        ob_clean();
        $fnErr = $lnErr = $emErr = "";
        //check wich field is invalid
        if (!preg_match($namepattern, $fname))$fnErr="Invalid firstname input";
        if (!preg_match($namepattern, $lname))$lnErr="Invalid lastname input";
        if (!preg_match($emailpattern, $email))$emErr="Invalid email input";
        showStudent($fname,$lname,$email,$id,$fnErr,$lnErr,$emErr);
    }
    else
    {
        $sql2 = "UPDATE Student SET firstname='$fname',lastname='$lname',email='$email' WHERE stID='$id'";
        if ($dbconn->query($sql2) === TRUE) {
            //clear the outputbuffer and feedback on updated database
            showStudent($fname, $lname, $email, $id,"","","");
            echo "<p>Edit successfull!</p>
            <form action='studentinfo.php' method='get'>
                <input type='hidden' name='stID' value=$id>
                <input type='submit' value='Back to student'>
            </form>";
        }
        else
        {
            //Feedback if unable to update the database
            echo "<p>Failed to save changes</p>
            <form action='studentinfo.php' method='get'>
                <input type='hidden' name='stID' value=$id>
                <input type='submit' value='Back to student'>
            </form>";
        }
    }
}

// check if the form is is submitted
if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['email']) && isset($_GET['stID']))
{
    updateStudent($_GET['fname'],$_GET['lname'],$_GET['email'],$_GET['stID'],$dbconn);
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
