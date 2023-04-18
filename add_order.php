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

// Ellenőrizzük a lezárt rendelések sorszámát és az alapján adjuk hozzá az új rendelést
$sql = "SELECT MAX(order_number) AS max_order_number FROM closed_order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $order_number = $row["max_order_number"] + 1;
} else {
  $order_number = 1;
}

// Ellenőrizzük, hogy az új sorszám létezik-e már a teljesített vagy jelenlegi rendelések között
$sql = "SELECT order_number FROM completed_order WHERE order_number = $order_number UNION SELECT order_number FROM current_order WHERE order_number = $order_number";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Ha az új sorszám már létezik, akkor hibaüzenetet adunk vissza
  echo "Error: Az új sorszám már létezik.";
} else {
  // Ha az új sorszám még nem létezik, akkor hozzáadjuk az új rendelést az adatbázishoz
  $sql = "INSERT INTO current_order (order_number) VALUES ($order_number)";
  if ($conn->query($sql) === TRUE) {
    // Ha sikeresen hozzáadtuk az új rendelést, visszatérünk az új elemmel
    $last_id = $conn->insert_id - 1; // az első rendelés sorszáma 0, így 1-et kell kivonni
    $response = '<li id="order-' . $last_id . '"><span class="order-number">' . $order_number . '</span><button class="btn btn-success btn-sm float-right mr-2 btn-done" data-id="' . $last_id . '">Done</button></li>';
    echo $response;
  } else {
    // Ha nem sikerült hozzáadni az új rendelést, hibaüzenetet adunk vissza
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();

?>
