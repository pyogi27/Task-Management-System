<?php
include 'db_connect.php';

$task = $_REQUEST['task'];
$description = $_REQUEST['description'];
$status = $_REQUEST['status'];
$val = $_REQUEST['val'];
$st = $_REQUEST['st'];

$pid = $_REQUEST['project_id'];
date_default_timezone_set('Asia/kolkata');
$dt = date('Y-m-d h:i:sa');
$upfor = $val . " " . $st . "s";
if ($st == 'hour') {
	$date = date('Y-m-d h:i:sa', strtotime($dt . ' + ' . $val . ' hours'));
} elseif ($st == 'day') {
	$date = date('Y-m-d h:i:sa', strtotime($dt . ' + ' . $val . ' days'));
}

$sql = "INSERT INTO task_list (`task`,`description`,`status`,`task_for`,`task_start`,`task_complete`,`date_created`,`project_id`)VALUES('$task','$description','$status','$upfor','$dt','$date','$dt','$pid')";
if (mysqli_query($conn, $sql)) {
	echo "Record Inserted Successfully";
}
