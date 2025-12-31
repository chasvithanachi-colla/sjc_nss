<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM volunteers WHERE userid='$userid'");

    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['volunteer'] = $row['userid'];
            header("Location: vol.php"); // 👈 redirect here
            exit();
        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Login - NSS</title>
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
        button:hover { background:#a00000; }
        h2 { color:#8A0000; }
        a { color:#8A0000; text-decoration:none; font-weight:bold; }
        a:hover { text-decoration:underline; }
    </style>
</head>
<body>

<div class="box">
    <h2>Volunteer Login</h2>

    <form action="" method="post">
        <input type="text" name="userid" placeholder="User ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="vol_signup.php">Sign Up</a></p>
</div>

</body>
</html>
