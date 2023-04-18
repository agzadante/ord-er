<?php

include 'config.php';

$id = $_POST['id'];

// Az adott rendelés a Closed_order táblába helyezése
$query = "INSERT INTO Closed_order (id, time, done) SELECT id, time, done FROM Orders WHERE id = $id";
mysqli_query($conn, $query);

// Az adott rendelés törlése a Orders táblából
$query = "DELETE FROM Orders WHERE id = $id";
mysqli_query($conn, $query);

mysqli_close($conn);

?>
