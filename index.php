<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Dats04 - Web</title>
</head>

<body>
  <div class="title">
    <h1>Tittel</h1>
  </div>

  <div class="navigation">
    <a href="index.html">All</a>
    <a href="index.html">other</a>
    <a href="index.html">data</a>
    <!-- Add aditional fields here-->

  </div>

  <div class="login">
    <form method="post">
      <input type="Text" placeholder="Name">
      <input type="Text" placeholder="Other data">
      <input type="Text" placeholder="Other data">
      <input type="Text" placeholder="Other data">
      <input type="Submit">
      <!-- Add aditional fields here-->
    </form>
  </div>
</body>

<footer>
<p class="bottom">A webpage by students at Oslo and Akershus university college of applied sciences</p>
<?php
echo "The web server IP:" . $_SERVER['SERVER_ADDR'] . "<br>";
echo "The database server IP: "<br>";
?>
</footer>
</html>
