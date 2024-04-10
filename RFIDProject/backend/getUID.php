<?php
require("./local_setting.php");

// to prevent SQL injection
function sanitizeInput($input)
{
	global $conn;
	return mysqli_real_escape_string($conn, $input);
}

// Check if the UID is not empty and sanitize input
if (!empty($_POST['tag'])) {
	$UIDresult = sanitizeInput($_POST['tag']);

	// Debugging: Log received UID
	file_put_contents("uid_log.txt", "Received UID: " . $UIDresult . PHP_EOL, FILE_APPEND);

	$sql = "SELECT * FROM student_info WHERE UID = '$UIDresult'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			// Student found
			while ($resultRow = mysqli_fetch_assoc($result)) {
				$student_id = $resultRow["student_id"];

				// Check if the student has already scanned in today
				$sqlCheckScan = "SELECT status FROM attendance WHERE `student_id` = '$student_id' AND DATE(`date`) = CURDATE() ORDER BY `time-in` DESC LIMIT 1";
				$resultCheckScan = mysqli_query($conn, $sqlCheckScan);

				$resultRow = mysqli_fetch_assoc($resultCheckScan);

				if ($resultRow['status'] == 'entered') {
					// The student has already scanned in today, update time-out
					file_put_contents("messageContainer.php", "<?php echo json_encode(array('student_id' => $student_id, 'message' => 'Time-out updated successfully!')); ?>");

					/*			$sqlUpdate = "UPDATE attendance SET `location` = 'Canteen'  WHERE `student_id` = '$student_id' AND DATE(`date`) = CURDATE()";
					$resultUpdate = mysqli_query($conn, $sqlUpdate);

					if ($resultUpdate) {
						file_put_contents("messageContainer.php", "<?php echo 'Time-out updated successfully!'; ?>");
						echo json_encode("Time-out updated successfully!");
					} else {
						echo json_encode("Failed to update time-out!");
					} */
				} else {
					// The student is scanning in for the first time today
					date_default_timezone_set('Asia/Manila');
					$current_time = date('H:i:s'); // Get current time
					$late_time = '07:15:00'; // Late time threshold

					if ($current_time <= $late_time) {
						$remarks = 'EARLY';
					} else {
						$remarks = 'LATE';
					}

					// Insert attendance record
					$sqlInsert = "INSERT INTO attendance (`student_id`, `time-in`, `date`, `location`, `remarks`, `status`)
                                  VALUES ('$student_id', NOW(), NOW(), 'ROOM', '$remarks', 'entered')";
					$resultInsert = mysqli_query($conn, $sqlInsert);

					if ($resultInsert) {
						file_put_contents("messageContainer.php", "<?php echo json_encode(array('student_id' => $student_id, 'message' => 'Attendance recorded successfully!')); ?>");
						echo json_encode("Attendance recorded successfully!");
					} else {
						echo json_encode("Failed to record attendance!");
					}
				}
			}
		} else {
			// No student found for the scanned RFID
			file_put_contents("messageContainer.php", "<?php echo json_encode(array('message' => 'No student found!')); ?>");
			echo json_encode("No student found for the scanned RFID");
		}
	} else {
		// Error in SQL query
		echo json_encode("Error: " . mysqli_error($conn));
	}
}

?>