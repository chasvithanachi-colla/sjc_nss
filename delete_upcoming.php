<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM upcoming_events WHERE id=$id");
}

header("Location: secretary_panel.php?tab=upcoming");
exit();
