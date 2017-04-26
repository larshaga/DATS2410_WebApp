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
      <a class="navigation" href="retrive.php">Retrive</a>
      <a class="navigation" href="update.php">Update</a>
      <b class="navigation">Delete</b>
  </div>

  <div class="siteinformation">
    <p>Delete</p>
  </div>

  <div class="form_div">
      <form id="selectForm" method="get">
          <select name="deleteInfo">
              <option value="1">Student</option>
              <option value="2">Course</option>
              <option value="3">Study Program</option>
              <option value="4">Enrollment</option>
              <option value="5">Grade</option>
          </select>
      </form>

  </div>
</body>

<footer class="bottomofpage">
    <?php
    echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . " port: " . $_SERVER['SERVER_PORT'] . "<br>";
    $host="10.1.1.130";
    $user="webuser";
    $pw="welcomeunclebuild";
    $db="studentinfosys";
    $dbconn = new mysqli($host, $user, $pw, $db);
    echo "The database server IP:" . $dbconn->host_info . "<br>";
    ?>
    <p>A webpage by students at Oslo and Akershus University College of Applied Sciences</p>
</footer>
</html>
