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

  <div>
    <a class="navigation" id="home_nav" href="index.php">Home</a>
    <a class="navigation" id="add_nav" href="add.php">Add</a>
    <b class="navigation">Retrive</b>
    <a class="navigation" id="update_nav" href="update.php">Update</a>
    <a class="navigation" id="delete_nav" href="delete.php">Delete</a>
  </div>

  <div class="siteinformation">
    <p>Retrive</p>
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
