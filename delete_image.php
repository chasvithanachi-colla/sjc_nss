<?php
include "db.php";

$id = $_GET['id'];

$res = $conn->query("SELECT image FROM gallery WHERE id=$id");
$row = $res->fetch_assoc();
unlink($row['image']);

$conn->query("DELETE FROM gallery WHERE id=$id");

header("Location: po_panel.php");
?>
