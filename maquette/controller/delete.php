<?php
require '../model/config.php';

$id = $_GET['id'];
$sql = "DELETE FROM clients WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../view/client.php");
exit;
?>
