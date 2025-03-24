/* delete.php - Fiets verwijderen */
<?php
include 'config.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM fietsen WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
?>