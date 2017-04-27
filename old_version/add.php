<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Add</title>
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
      <a class="navigation" href="../index.php">Home</a>
      <b class="navigation">Add</b>
      <a class="navigation" href="retrieve.php">Retrieve</a>
      <a class="navigation" href="update.php">Update</a>
      <a class="navigation" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Add</p>
  </div>


  <div class="form_div">
      <form id="selectForm" method="get">
        <select name="selectInfo">
          <option value="1" selected="selected">Student</option>
          <option value="2" >Course</option>
        </select>

          <input class="dblock" type="Submit" value="BOOM">
      </form>
      <?php
      function Student()
      {
          echo "  <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Student name\" >
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Student number\" >
                        <input class=\"dblock\" type=\"Submit\" value=\"BOOM\">
                    </form>
                </div>";

      }
      function Course()
      {
          echo "  <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Course name\" >
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Course code\" >
                        <input class=\"dblock\" type=\"Submit\" value=\"BOOM\">
                    </form>
                </div>";

      }

      //if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_GET["selectInfo"]))
      {
          $info = $_GET["selectInfo"];
          if ($info=="1") Student();
          if ($info=="2") Course();
          //echo $info . "<br>";
          //echo "Test<br>";
//    test();
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
