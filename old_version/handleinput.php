<html>
<body>
<?php if ($_SERVER["REQUEST_METHOD"]=='GET'){
    $fname = $_GET["fname"];
    $lname = $_GET["lname"];}
else{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];}
echo "Hello, $fname $lname!"."<br>";
//$url = $_SERVER['REQUEST_URI'];
$url = basename(__DIR__)."\\add.php";
echo $url."<br>";
?>
</body>
</html>