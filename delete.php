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

          <select name="selectInfo">
              <option value="student" <?php $info = "1" ?>>Student</option>
              <option value="course" <?php $info ?>>Course</option>
              <option value="study_program" <?php $info ?>>Study program</option>
          </select>

          <input class="dblock" type="Submit">
      </form>
      <?php
      function search($info)
      {
          ob_clean();
          echo "
            <form>
                <input name='selectS' type='search' placeholder='$info'>
            </form>
           ";
      }

      function result($info)
      {

          if ($info=="")
          {
              ob_clean();
              echo "No result";
          }
          else
          {
              var_dump(ob_get_clean());
          }
      }

      function Student()
      {
          $array="";
          $a = array("Dataingeniør","Anvendt Data","Kjemi","Maskin");
          foreach($a as $e)
          {
              $array=$array. "<option value='".$e."'>".$e."</option>";
          }
          echo "  <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" name='name'>
                        <input class=\"dblock\" type=\"Text\" name='email'>
                        <select>".$array."</select>
                        <input class=\"dblock\" type=\"Submit\" value=\"BOOM\">
                    </form>
                </div>";

      }
      function Course()
      {
          echo " <div class=\"form_div\">
                    <form method=\"post\">
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Course name\" >
                        <input class=\"dblock\" type=\"Text\" placeholder=\"Course code\" >
                        <input class=\"dblock\" type=\"Submit\" value=\"BOOM\">
                    </form>
                </div>";
      }
      $i="test";
      if (isset($_GET["selectInfo"]))
      {
          $info = $_GET["selectInfo"];
          search($info);
      }
      if (isset($_GET["selectS"]))
      {
          $info = $_GET["selectS"];
          result($info);
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
