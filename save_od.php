<?php
include "db.php";

$date=$_POST['od_date'];
$event=$_POST['event_name'];
$reason=$_POST['reason'];

$conn->query("INSERT INTO missing_od (od_date,event_name,reason)
              VALUES ('$date','$event','$reason')");

header("Location: vol.php?tab=missingod&msg=OD Request submitted successfully");
exit();
?>
