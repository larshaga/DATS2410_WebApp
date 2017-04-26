<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Delete</title>
</head>

<body>
  <div class="title">
    <h1>HiOA student information system</h1>
  </div>

  <div>
      <a class="navigation" href="index.php">Home</a>
      <a class="navigation" href="add.php">Add</a>
      <a class="navigation" href="retrieve.php">Retrieve</a>
      <a class="navigation" href="update.php">Update</a>
      <b class="navigation">Delete</b>
  </div>

  <div class="siteinformation">
    <p>What do you want to delete?</p>
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
  <div class="form_div">
      <form id="selectForm" method="get">

          <select name="deleteinfo">
              <option value="1">Student</option>
              <option value="2">Course</option>
              <option value="3">Study program</option>
          </select>
          <input class="dblock" type="Submit">
      </form>
      <?php
        function StudentDelete()
        {
            echo "<div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the student number?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
        }

        function CourseDelete()
        {
            echo "<div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the course number?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
        }

        function Study_programDelete()
        {
            echo "<div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"What is the study program number?\">
                        <input class=\"dblock\" type=\"Submit\" value=\"Submit\">
                    </form>
                </div>
               ";
        }

      if (isset($_GET["deleteinfo"]))
      {
          $info = $_GET["deleteinfo"];
          if ($info=="1") StudentDelete();
          elseif ($info=="2") CourseDelete();
          else Study_programDelete();
      }
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
