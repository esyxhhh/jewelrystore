<?php
include 'db.php';

// Ambil data dari form
$name = $_POST['name'];
$address = $_POST['address'];
$card = $_POST['cardNumber'];
$expiry = $_POST['expiryMonth'] . '/' . $_POST['expiryYear'];
$cvv = $_POST['cvv'];
$items = $_POST['items']; // items dihantar dalam bentuk JSON

// Masukkan ke DB
$sql = "INSERT INTO purchases (name, address, card, expiry, cvv, items) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $address, $card, $expiry, $cvv, $items);
$stmt->execute();

$stmt->close();
$conn->close();

// Redirect ke thank you
header("Location: thankyou.html");
exit;
?>
