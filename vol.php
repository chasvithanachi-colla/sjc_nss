<?php
include "db.php";

/* SAVE SUGGESTION */
if (isset($_POST['add_suggestion'])) {
    $msg = mysqli_real_escape_string($conn, $_POST['suggestion']);
    $conn->query("INSERT INTO suggestions (message) VALUES ('$msg')");

    header("Location: vol.php?tab=suggestions&msg=Suggestion submitted successfully");
    exit();
}

/* SAVE FEEDBACK */
if (isset($_POST['add_feedback'])) {
    $msg = mysqli_real_escape_string($conn, $_POST['feedback_msg']);
    $conn->query("INSERT INTO feedback (message) VALUES ('$msg')");

    header("Location: vol.php?tab=feedback&msg=Feedback submitted successfully");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSS - St. Joseph's College</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f7d566;
        }

        /* TOP BAR */
        .top-bar {
            background: #600000;
            padding: 10px 20px;
            text-align: right;
        }
        .top-bar a {
            font-size: 28px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        /* LOGIN DROPDOWN */
        .login-box {
            display: none;
            position: absolute;
            right: 20px;
            top: 60px;
            background: white;
            color: black;
            border-radius: 8px;
            width: 220px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            padding: 10px;
            z-index: 10;
        }
        .login-box h3 {
            margin: 0;
            color: #600000;
            text-align: center;
        }
        .login-box a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: black;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        .login-box a:hover {
            background: #fce4e4;
        }

        /* HEADER */
        header {
            display: flex;
            align-items: center;
            background: #6a0000;
            padding: 15px 40px;
            color: #fff;
        }
        header img {
            height: 110px;
        }
        .college-text h1 {
            margin: 0;
            font-size: 40px;
            font-weight: 700;
        }
        .college-text span {
            font-size: 22px;
            color: #ffd94c;
        }

        /* SIDEBAR + CONTENT */
        .container {
            display: flex;
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px #ccc;
        }
        .sidebar {
            width: 240px;
            background: #fff3e0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            padding: 18px 20px;
            color: #6a0000;
            cursor: pointer;
            font-size: 18px;
        }
        .sidebar li:hover {
            background: #ffe0b2;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 30px;
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .notice {
            background: #ffe7c2;
            padding: 18px;
            margin-top: 20px;
            border-radius: 6px;
            font-size: 18px;
        }

        .suggest-box, .feedback-box, .od-box {
            margin-top: 25px;
            background: #fff0c7;
            padding: 20px;
            border-radius: 6px;
        }

        textarea, input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #aaa;
            margin-top: 8px;
        }
        button {
            background: #6a0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* FOOTER */
        footer {
            background:#600000;
            color:white;
            padding:40px 0;
            margin-top: 50px;
        }
        footer a { color:white; text-decoration:none; }
    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="top-bar">
    <a onclick="toggleLogin()">👤</a>
</div>

<!-- LOGIN DROPDOWN -->
<div class="login-box" id="loginMenu">
    <h3>Login As</h3>
    <a href="po_log.php">Programme Officer</a>
        <a href="sec_log.php">Secretary</a>
        <a href="vol_log.php">Volunteer</a>
    
</div>

<script>
function toggleLogin() {
    let box = document.getElementById("loginMenu");
    box.style.display = box.style.display === "block" ? "none" : "block";
}
document.addEventListener("click", function(e) {
    const loginBox = document.getElementById("loginMenu");
    const userIcon = document.querySelector(".top-bar a");
    if (!loginBox.contains(e.target) && !userIcon.contains(e.target)) {
        loginBox.style.display = "none";
    }
});
</script>

<!-- HEADER -->
<header>
    <img src="nss.png">
    <div class="college-text">
        <h1>National Service Scheme</h1>
        <h1>St. Joseph’s College</h1>
        <span>(Autonomous) – Tiruchirappalli</span>
    </div>
</header>

<!-- MAIN STRUCTURE -->
<div class="container">

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <ul>
            <li onclick="showTab('announcements')">Announcements</li>
            <li onclick="showTab('upcoming')">Upcoming Events</li>
            <li onclick="showTab('completed')">Completed Events</li>
            <li onclick="showTab('dates')">Dates to Remember</li>
            <li onclick="showTab('suggestions')">Give Suggestions</li>
            <li onclick="showTab('feedback')">Feedback</li>
            <li onclick="showTab('missingod')">Missing OD</li>
        </ul>
    </nav>

    <!-- CONTENT -->
    <main class="main-content">
        <!-- ANNOUNCEMENTS -->
        <div id="announcements" class="tab-content active">
    <h2>Announcements</h2>

    <?php
    include "db.php";

    $res = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo '
            <div class="notice">
                ' . htmlspecialchars($row['message']) . '<br>
                <small style="color:#555;">
                    ' . date("d M Y, h:i A", strtotime($row['created_at'])) . '
                </small>
            </div>';
        }
    } else {
        echo "<p>No announcements available</p>";
    }
    ?>
</div>

<!-- UPCOMING -->
        <div id="upcoming" class="tab-content">
    <h2>Upcoming Events</h2>

    <?php
    include "db.php";

    $res = $conn->query("SELECT * FROM upcoming_events ORDER BY created_at DESC");

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo "
            <div class='notice'>
                {$row['event']}<br>
                <small style='color:#555'>
                    " . date("d M Y, h:i A", strtotime($row['created_at'])) . "
                </small>
            </div>";
        }
    } else {
        echo "<p>No upcoming events</p>";
    }
    ?>
</div>

 <!-- COMPLETED -->
        <div id="completed" class="tab-content">
    <h2>Completed Events</h2>

    <?php
    $res = $conn->query("SELECT * FROM completed_events ORDER BY created_at DESC");

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo '
            <div class="notice">
                ' . htmlspecialchars($row['event']) . '<br>
                <small>' . date("d M Y, h:i A", strtotime($row['created_at'])) . '</small>
            </div>';
        }
    } else {
        echo "<p>No completed events</p>";
    }
    ?>
</div>

 <!-- DATES -->
        <div id="dates" class="tab-content">
    <h2>Dates to Remember</h2>

    <?php
    $res = $conn->query("SELECT * FROM important_dates ORDER BY created_at DESC");

    while ($row = $res->fetch_assoc()) {
        echo "<div class='notice'>
                {$row['event']}<br>
                <small>{$row['created_at']}</small>
              </div>";
    }
    ?>
</div>

<!--suggestions -->
        <div id="suggestions" class="tab-content">
    <h2>Suggestions</h2>

    <form method="post" action="">
        <div class="suggest-box">
            <textarea name="suggestion" placeholder="Enter suggestions..." required></textarea>
            <button type="submit" name="add_suggestion">Submit</button>
        </div>
    </form>
</div>

<!-- feedba -->

        <div id="feedback" class="tab-content">
    <h2>Feedback</h2>

    <form method="post" action="">
        <div class="feedback-box">
            <textarea name="feedback_msg" placeholder="Enter feedback..." required></textarea>
            <button type="submit" name="add_feedback">Submit</button>
        </div>
    </form>
</div>

<!-- od-->
        <div id="missingod" class="tab-content">
    <h2>Missing OD</h2>
    <div class="od-box">
        <form action="save_od.php" method="post">
            <input type="date" name="od_date" required>
            <input type="text" name="event_name" placeholder="Event Name" required>
            <textarea name="reason" placeholder="Reason..." required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

    </main>
</div>

<script>
function showTab(id) {
    document.querySelectorAll(".tab-content").forEach(tab =>
        tab.classList.remove("active")
    );
    document.getElementById(id).classList.add("active");
}
</script>

<!-- FOOTER -->
<footer>
    <center>
        <h3>NSS – St. Joseph's College</h3>
        <p>Tiruchirappalli, Tamil Nadu</p>
        <p>© 2025 All Rights Reserved.</p>
    </center>
</footer>

</body>
</html>
