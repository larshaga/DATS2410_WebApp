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

  <div>
      <a class="navigation" href="index.php">Home</a>
      <b class="navigation">Add</b>
      <a class="navigation" href="retrive.php">Retrive</a>
      <a class="navigation" href="update.php">Update</a>
      <a class="navigation" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Add</p>
  </div>


  <div class="form_div">
      <form method="get">
          <select class="dblock" name="selectInfo">
              <option value="student">Student</option>
              <option value="course">Course</option>
          </select>
          <input class="dblock" type="Submit" value="BOOM">
      </form>
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
    <!-- PHP -->
<?php
echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . "<br>";
echo "The database server IP:" . $_SERVER['SERVER_ADDR'] . "<br>";
?>
<p>A webpage by students at Oslo and Akershus university college of applied sciences</p>
</footer>
</html>