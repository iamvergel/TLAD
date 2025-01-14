<?php
include('../../config/dbconn.php');
header('Content-Type: application/json');

// Example query to fetch notifications from the database
$sql = "SELECT message, timestamp FROM notifications WHERE status = 'unread'";
$query_run = mysqli_query($conn, $sql);

$notifications = [];
while ($row = mysqli_fetch_assoc($query_run)) {
    $notifications[] = [
        'message' => $row['message'],
        'time' => $row['timestamp']
    ];
}

echo json_encode([
    'notification' => $notifications,
    'unseen_notification' => count($notifications)
]);
?>
