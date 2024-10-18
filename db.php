<?php 

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "integration";

// Create la connexion avec PDO  avec le json qui contient les messages de succes et erreurs 

try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}