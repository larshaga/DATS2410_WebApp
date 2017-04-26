<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Retrive</title>
</head>

<body>
  <div class="title">
    <h1>HiOA student information system</h1>
  </div>

  <?php
  ob_start();
  /*
  // Connection to dats04-dbproxy
  $host="10.1.1.130";
  $user="webuser";
  $pw="welcomeunclebuild";
  $db="studentinfosys";
  $dbconn = new mysqli($host, $user, $pw, $db);
  */
  ?>

  <div>
    <a class="navigation" href="index.php">Home</a>
    <a class="navigation" href="add.php">Add</a>
    <b class="navigation">Retrieve</b>
    <a class="navigation" href="update.php">Update</a>
    <a class="navigation" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Retrieve</p>
  </div>

  <div class="form_div">
      <form id="selectForm" method="get">
          <select name="selectInfo">
              <option value="1">Show info about student</option>
              <option value="2">Show all students in a course</option>
              <option value="3">Show every student who has taken a course</option>
              <option value="4">Show all students in a study program</option>
          </select>
          <input class="dblock" type="Submit" value="Submit">
      </form>
      <?php
      function StudentInfo()
      {
          echo "<div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the student number?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
      }

      function StudentInCourse()
      {
          echo "
                <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the course name?\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What year?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
      }

      function AllStudentsInCourse()
      {
          echo "
                <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the course name?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
                ";
      }

      function AllStudentsInProgram()
      {
          echo "
                <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the study program?\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What year?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
      }

      if (isset($_GET["selectInfo"]))
      {
          $info = $_GET["selectInfo"];
          if ($info=="1") StudentInfo();
          elseif ($info=="2") StudentInCourse();
          elseif ($info=="3") AllStudentsInCourse();
          else AllStudentsInProgram();
      }
      ?>
  </div>
  <!--
  <div class="form_div">
    <form method="post">
        <input class="dblock" type="Text" placeholder="1" >
        <input class="dblock" type="Text" placeholder="2" >
        <input class="dblock" type="Text" placeholder="3" >
        <input class="dblock" type="Text" placeholder="4" >
        <input class="dblock" type="Submit" value="BOOM">
        <!-- Add aditional fields here
    </form>
  </div>
-->
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
