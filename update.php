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
      <a class="navigation" href="retrive.php">Retrive</a>
      <b class="navigation">Update</b>
      <a class="navigation" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Update</p>
  </div>

  <div class="form_div">
      <form id="selectForm" method="get">
          <select name="selectInfo">
              <option value="1" selected="selected" <?php $info = "1" ?>>Student</option>
              <option value="2" <?php $info ?>>Course</option>
          </select>

          <input class="dblock" type="Submit" value="BOOM">
      </form>
      <?php
      function search($info)
      {
          echo "<input placeholder='$info'>";
      }

      function result($array)
      {
       if (empty($array))
       {
           echo "No result";
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
      if (isset($_GET["selectInfo"]))
      {
          $info = $_GET["selectInfo"];
          if ($info=="1") Student();
          if ($info=="2") Course();
      }
      ?>
  </div>
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
