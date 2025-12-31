<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM announcements WHERE id=$id");
}

header("Location: secretary_panel.php?tab=announcement");
exit();
