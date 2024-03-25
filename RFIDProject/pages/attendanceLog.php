<?php
// $attendanceData = array(
//     array(
//         'STUDENT_ID' => '23217755',
//         'SECTION' => 'ST12A6',
//         'NAME' => 'SILAY, HEAVEN HARLEY B.',
//         'TIME_IN' => '8:05 AM',
//         'DATE' => 'MARCH 25, 2024 - WEDNESDAY',
//         'REMARKS' => 'LATE'
//     ),
//     array(
//         'STUDENT_ID' => '23217756',
//         'SECTION' => 'ST12A7',
//         'NAME' => 'DOE, JOHN',
//         'TIME_IN' => '8:00 AM',
//         'DATE' => 'MARCH 26, 2024 - WEDNESDAY',
//         'REMARKS' => 'EARLY'
//     ),
// );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/attendanceLog.css">
    <title>Attendance Log</title>
</head>
<body>
    <div class="location-container">
        <div class="location">
            <h1>ATTENDANCE LOG</h1>
            <?php if (!empty($attendanceData)): ?>
                <div class="date">
                    <h6><?php echo $attendanceData[0]['DATE']; ?></h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-container">
        <div class="inner-container">
            <table>
                <tr>
                    <th>STUDENT ID</th>
                    <th>SECTION</th>
                    <th>NAME</th>
                    <th>TIME IN</th>
                    <th>REMARKS</th>
                </tr>
                <?php foreach ($attendanceData as $record): ?>
                <tr class="<?php echo ($record['REMARKS'] == 'LATE') ? 'late' : (($record['REMARKS'] == 'EARLY') ? 'early' : ''); ?>">
                    <td><?php echo $record['STUDENT_ID']; ?></td>
                    <td><?php echo $record['SECTION']; ?></td>
                    <td><?php echo $record['NAME']; ?></td>
                    <td><?php echo $record['TIME_IN']; ?></td>
                    <td><?php echo $record['REMARKS']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>
</html>