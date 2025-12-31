<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if User ID or Email already exists
    $check = "SELECT * FROM programme_officer WHERE userid='$userid' OR email='$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "<script>alert('User ID or Email already exists'); window.location='po_signup.html';</script>";
    } else {

        $sql = "INSERT INTO programme_officer (name, userid, email, password)
                VALUES ('$name', '$userid', '$email', '$password')";

        if ($conn->query($sql)) {
            echo "<script>alert('Account Created Successfully'); window.location='po_log.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
