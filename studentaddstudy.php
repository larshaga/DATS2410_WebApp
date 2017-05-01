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
        <a class="navigation" href="studyprogram.php">Study Program</a>
    </div>

    <div class="siteinfo">
        <p></p>
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

        $getTitle="select progcode, title from Study_program group BY title;";
        $getTitlecourse = $dbconn->query($getTitle);

        echo "<p>Study program:</p>
              <form id=\"selectprogram\" method=\"GET\">
              <select name=\"progcode\">";
        if (isset($_GET['progcode'])){
            while($row=$getTitlecourse->fetch_assoc()){
                echo "<option value=\"{$row['progcode']}\" name='progcode' "; isChosen($row['progcode'],$_GET['progcode']); echo ">{$row['title']}</option>";
            }
        }else{
            while($row=$getTitlecourse->fetch_assoc()){
                echo "<option value=\"{$row['progcode']}\" name='progcode'>{$row['title']}</option>";
            }
        }
        echo "</select>
                <input type='hidden' name='stID' value='$stID'>
                <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
            </form>";

        function selectYear($stID,$progcode){
            echo "<p>Year student was enrolled:</p>
                  <form id=\"selectYear\" method=\"GET\">
                  <select name=\"year\">";
            for ($i = date("Y"); $i > 1900; $i--)
                {
                    echo"<option value='$i' name='year'>$i</option>";
                }
            echo "</select>
                <input type='hidden' name='progcode' value='$progcode'>
                <input type='hidden' name='stID' value='$stID'>
                <input class='dblock' type='Submit' value='Submit'>
            </form>";
        }

        function insertProgram($dbconn, $stID, $progcode, $year){
            $insert="insert into Enrollment values ($stID,'$progcode',$year);";
            if ($dbconn->query($insert)===TRUE){
                echo "<p>Succesfully added $progcode to student $stID in the year $year</p>
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


        if (isset($_GET["progcode"])){
            if (isset($_GET['year']))
            {
                echo "<form id=\"selectYear\" method=\"GET\">
                  <select name=\"year\">";
                for ($i = date("Y"); $i > 1900; $i--)
                {
                    echo"<option value='$i' name='year' "; isChosen($i,$_GET['year']); echo ">$i</option>";
                }
                echo "</select>
                <input type='hidden' name='progcode' value='$progcode'>
                <input type='hidden' name='stID' value='$stID'>
                <input class='dblock' type='Submit' value='Submit'>
            </form>";
            }else
            {
                selectYear($_GET['stID'], $_GET['progcode']);
            }
        }
        if (isset($_GET["year"])){
            insertProgram($dbconn, $_GET['stID'],$_GET['progcode'],$_GET['year']);
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
