<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name   = $_POST['name'];
    $userid = $_POST['userid'];
    $email  = $_POST['email'];
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check existing user
    $check = $conn->query("SELECT * FROM volunteers WHERE userid='$userid' OR email='$email'");

    if ($check->num_rows > 0) {
        echo "<script>
            alert('User ID or Email already exists!');
            window.location.href='volunteer_signup.html';
        </script>";
        exit();
    }

    // Insert data
    $sql = "INSERT INTO volunteers (name, userid, email, password)
            VALUES ('$name', '$userid', '$email', '$pass')";

    if ($conn->query($sql)) {
        echo "<script>
            alert('Account created successfully!');
            window.location.href='vol_log.html';
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
