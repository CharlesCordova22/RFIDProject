<?php
require("../backend/local_setting.php");

// Query to fetch the updated attendance log
$sql = "SELECT * FROM student_info JOIN attendance ON attendance.student_id = student_info.student_id WHERE date = CURDATE() ORDER BY attendance.`time-in` DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    // Query failed, handle the error
    echo "Error: " . mysqli_error($conn);
} else {
    // Query successful, construct the HTML content of the table
    $tableHTML = '<table>
                    <tr>
                        <th>IMAGE</th>
                        <th>STUDENT ID</th>
                        <th>SECTION</th>
                        <th>NAME</th>
                        <th>TIME</th>
                        <th>REMARKS</th>
                        <th>LOCATION</th>
                    </tr>';

    while ($resultRow = mysqli_fetch_assoc($result)) {
        $tableHTML .= '<tr class="' . (($resultRow["remarks"] == 'LATE') ? 'late' : (($resultRow["remarks"] == 'EARLY') ? 'early' : (($resultRow["remarks"] === '') ? 'empty' : ''))) . '">
                        <td>';
        // Check if the image field is empty
        if ($resultRow["image"] == '') {
            $tableHTML .= '';
        } else {
            $tableHTML .= '<img src="../images/' . $resultRow["image"] . '" alt="Attendance Image" width="100" height="100">';
        }
        $tableHTML .= '</td>
                        <td>' . $resultRow["student_id"] . '</td>
                        <td>' . $resultRow["section"] . '</td>
                        <td>' . $resultRow["name"] . '</td>';
        if ($resultRow['status'] == 'entered') {
            $tableHTML .= '<td>' . date('h:i A', strtotime($resultRow["time-in"])) . ' (IN)</td>';
        } else {
            $tableHTML .= '<td>' . date('h:i A', strtotime($resultRow["time-in"])) . ' (EXIT)</td>';
        }
        $tableHTML .= '<td>' . $resultRow["remarks"] . '</td>
                        <td>' . $resultRow["location"] . '</td>
                    </tr>';
    }

    $tableHTML .= '</table>';

    // Return the HTML content of the table
    echo $tableHTML;
}
?>