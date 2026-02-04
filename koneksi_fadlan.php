<?php
$serverfadlan = "localhost";
$userfadlan = "root";
$passwordfadlan = "";
$databasefadlan = "db_e-raport_fadlan" ;

$conn = new mysqli ($serverfadlan, $userfadlan, $passwordfadlan, $databasefadlan);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>