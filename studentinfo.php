<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Student</title>
</head>

<body>
<div class="title">
    <h1>HiOA student information system</h1>
</div>

<div>
    <a class="navigation" href="index.php">Home</a>
    <a class="currentpage" href="student.php">Student</a>
    <a class="navigation" href="course.php">Course</a>
    <a class="navigation" href="studyprogram.php">Study program</a>
</div>

<div class="siteinfo">
    <?php
    //Connection to dats04-dbproxy
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);

    $stID=$_GET['stID'];

    if (isset($_GET['deleteBool'])){
        $sql1 = "Delete from Enrollment where stID = $stID;";
        $sql2 = "Delete from Grade where stID = $stID;";
        $sql3 = "Delete from Student where stID = $stID;";
        $dbconn->query("START TRANSACTION");
        if ($dbconn->query($sql1)===TRUE){
            if ($dbconn->query($sql2)===TRUE){
                if ($dbconn->query($sql3)===TRUE){
                    $dbconn->query("COMMIT");
                    echo "<p>Succesfully deleted student $stID</p>";
                }
            }
        }else {
            $dbconn->query("ROLLBACK");
            echo "<p>Something went wrong. The student ($stID) was not deleted.</p>";
        }
    }


    $sql = "select s.stID, concat(s.lastname,', ',s.firstname) as name, s.email from Student s where s.stID=$stID;";
    $result = $dbconn->query($sql);
    echo "
        <div class='studentinfo'>";
    while($row=$result->fetch_assoc()){
        echo "<h2>Name: {$row['name']}</h2>
            <h3>Student ID: {$row['stID']}</h3>    
            <h3>E-mail: {$row['email']}</h3>";
    }

    echo "<form action=\"studentedit.php\" method=\"GET\">
                <input type=\"hidden\" name=\"stID\" value=$stID>
                <input type=\"submit\" value=\"Edit\">
          </form>
          <form id='deletebuttonSI' action=\"studentinfo.php\" method=\"GET\">
                <input type=\"hidden\" name=\"stID\" value=$stID>
                <input type=\"hidden\" name=\"deleteBool\" value=1>
                <input type=\"submit\" value=\"Delete\">
          </form>
        </div>";

    if (isset($_GET['deletecourse'])){
        $sql4 = "Delete from Grade where stID = $stID and coursecode = '{$_GET['coursecode']}' and year = '{$_GET['courseyear']}';";
        if ($dbconn->query($sql4)===TRUE){
            echo "<p>Succesfully deleted student from course</p>";
        }else {
            echo "<p>Something went wrong. The course was not deleted.</p>";
        }
    }

    if (isset($_GET['deleteprog'])){
        $sql5 = "Delete from Enrollment where stID = $stID and progcode = '{$_GET['progcode']}';";
        if ($dbconn->query($sql5)===TRUE){
            echo "<p>Succesfully deleted student from program</p>";
        }else {
            echo "<p>Something went wrong. The program was not deleted.</p>";
        }
    }

    $sql = "select p.progcode, p.title, e.startyear as 'Start Year' from Student s, Enrollment e, Study_program p where s.stID=e.stID and e.progcode=p.progcode and s.stID=$stID;";
    $result = $dbconn->query($sql);

    echo "<div class='form_div'><table border='1' id='studentinfo'><caption align='center'>Enrolled study program(s):</caption>";
    echo "<tr><td>Program Code</td><td>Study program</td><td>Enrolled (Year)</td><td colspan='2'>
                <form action=\"studentaddstudy.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"stID\" value=$stID>
                    <input type=\"hidden\" name=\"addstudy\" value=1>
                    <input type=\"submit\" value=\"Add a study program\">
                </form></td><tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['progcode']}</td><td>{$row['title']}</td><td>{$row['Start Year']}</td>
                <td><form action=\"studentprogramedit.php\" method=\"GET\">                         
                    <input type='hidden' name='progcode' value={$row['progcode']}>
                    <input type=\"hidden\" name=\"stID\" value=$stID>
                    <input type=\"submit\" value=\"Edit\">
                </form></td>
                <td><form method='get'>
                     <input type='hidden' name='progcode' value={$row['progcode']}>
                     <input type='hidden' name='stID' value=$stID>
                     <input type='hidden' name='deleteprog' value='1'>
                     <input type='submit' value='Delete'>
                </form>
                </td></tr>";
    }
    echo "</table>";

    $sql = "select c.coursecode, c.title as 'Course name', g.year, g.grade from Student s, Grade g, Course c where s.stID=g.stID and g.coursecode=c.coursecode and g.year=c.year and s.stID=$stID;";
    $result = $dbconn->query($sql);

    echo "<table border='1' id='studentinfo'><caption align='center'>Courses taken or in progress:</caption>";
    echo "<tr><td>Course Name</td><td>Year</td><td>Grade</td><td colspan='2'>
                <form action=\"studentaddcourse.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"stID\" value=$stID>
                    <input type=\"hidden\" name=\"addcourse\" value=1>
                    <input type=\"submit\" value=\"Add a Course\">
                </form></td></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['Course name']}</td><td>{$row['year']}</td> <td>{$row['grade']}</td>
                <td><form action=\"studentcourseedit.php\" method=\"GET\">
                    <input type=\"hidden\" name=\"coursecode\" value={$row['coursecode']}>
                    <input type=\"hidden\" name=\"courseyear\" value={$row['year']}>
                    <input type=\"hidden\" name=\"stID\" value=$stID>
                    <input type=\"submit\" value=\"Edit\">
                </form></td>
                <td><form method=\"GET\">
                    <input type=\"hidden\" name=\"coursecode\" value={$row['coursecode']}>
                    <input type=\"hidden\" name=\"courseyear\" value={$row['year']}>
                    <input type=\"hidden\" name=\"stID\" value=$stID>
                    <input type='hidden' name='deletecourse' value='1'>
                    <input type=\"submit\" value=\"Delete\">
                </form></td></tr>";
    }
    echo "</table></div>";

    $result->close();
    ?>
</div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    $dbconn->close();
    ?>
</footer>
</html>
