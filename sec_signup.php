<!DOCTYPE html>
<html>
<head>
    <title>Secretary Sign Up - NSS</title>
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
    </style>
</head>
<body>

<div class="box">
    <h2>Secretary Sign Up</h2>

    <form action="secretary_save.php" method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="userid" placeholder="User ID" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Create Account</button>
    </form>

    <p>Already have an account? <a href="sec_log.php">Login</a></p>
</div>

</body>
</html>
