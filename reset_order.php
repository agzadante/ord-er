<?php
// Adatbázis kapcsolat létrehozása
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders";

$conn = new mysqli($servername, $username, $password, $dbname);

// Ha nem sikerült kapcsolódni az adatbázishoz, hibaüzenetet adunk vissza
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// closed_order tábla kiürítése
$sql = "DELETE FROM closed_order";
if ($conn->query($sql) === TRUE) {
  echo "All orders have been reset successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

