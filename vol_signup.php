<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name   = $_POST['name'];
    $userid = $_POST['userid'];
    $email  = $_POST['email'];
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check existing user
    $check = $conn->query("SELECT * FROM volunteers WHERE userid='$userid' OR email='$email'");

    if ($check->num_rows > 0) {
        $msg = "User ID or Email already exists!";
    } else {
        $sql = "INSERT INTO volunteers (name, userid, email, password)
                VALUES ('$name', '$userid', '$email', '$pass')";

        if ($conn->query($sql)) {
            header("Location: vol_log.php");
            exit();
        } else {
            $msg = "Error occurred!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Sign Up - NSS</title>
    <style>
        body { background:#f5d36c; font-family:Arial; }
        .box {
            width:350px; margin:70px auto; padding:30px;
            background:white; border-radius:15px;
            box-shadow:0 0 10px #00000040; text-align:center;
        }
        h2 { color:#8A0000; }
        input, button {
            width:90%; padding:12px; margin:10px 0;
            border-radius:10px; border:1px solid #ccc;
        }
        button { background:#8A0000; color:white; border:none; }
        button:hover { background:#a00000; }
        a { color:#8A0000; text-decoration:none; font-weight:bold; }
        a:hover { text-decoration:underline; }
        .msg { color:red; font-size:14px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Volunteer Sign Up</h2>

    <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="userid" placeholder="User ID" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Create Account</button>
    </form>

    <p>Already have an account? <a href="vol_log.php">Login</a></p>
</div>

</body>
</html>
