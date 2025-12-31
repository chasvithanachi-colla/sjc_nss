<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check existing user
    $check = "SELECT * FROM secretary WHERE userid='$userid' OR email='$email'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        echo "<script>alert('User ID or Email already exists'); window.location='sec_signup.html';</script>";
        exit();
    }

    $sql = "INSERT INTO secretary (name, userid, email, password)
            VALUES ('$name', '$userid', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "<script>alert('Secretary Account Created'); window.location='sec_log.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
