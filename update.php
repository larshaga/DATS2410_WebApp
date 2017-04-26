<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Update</title>
</head>

<body>
  <div class="title">
    <h1>HiOA student information system</h1>
  </div>

  <div>
      <a class="navigation" href="index.php">Home</a>
      <a class="navigation" href="add.php">Add</a>
      <a class="navigation" href="retrieve.php">Retrieve</a>
      <b class="navigation">Update</b>
      <a class="navigation" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Update</p>
  </div>
  <?php
  ob_start();
  ?>

  <div class="form_div">
      <form id="selectForm" method="get">
          <select name="selectInfo">
              <option value="student" selected="selected" >Student</option>
              <option value="course">Course</option>
          </select>
          <input type="submit">
      </form>
  </div>
  <?php

      function search($info)
      {
          ob_clean();
          echo "
            <form action='result.php' method='POST'>
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
              echo ob_get_flush();
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
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
          if (isset($_GET["selectInfo"])) {
              $info = $_GET["selectInfo"];
              search($info);
          }
          if (isset($_GET["selectS"])) {
              $info = $_GET["selectS"];
              result($info);
          }
      }


      ?>

</body>

<footer class="bottomofpage">
    <!-- PHP -->
<?php
echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . "<br>";
echo "The database server IP:" . $_SERVER['SERVER_ADDR'] . "<br>";
?>
<p>A webpage by students at Oslo and Akershus university college of applied sciences</p>
</footer>
</html>
