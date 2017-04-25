<html>
<body>
<?php if ($_SERVER["REQUEST_METHOD"]=='GET'){
    $fname = $_GET["fname"];
    $lname = $_GET["lname"];}
else{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];}
echo "Hello, $fname $lname!";
GOTO(add.php);
?>
</body>
</html>
