<?php
session_start();
if (!isset($_SESSION['po_user'])) {
    header("Location: po_log.php");
    exit();
}
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>NSS – Programme Officer Panel</title>

<style>
body{margin:0;font-family:Arial;background:#f5d36c;}
header{background:#8A0303;color:white;text-align:center;padding:15px;font-size:22px;}
nav{display:flex;justify-content:space-around;background:#630000;padding:10px;}
nav a{color:white;text-decoration:none;padding:8px 16px;border-radius:6px;}
nav a:hover{background:white;color:black;}
.section{display:none;padding:25px;}
h2{color:#630000;}

.gallery-container{display:flex;gap:20px;flex-wrap:wrap;}
.gallery-container img{width:250px;height:180px;background:white;padding:5px;border-radius:10px;}

.delete-btn{background:#8A0303;color:white;border:none;padding:6px 12px;border-radius:6px;}

.card{background:white;border-radius:12px;padding:20px;margin-bottom:15px;}
</style>

<script>
function showTab(id){
    document.querySelectorAll('.section').forEach(s=>s.style.display='none');
    document.getElementById(id).style.display='block';
}
</script>
</head>

<body>

<header>NSS – Programme Officer Panel</header>

<nav>
    <a href="#" onclick="showTab('gallery')">Photo Gallery</a>
    <a href="#" onclick="showTab('suggestions')">Suggestions</a>
    <a href="#" onclick="showTab('feedback')">Feedback</a>
</nav>

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

<!-- ================= SUGGESTIONS ================= -->
<div id="suggestions" class="section">
    <h2>Student Suggestions</h2>

    <?php
    $res = $conn->query("SELECT * FROM suggestions ORDER BY id DESC");
    while ($row = $res->fetch_assoc()) {
        echo "<div class='card'>{$row['message']}</div>";
    }
    ?>
</div>

<!-- ================= FEEDBACK ================= -->
<div id="feedback" class="section">
    <h2>Student Feedback</h2>

    <?php
    $res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
    while ($row = $res->fetch_assoc()) {
        echo "<div class='card'>{$row['message']}</div>";
    }
    ?>
</div>

</body>
</html>
