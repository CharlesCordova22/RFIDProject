<?php
require("./local_setting.php");

// to prevent SQL injection
function sanitizeInput($input)
{
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

// Check if the filename and student ID are received
if (isset($_POST['filename']) && isset($_POST['attendance_id'])) {
    $filename = $_POST['filename'];
    $attendance_id = $_POST['attendance_id'];

    // Sanitize input to prevent SQL injection
    $filename = sanitizeInput($filename);
    $attendance_id = sanitizeInput($attendance_id);

    // Update the attendance record with the filename
    $sql = "UPDATE attendance SET image = '$filename' WHERE id = '$attendance_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Attendance record updated successfully!";
    } else {
        echo "Failed to update attendance record!";
    }
} else {
    echo "Missing filename or student ID!";
}
?>