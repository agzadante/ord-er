<?php
// Adatbázis kapcsolódás
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders";

$conn = new mysqli($servername, $username, $password, $dbname);

// Hibaellenőrzés
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lekérjük az összes aktuális rendelést az adatbázisból
$sql = "SELECT * FROM current_order";
$result = $conn->query($sql);

// Kiírjuk a rendelések listáját
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li id='order-".$row['id']."'>";
        echo $row['id'].". Rendelés";
        echo "<button class='btn btn-success btn-done' data-id='".$row['id']."'>Elkészült</button>";
        echo "<button class='btn btn-danger btn-delete' data-id='".$row['id']."'>Törlés</button>";
        echo "</li>";
    }
} else {
    echo "Nincs aktuális rendelés.";
}

$conn->close();
?>
