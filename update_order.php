<?php
// Adatbázis kapcsolat létrehozása
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders";

$conn = new mysqli($servername, $username, $password, $dbname);

// Hibaellenőrzés
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Az állapot frissítése az adatbázisban
$id = $_POST['id'];
$done = $_POST['done'];
$sql = "UPDATE current_order SET done=$done WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Order updated successfully";
} else {
  echo "Error updating order: " . $conn->error;
}

$conn->close();
?>
