<?php
include "db.php";

if (isset($_FILES['image'])) {
    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder);
    }

    $imageName = time() . "_" . $_FILES['image']['name'];
    $path = $folder . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        $sql = "INSERT INTO gallery (image) VALUES ('$path')";
        $conn->query($sql);
        header("Location: po_panel.php");
    }
}
?>
