<?php
include "db.php";

if (isset($_POST['feedback'])) {

    $feedback = trim($_POST['feedback']);

    if ($feedback != "") {

        // NOTE: table column name = message (phpMyAdmin screenshot)
        $stmt = $conn->prepare("INSERT INTO feedback (message) VALUES (?)");
        $stmt->bind_param("s", $feedback);
        $stmt->execute();
    }

    // Alert + correct tab redirect
    echo "<script>
        alert('Feedback submitted successfully');
        window.location.href = 'vol.php?tab=feedback';
    </script>";
    exit();
}
?>
