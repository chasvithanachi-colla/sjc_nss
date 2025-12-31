<?php
include "db.php";

$activeTab = $_POST['active_tab'] ?? $_GET['tab'] ?? 'announcement';

/* ---------- ANNOUNCEMENTS ---------- */
if (isset($_POST['add_announcement'])) {
    $msg = mysqli_real_escape_string($conn, $_POST['announcement']);
    $conn->query("INSERT INTO announcements (message) VALUES ('$msg')");
    header("Location: secretary_panel.php?tab=announcement");
    exit();
}

/* ---------- UPCOMING EVENTS ---------- */
if (isset($_POST['add_upcoming'])) {
    $event = mysqli_real_escape_string($conn, $_POST['upcoming_event']);
    $conn->query("INSERT INTO upcoming_events (event) VALUES ('$event')");
    header("Location: secretary_panel.php?tab=upcoming");
    exit();
}

/* ---------- COMPLETED EVENTS ---------- */
if (isset($_POST['add_completed'])) {
    $event = mysqli_real_escape_string($conn, $_POST['completed_event']);
    $conn->query("INSERT INTO completed_events (event) VALUES ('$event')");
    header("Location: secretary_panel.php?tab=completed");
    exit();
}

/* ---------- IMPORTANT DATES ---------- */
if (isset($_POST['add_date'])) {
    $event = mysqli_real_escape_string($conn, $_POST['date_event']);
    $conn->query("INSERT INTO important_dates (event) VALUES ('$event')");
    header("Location: secretary_panel.php?tab=dates");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>NSS – Secretary Panel</title>

<style>
    .od-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    margin-top:20px;
}

.od-table th{
    background:#630000;
    color:white;
    padding:12px;
    text-align:left;
}

.od-table td{
    padding:10px;
    border-bottom:1px solid #ccc;
}

.od-table tr:nth-child(even){
    background:#f9f9f9;
}

body{margin:0;font-family:Arial;background:#f5d36c;}
header{background:#8A0303;color:white;padding:15px;text-align:center;font-size:22px;}
nav{display:flex;flex-wrap:wrap;justify-content:space-around;background:#630000;padding:10px}
nav a{color:white;text-decoration:none;padding:8px 16px;border-radius:6px;cursor:pointer}
nav a:hover{background:white;color:black}
.section{display:none;padding:25px}
h2{color:#630000}
.card{background:white;padding:20px;border-radius:12px;margin-bottom:15px;box-shadow:0 3px 8px rgba(0,0,0,.2)}
input[type=text]{padding:6px;width:70%;border-radius:6px;border:1px solid #ccc}
button{padding:6px 14px;background:#630000;color:white;border:none;border-radius:6px;cursor:pointer}
</style>
</head>

<body>

<header>NSS – Secretary Panel</header>

<nav>
    <a onclick="showTab('announcement')">Announcements</a>
    <a onclick="showTab('upcoming')">Upcoming Events</a>
    <a onclick="showTab('completed')">Completed Events</a>
    <a onclick="showTab('dates')">Dates to Remember</a>
    <a onclick="showTab('gallery')">Photo Gallery</a>
    <a onclick="showTab('suggestions')">Suggestions</a>
    <a onclick="showTab('feedback')">Feedback</a>
    <a onclick="showTab('onduty')">ON DUTY</a>
</nav>

<!-- ANNOUNCEMENTS -->
<div id="announcement" class="section">
    <h2>📢 Announcements</h2>

    <!-- ADD ANNOUNCEMENT -->
    <form method="post" style="display:flex;gap:10px;margin-bottom:20px;">
        <input type="text"
               name="announcement"
               placeholder="Add new announcement"
               autocomplete="off"
               required
               style="flex:1;padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="add_announcement"
                style="background:#7a0000;color:#fff;border:none;padding:10px 16px;border-radius:6px;">
            Add
        </button>
    </form>

    <?php
    $res = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

    while ($row = $res->fetch_assoc()) {
    ?>
        <div class="card" style="position:relative;">

            <!-- DELETE BUTTON -->
            <a href="delete_announcement.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Delete this announcement?')"
               style="position:absolute;top:12px;right:12px;">
                <button type="button"
                        style="background:#b00000;color:white;border:none;
                               padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Delete
                </button>
            </a>

            <?= htmlspecialchars($row['message']) ?><br>
            <small><?= $row['created_at'] ?></small>
        </div>
    <?php } ?>
</div>


<!-- UPCOMING -->
<div id="upcoming" class="section">
    <h2>📅 Upcoming Events</h2>

    <!-- ADD UPCOMING EVENT -->
    <form method="post" style="display:flex;gap:10px;margin-bottom:20px;">
        <input type="text"
               name="upcoming_event"
               placeholder="Add upcoming event"
               required
               style="flex:1;padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="add_upcoming"
                style="background:#7a0000;color:#fff;border:none;
                       padding:10px 16px;border-radius:6px;">
            Add
        </button>
    </form>

    <?php
    $res = $conn->query("SELECT * FROM upcoming_events ORDER BY id DESC");

    while ($row = $res->fetch_assoc()) {
    ?>
        <div class="card" style="position:relative;">

            <!-- DELETE BUTTON -->
            <a href="delete_upcoming.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Delete this upcoming event?')"
               style="position:absolute;top:12px;right:12px;">
                <button type="button"
                        style="background:#b00000;color:white;border:none;
                               padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Delete
                </button>
            </a>

            <?= htmlspecialchars($row['event']) ?><br>
            <small><?= $row['created_at'] ?></small>
        </div>
    <?php } ?>
</div>

<!-- COMPLETED -->
<div id="completed" class="section">
    <h2>✅ Completed Events</h2>

    <!-- ADD COMPLETED EVENT -->
    <form method="post" style="display:flex;gap:10px;margin-bottom:20px;">
        <input type="text"
               name="completed_event"
               placeholder="Add completed event"
               required
               style="flex:1;padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="add_completed"
                style="background:#7a0000;color:#fff;border:none;
                       padding:10px 16px;border-radius:6px;">
            Add
        </button>
    </form>

    <?php
    $res = $conn->query("SELECT * FROM completed_events ORDER BY id DESC");

    while ($row = $res->fetch_assoc()) {
    ?>
        <div class="card" style="position:relative;">

            <!-- DELETE BUTTON -->
            <a href="delete_completed.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Delete this completed event?')"
               style="position:absolute;top:12px;right:12px;">
                <button type="button"
                        style="background:#b00000;color:white;border:none;
                               padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Delete
                </button>
            </a>

            <?= htmlspecialchars($row['event']) ?><br>
            <small><?= $row['created_at'] ?></small>
        </div>
    <?php } ?>
</div>


<!-- DATES -->
<div id="dates" class="section">
    <h2>📅 Dates to Remember</h2>

    <!-- ADD DATE EVENT -->
    <form method="post" style="display:flex;gap:10px;margin-bottom:20px;">
        <input type="text"
               name="date_event"
               placeholder="Add important date"
               required
               style="flex:1;padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="add_date"
                style="background:#7a0000;color:#fff;border:none;
                       padding:10px 16px;border-radius:6px;">
            Add
        </button>
    </form>

    <?php
    $res = $conn->query("SELECT * FROM important_dates ORDER BY id DESC");

    while ($row = $res->fetch_assoc()) {
    ?>
        <div class="card" style="position:relative;">

            <!-- DELETE BUTTON -->
            <a href="delete_date.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Delete this date?')"
               style="position:absolute;top:12px;right:12px;">
                <button type="button"
                        style="background:#b00000;color:white;border:none;
                               padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Delete
                </button>
            </a>

            <?= htmlspecialchars($row['event']) ?><br>
            <small><?= $row['created_at'] ?></small>
        </div>
    <?php } ?>
</div>


<!-- ================= GALLERY ================= -->
<div id="gallery" class="section" style="display:block;">
    <h2>Manage Photo Gallery</h2>

    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>

    <h3>Uploaded Images</h3>
    <div class="gallery-container">
    <?php
    $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
    ?>
        <div>
            <img src="<?= $row['image'] ?>">
            <br>
            <a href="delete_image.php?id=<?= $row['id'] ?>">
                <button class="delete-btn">Delete</button>
            </a>
        </div>
    <?php } ?>
    </div>
    </div>

<!-- ✅ SUGGESTIONS (FIXED) -->
<div id="suggestions" class="section">
<h2>📬 Volunteer Suggestions</h2>
<?php
$res=$conn->query("SELECT * FROM suggestions ORDER BY created_at DESC");
while($row=$res->fetch_assoc()){
    echo "<div class='card'>".htmlspecialchars($row['message'])."<br><small>{$row['created_at']}</small></div>";
}
?>
</div>

<!-- ✅ FEEDBACK -->
<div id="feedback" class="section">
<h2>📝 Student Feedback</h2>
<?php
$r=$conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
if($r->num_rows==0) echo "No feedback yet";
while($row=$r->fetch_assoc()){
echo "<div class='card'>".htmlspecialchars($row['message'])."<br>
<small>{$row['created_at']}</small></div>";
}
?>
</div>
 
<!-- ON DUTY -->
<div id="onduty" class="section">
    <h2>📝 ON DUTY</h2>

    <table class="od-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("SELECT * FROM missing_od ORDER BY created_at DESC");
        if ($res->num_rows == 0) {
            echo "<tr><td colspan='3'>No OD Requests</td></tr>";
        }
        while ($row = $res->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['od_date']}</td>
                <td>{$row['event_name']}</td>
                <td>{$row['reason']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>



<script>
function showTab(id){
    document.querySelectorAll('.section').forEach(s=>s.style.display='none');
    document.getElementById(id).style.display='block';
}
showTab("<?php echo $activeTab; ?>");
</script>

</body>
</html>
