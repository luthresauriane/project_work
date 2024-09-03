<?php
$servername='mysql:host=localhost;dbname=bd_project';
$username="root";
$password="";
try {
    $connect = new PDO($servername, $username, $password);
    $connect-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a échoué: " . $e->getMessage();
    exit;
}
?>