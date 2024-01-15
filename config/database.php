<?php
$servername = "localhost:3306";
$username = "amzmp_test";
$password = "amzmp_test";
$dbname = "amzmp_test";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Conexão falhou: " . $e->getMessage());
}