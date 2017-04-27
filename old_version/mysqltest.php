<?php
/**
 * Created by PhpStorm.
 * User: Jesper Nylend
 * Date: 26.04.2017
 * Time: 07.42
 */

$host="10.1.1.130";
$db="studentinfosys";
$user="webuser"; $pw="welcomeunclebuild";
$dbconn = new mysqli($host, $user, $pw, $db);

$sql = "SELECT * from Student";
$result = $dbconn->query($sql);

echo "Student navn:<br />";
echo "<table border='1'>";
echo "<tr><td>Student fornavn</td><td>Student etternavn</td></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['fornavn']}</td> <td>{$row['etternavn']}</td></tr>";
}
echo "</table>";

$result->close();
$dbconn->close();
?>