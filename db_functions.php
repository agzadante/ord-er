<?php
// Adatbázis kapcsolat létrehozása
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_name";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Aktuális rendelés sorszámok lekérdezése
$sql = "SELECT id FROM current_order";
$result = $conn->query($sql);
$current_orders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $current_orders[] = $row["id"];
    }
}

// Elkészült rendelés sorszámok lekérdezése
$sql = "SELECT id FROM completed_order";
$result = $conn->query($sql);
$completed_orders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $completed_orders[] = $row["id"];
    }
}

// Lezárt rendelés sorszámok lekérdezése
$sql = "SELECT id FROM closed_order";
$result = $conn->query($sql);
$closed_orders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $closed_orders[] = $row["id"];
    }
}

// Adatbázis kapcsolat lezárása
$conn->close();
?>
