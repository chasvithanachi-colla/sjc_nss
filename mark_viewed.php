<?php
include "db.php";
$id=$_GET['id'];
$conn->query("UPDATE onduty SET viewed=1 WHERE id=$id");
header("Location: secretary_panel.php");
?>
