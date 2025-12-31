<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['user_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM programme_officer WHERE userid='$userid'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['po_user'] = $userid;
            header("Location: po_panel.php"); // ✅ REDIRECT HERE
            exit();
        }
    }

    echo "<script>alert('Invalid User ID or Password');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PO Login - NSS</title>
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
    </style>
</head>
<body>

<div class="box">
    <h2>Programme Officer Login</h2>
    <form method="post">
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="po_signup.html">Sign Up</a></p>
</div>

</body>
</html>
