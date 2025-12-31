<?php
include "db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>NSS - St. Joseph's College</title>

<style>
    :root{
        --maroon:#6a0000;
        --dark-maroon:#600000;
        --yellow:#ffd94c;
        --bg:#f7d566;
    }
    *{box-sizing:border-box}
    body{
        margin:0;
        font-family:Arial, Helvetica, sans-serif;
        background:var(--bg);
        color:#222;
    }

    /* TOP BAR */
    .top-bar{
        background:var(--dark-maroon);
        color:#fff;
        height:52px;
        display:flex;
        align-items:center;
        justify-content:flex-end;
        padding:0 20px;
        gap:18px;
        position:relative;
    }
    .top-bar a{
        color:#fff; 
        font-size:20px; 
        text-decoration:none; 
        cursor:pointer;
    }

    /* LOGIN DROPDOWN */
    .login-box{
        display:none;
        position:absolute;
        right:20px;
        top:56px;
        width:220px;
        background:#fff;
        color:#111;
        border-radius:8px;
        box-shadow:0 4px 14px rgba(0,0,0,.18);
        padding:8px 0;
        z-index:50;
    }
    .login-box h3{
        margin:0;
        padding:8px 12px;
        color:var(--maroon);
        text-align:center;
        font-size:15px;
    }
    .login-box a{
        display:block;
        padding:10px 12px;
        color:#111;
        text-decoration:none;
        border-top:1px solid #eee;
    }
    .login-box a:first-of-type{border-top:none}
    .login-box a:hover{background:#faf2f2}

    /* HEADER */
    header{
        display:flex;
        gap:20px;
        align-items:center;
        background:var(--maroon);
        color:#fff;
        padding:14px 28px;
    }
    header img{
        height:92px;
        width:auto;
        border-radius:6px;
        padding:6px;
    }
    .college-text h1{margin:0;font-size:28px;line-height:1}
    .college-text h2{margin:0;font-size:20px;color:var(--yellow);font-weight:600}
    .college-text p{margin:4px 0 0 0;font-size:14px;}

    /* NAV */
    nav.header-nav{
        background:var(--maroon);
        display:flex;
        justify-content:flex-end;
        gap:22px;
        padding:10px 28px;
    }
    nav.header-nav a{
        color:#fff;
        text-decoration:none;
        font-weight:600;
        cursor:pointer;
        font-size:15px;
    }
    nav.header-nav a:hover{text-decoration:underline}

    /* Banner / Slider */
    .banner-section{
        width:100%;
        overflow:hidden;
        padding:28px 48px;
        background:transparent;
    }
    .banner-container{
        display:flex;
        width:200%;
        animation:slide 25s linear infinite;
    }
    .banner-container img{
        width:70%;
        height:550px;
        object-fit:cover;
        border-radius:8px;
        margin-right:12px;
    }
    @keyframes slide{
        0%{transform:translateX(0)}
        50%{transform:translateX(-50%)}
        100%{transform:translateX(0)}
    }

    /* MAIN LAYOUT */
    .layout{
        max-width:1100px;
        margin:28px auto;
        display:flex;
        gap:18px;
    }

    /* SIDEBAR */
    .sidebar{
        width:260px;
        background:#fff3e0;
        border-radius:8px;
        padding:8px 0;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
        height:fit-content;
    }
    .sidebar ul{list-style:none;margin:0;padding:0}
    .sidebar li{
        padding:14px 18px;
        color:var(--maroon);
        font-weight:600;
        cursor:pointer;
        border-bottom:1px solid #ffe9cf;
    }
    .sidebar li:hover{background:#ffe9cf}

    /* MAIN CONTENT */
    .main{
        flex:1;
        background:#fff;
        border-radius:8px;
        padding:18px;
        box-shadow:0 2px 10px rgba(0,0,0,.06);
    }
    .tab-content{display:none}
    .tab-content.active{display:block}
    h2.section-title{
        margin:6px 0 16px 0;
        color:var(--maroon);
    }
    .notice{
        background:#fff7ee;
        border-radius:8px;
        padding:14px;
        margin-bottom:14px;
        color:#4a0004;
        font-weight:600;
    }
    .notice a{
        color:#0b55d8;
        text-decoration:none;
    }
    .notice a:hover{text-decoration:underline}

    /* Gallery grid */
    .gallery-grid{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
    .gallery-grid img{
        width:260px;
        height:170px;
        object-fit:cover;
        border-radius:8px;
        box-shadow:0 2px 8px rgba(0,0,0,.12);
        cursor:pointer;
    }

    /* ABOUT box */
    .about-box{
        background:#fff7ee;
        border-radius:8px;
        padding:14px;
        margin-bottom:12px;
        line-height:1.5;
    }

    /* FOOTER */
    footer{
        background:var(--dark-maroon);
        color:#fff;
        padding:28px 16px;
        margin-top:20px;
    }
    footer .footer-inner{
        max-width:1100px;
        margin:0 auto;
        display:flex;
        gap:18px;
        flex-wrap:wrap;
        justify-content:space-between;
    }
    footer a{color:#ffd94c;text-decoration:none}

    @media (max-width:880px){
        .layout{flex-direction:column;padding:0 12px}
        .sidebar{width:100%;display:flex;overflow:auto}
        .sidebar ul{display:flex;gap:8px}
        .sidebar li{
            flex:0 0 auto;
            border-bottom:none;
            border-right:1px solid #ffe9cf;
            padding:12px 16px;
        }
        .banner-container img{height:160px}
    }
</style>
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <a onclick="toggleLogin()">👤 Login</a>
    </div>

    <!-- LOGIN DROPDOWN -->
    <div class="login-box" id="loginMenu">
        <h3>Login As</h3>
        <a href="po_log.php">Programme Officer</a>
        <a href="sec_log.php">Secretary</a>
        <a href="vol_log.php">Volunteer</a>
    </div>

    <!-- HEADER -->
    <header>
        <img src="College logo.png" alt="SJC Logo" />
        <div class="college-text">
            <h1>NATIONAL SERVICE SCHEME</h1>
            <h2>St. Joseph’s College</h2>
            <p style="color:#ffd94c">(Autonomous) — Tiruchirappalli, Tamil Nadu</p>
        </div>
    </header>

    <!-- NAV -->
    <nav class="header-nav">
        <a onclick="showTab('announcements')">Home</a>
        <a onclick="showTab('announcements')">Announcements</a>
        <a onclick="showTab('upcoming')">Upcoming Events</a>
        <a onclick="showTab('completed')">Completed Events</a>
        <a onclick="showTab('dates')">Dates to Remember</a>
        <a onclick="showTab('about')">About Us</a>
        <a onclick="showTab('gallery')">Photo Gallery</a>
    </nav>

    <!-- BANNER -->
    <div class="banner-section">
        <div class="banner-container">
            <img src="banner3.jpeg" alt="banner1" />
            <img src="banner2.jpeg" alt="banner2" />
            <img src="banner1.jpeg" alt="banner3" />
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <div class="layout">

        <aside class="sidebar">
            <ul>
                <li onclick="showTab('announcements')">Announcements</li>
                <li onclick="showTab('upcoming')">Upcoming Events</li>
                <li onclick="showTab('completed')">Completed Events</li>
                <li onclick="showTab('dates')">Dates to Remember</li>
                <li onclick="showTab('about')">About Us</li>
                <li onclick="showTab('gallery')">Photo Gallery</li>
            </ul>
        </aside>

        <main class="main">

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

            <!-- ABOUT -->
            <section id="about" class="tab-content">
                <h2 class="section-title">About Us</h2>

                <div class="about-box">
                    <strong>The National Service Scheme (NSS)</strong> at St. Joseph’s College
                    aims to develop the personality of students through community service.
                </div>

                <div class="about-box">
                    <ul>
                        <li>Awareness campaigns, health camps, environmental drives.</li>
                        <li>Annual 7-day special village camp.</li>
                        <li>Develop service-oriented student community.</li>
                    </ul>
                </div>
            </section>

            <!-- GALLERY -->
            <!-- GALLERY -->
<div id="gallery" class="tab-content">
    <h2 style="color:#7a0000;">Photo Gallery</h2>

    <div class="gallery-grid">
        <?php
        $res = $conn->query("SELECT * FROM gallery ORDER BY id DESC");

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                ?>
                <img 
                    src="<?php echo htmlspecialchars($row['image']); ?>" 
                    alt="Gallery Image"
                    onclick="openImage('<?php echo htmlspecialchars($row['image']); ?>')"
                >
                <?php
            }
        } else {
            echo "<p>No photos uploaded yet.</p>";
        }
        ?>
    </div>
</div>



        </main>
    </div>

    <!-- LIGHTBOX -->
    <div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);align-items:center;justify-content:center;z-index:80">
        <img id="lightboxImg" style="max-width:90%;max-height:85%;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,.6)" />
        <button onclick="closeLightbox()" style="position:fixed;top:18px;right:22px;background:#fff;border:none;padding:8px 12px;border-radius:6px;cursor:pointer;font-weight:700">Close</button>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div><img src="nss.png" style="width:120px" /></div>

            <div>
                <h3 style="color:#ffd94c">GET IN TOUCH</h3>
                <p><strong>📞 +91 431-2700320</strong></p>
                <p><strong>📧 nss@sjctni.edu</strong></p>
                <p>📍 St. Joseph's College, Trichy - 620002</p>
            </div>

            <div>
                <h3 style="color:#ffd94c">USEFUL LINKS</h3>
                <p><a href="#">NSS Handbook</a></p>
                <p><a href="#">Download Forms</a></p>
            </div>

            <div style="text-align:center">
                <h3 style="color:#ffd94c">CONNECT</h3>
                <p>
                    <a href="#"><img src="twitter.png" style="width:28px"></a>
                    <a href="#"><img src="facebook.png" style="width:28px"></a>
                    <a href="#"><img src="instagram.jpg" style="width:28px"></a>
                </p>
            </div>
        </div>

        <div style="text-align:center;background:#ffd94c;color:var(--dark-maroon);padding:10px;font-weight:700">
            © NSS - St. Joseph's College 2025. All Rights Reserved.
        </div>
    </footer>

<script>
    function toggleLogin(){
        const box = document.getElementById('loginMenu');
        box.style.display = box.style.display === 'block' ? 'none' : 'block';
    }

    document.addEventListener('click', function(e){
        const loginBox = document.getElementById('loginMenu');
        const userIcon = document.querySelector('.top-bar a');
        if(!loginBox.contains(e.target) && !userIcon.contains(e.target)){
            loginBox.style.display = 'none';
        }
    });

    /* ⭐ UPDATED FUNCTION WITH AUTO-SCROLL ⭐ */
    function showTab(tabId){
        document.querySelectorAll('.tab-content').forEach(s=>{
            s.classList.remove('active');
        });
        
        const section = document.getElementById(tabId);
        section.classList.add('active');

        // SCROLL DOWN TO CONTENT
        document.querySelector('.main').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function openImage(src){
        document.getElementById('lightbox').style.display='flex';
        document.getElementById('lightboxImg').src=src;
    }

    function closeLightbox(){
        document.getElementById('lightbox').style.display='none';
    }
</script>

</body>
</html>
