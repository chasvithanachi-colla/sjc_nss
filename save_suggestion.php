<?php
include "db.php";

if (isset($_POST['suggestion'])) {

    $suggestion = trim($_POST['suggestion']);

    if ($suggestion != "") {

        $stmt = $conn->prepare("INSERT INTO suggestions (message) VALUES (?)");
        $stmt->bind_param("s", $suggestion);
        $stmt->execute();
    }

    // Alert + redirect to suggestions tab
    echo "<script>
        alert('Suggestion submitted successfully');
        window.location.href = 'vol.php?tab=suggestions';
    </script>";
    exit();
}
?>
