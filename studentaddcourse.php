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
            ob_start();
            ini_set('display_errors',1);
            $stID=$_GET['stID'];
            //Connection to dats04-dbproxy
            $host="10.1.1.130";
            $user="webuser";
            $pw="welcomeunclebuild";
            $db="studentinfosys";
            $dbconn = new mysqli($host, $user, $pw, $db);

            $getTitle="select coursecode, title from Course group BY title;";
            $getTitlecourse = $dbconn->query($getTitle);


            if (isset($_GET['coursecode'])){
                echo "<p>Course:</p>
                    <form id=\"selectCourse\" method=\"GET\">
                    <select name=\"coursecode\">";
                while($row=$getTitlecourse->fetch_assoc()){
                    echo "<option value=\"{$row['coursecode']}\" name='coursecode' "; isChosen($row['coursecode'],$_GET['coursecode']); echo ">{$row['title']}</option>";
                }
                echo "</select>
                    <input type='hidden' name='stID' value='$stID'>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
            }else{
                echo "<p>Course:</p>
                    <form id=\"selectCourse\" method=\"GET\">
                    <select name=\"coursecode\">";
                        while($row=$getTitlecourse->fetch_assoc()){
                            echo "<option value=\"{$row['coursecode']}\" name='coursecode'>{$row['title']}</option>";
                        }
                    echo "</select>
                    <input type='hidden' name='stID' value='$stID'>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
            }

            function selectYear($dbconn,$stID,$coursecode){
                $getYear="Select year from Course where coursecode='$coursecode';";
                $getYearcourse = $dbconn->query($getYear);
                $row =[];

                echo "<p>What year did the student attend the course?</p>
                    <form id=\"selectYear\" method=\"GET\">
                    <select name=\"year\">";
                        while($row=$getYearcourse->fetch_assoc()){
                            echo "<option value=\"{$row['year']}\" name='year'>{$row['year']}</option>";
                        }
                    echo "</select>
                    <input type='hidden' name='coursecode' value='$coursecode'>
                    <input type='hidden' name='stID' value='$stID'>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
            }

            function chooseGrade($stID,$coursecode,$year){

                echo "<p>Select the grade received:</p>
                    <form id=\"selectGrade\" method=\"GET\">
                    <select name=\"grade\">
                        <option value='A'>A</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                        <option value='E'>E</option>
                        <option value='F'>F</option>
                        <option value=''>Not finished</option>
                    </select>
                    <input type='hidden' name='coursecode' value='$coursecode'>
                    <input type='hidden' name='stID' value='$stID'>
                    <input type='hidden' name='year' value='$year'>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
            }

            function insertGrade($dbconn, $stID, $coursecode, $year, $grade){
                $insert="insert into Grade values ($stID,'$coursecode',$year,'$grade');";
                if ($dbconn->query($insert)===TRUE){
                    echo "<p>Succesfully added $coursecode to student $stID with the grade: $grade</p>
                            <form action='studentinfo.php' method='get'>
                                <input type='hidden' name='stID' value=$stID>
                                <input type='submit' value='Back to student'>
                            </form>";
                }else {
                    echo "<p>Something went wrong. The course was not added to student $stID</p>
                            <form action='studentinfo.php' method='get'>
                                <input type='hidden' name='stID' value=$stID>
                                <input type='submit' value='Back to student'>
                            </form>";
                }
            }


            if (isset($_GET["coursecode"])){
                if (isset($_GET['year'])){
                    $getYear="Select year from Course where coursecode='{$_GET['coursecode']}';";
                    $getYearcourse = $dbconn->query($getYear);
                    echo "<p>What year did the student attend the course?</p>
                    <form id=\"selectYear\" method=\"GET\">
                    <select name=\"year\">";
                    while($row=$getYearcourse->fetch_assoc()){
                        echo "<option value=\"{$row['year']}\" name='year' "; isChosen($row['year'],$_GET['year']); echo ">{$row['year']}</option>";
                    }
                    echo "</select>
                    <input type='hidden' name='coursecode' value='{$_GET['coursecode']}'>
                    <input type='hidden' name='stID' value='$stID'>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
                }else{
                    selectYear($dbconn,$_GET['stID'],$_GET['coursecode']);
                }
            }
            if (isset($_GET["year"])){
                if (isset($_GET['grade'])){
                    echo "<p>Select the grade received:</p>
                    <form id=\"selectGrade\" method=\"GET\">
                    <select name=\"grade\">
                        <option value='A' "; isChosen('A',$_GET['grade']); echo ">A</option>
                        <option value='B' "; isChosen('B',$_GET['grade']); echo ">B</option>
                        <option value='C' "; isChosen('C',$_GET['grade']); echo ">C</option>
                        <option value='D' "; isChosen('D',$_GET['grade']); echo ">D</option>
                        <option value='E' "; isChosen('E',$_GET['grade']); echo ">E</option>
                        <option value='F' "; isChosen('F',$_GET['grade']); echo ">F</option>
                        <option value='' "; isChosen('',$_GET['grade']); echo ">Not finished yet</option>
                    </select>
                    <input type='hidden' name='coursecode' value={$_GET['coursecode']}>
                    <input type='hidden' name='stID' value={$_GET['stID']}>
                    <input type='hidden' name='year' value={$_GET['year']}>
                    <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                </form>";
                }else{
                    chooseGrade($_GET['stID'],$_GET['coursecode'],$_GET['year']);
                }
            }
            if (isset($_GET["grade"])){
                insertGrade($dbconn, $_GET['stID'],$_GET['coursecode'],$_GET['year'],$_GET['grade']);
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
    $dbconn->close();
    ?>
</footer>
</html>
