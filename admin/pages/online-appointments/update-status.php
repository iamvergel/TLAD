<?php
// Database connection
$host = 'localhost'; // Your database host
$dbname = 'smiles_db'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Set the timezone to Philippine Standard Time (PST)
    date_default_timezone_set('Asia/Manila');

    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the current time with 15ms added
    $currentTime = microtime(true); // Current time in seconds with microseconds
    $timeWith15ms = $currentTime + 0.015; // Add 15 milliseconds (0.015 seconds)
    
    // Convert the time into a format that MySQL understands (e.g., 'Y-m-d H:i:s')
    $currentTimeFormatted = date('Y-m-d H:i:s', floor($timeWith15ms));  // Base time (without ms)

    // Get the current time in 12-hour format (e.g., "10:20 AM")
    $currentTime12Hour = date("g:i A", floor($timeWith15ms)); // 'g:i A' gives 12-hour format with AM/PM

    // Retrieve the appointment's start time from the database
    $sql = "SELECT id, starttime FROM tblappointment WHERE status != 'Reschedule'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through each appointment to check if it's 15 minutes late
    foreach ($appointments as $appointment) {
        // Get the appointment's start time
        $appointmentStartTime = $appointment['starttime'];

        // Convert appointment start time to Unix timestamp
        $appointmentStartTimestamp = strtotime($appointmentStartTime);

        // Check if the appointment is 15 minutes late (900 seconds)
        if (($currentTime - $appointmentStartTimestamp) > 900) {
            // If the appointment is 15 minutes late, update the status to 'reschedule'
            $updateSql = "UPDATE tblappointment SET status = 'Reschedule' WHERE id = :id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':id', $appointment['id']);
            $updateStmt->execute();

            // Output the status change
            echo "Appointment ID " . $appointment['id'] . " has been rescheduled due to being 15 minutes late. Current time: " . $currentTime12Hour . "<br>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
