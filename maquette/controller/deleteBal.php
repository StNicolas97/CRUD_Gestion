<?php
require '../model/config.php';

$id = $_GET['id'];
$sql = "DELETE FROM balise WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../view/balise.php");
exit;
?>