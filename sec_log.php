<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {
    $userid = $_POST['user_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM secretary WHERE userid='$userid'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['sec_id'] = $row['id'];
            $_SESSION['sec_name'] = $row['name'];

            header("Location: secretary_panel.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "Invalid User ID!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Secretary Login - NSS</title>
    <style>
        body { background:#f5d36c; font-family:Arial; }
        .box {
            width:350px; margin:100px auto; padding:30px;
            background:white; border-radius:15px;
            box-shadow:0 0 10px #00000040; text-align:center;
        }
        input, button {
            width:90%; padding:12px; margin:10px 0;
            border-radius:10px; border:1px solid #ccc;
        }
        button { background:#8A0000; color:white; border:none; }
        h2 { color:#8A0000; }
        .error { color:red; }
    </style>
</head>
<body>

<div class="box">
    <h2>Secretary Login</h2>

    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Don't have an account? <a href="sec_signup.php">Sign Up</a></p>
</div>

</body>
</html>
