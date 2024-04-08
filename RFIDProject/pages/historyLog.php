<?php
require("../backend/local_setting.php");
$Write = "<?php " . "echo " . "'';" . " ?>";
file_put_contents('../backend/messageContainer.php', $Write);

// Get the date from the URL parameter or use the current date
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historyLog.css">
    <title>Attendance Log</title>
    <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getUID").load("../backend/UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("../backend/UIDContainer.php");
            }, 500);
        });

        // Function to navigate to the previous date
        function prevDate() {
            var currentDate = new Date("<?php echo $date; ?>");
            currentDate.setDate(currentDate.getDate() - 1);
            window.location.href = 'historyLog.php?date=' + currentDate.toISOString().split('T')[0];
        }

        // Function to navigate to the next date
        function nextDate() {
            var currentDate = new Date("<?php echo $date; ?>");
            currentDate.setDate(currentDate.getDate() + 1);
            window.location.href = 'historyLog.php?date=' + currentDate.toISOString().split('T')[0];
        }
    </script>
</head>

<body>
    <div class="location-container">
        <div class="location">
            <h1>ATTENDANCE LOG</h1>
            <div class="date">
                <div class="left">
                    <button onclick="prevDate()"><img src="../icons/left.svg" alt=""></button>
                </div>
                <div>
                    <h6><?php echo date('F j, Y - l', strtotime($date)); ?></h6>
                </div>
                <div class="right">
                    <button onclick="nextDate()"><img src="../icons/right.svg" alt=""></button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-container">
        <div class="inner-container">
            <table>
                <tr>
                    <th>STUDENT ID</th>
                    <th>SECTION</th>
                    <th>NAME</th>
                    <th>TIME</th>
                    <th>REMARKS</th>
                    <th>LOCATION</th>
                </tr>
                <?php
                $sql = "SELECT * FROM student_info JOIN attendance ON attendance.student_id = student_info.student_id WHERE DATE(attendance.date) = '$date' ORDER BY attendance.`time-in` DESC";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    // Query failed, handle the error
                    echo "Error: " . mysqli_error($conn);
                } else {
                    // Query successful, fetch and display data
                    while ($resultRow = mysqli_fetch_assoc($result)) {
                ?>
                        <tr class="<?php echo ($resultRow["remarks"] == 'LATE') ? 'late' : (($resultRow["remarks"] == 'EARLY') ? 'early' : (($resultRow["remarks"] === '') ? 'empty' : '')); ?>">
                            <td><?php echo $resultRow["student_id"] ?></td>
                            <td><?php echo $resultRow["section"]  ?></td>
                            <td><?php echo $resultRow["name"]  ?></td>
                            <?php if ($resultRow['status'] == 'entered') { ?>
                                <td><?php echo date('h:i A', strtotime($resultRow["date"])) . ' (IN)' ?></td>
                            <?php } else { ?>
                                <td><?php echo date('h:i A', strtotime($resultRow["date"])) . ' (EXIT)' ?></td>
                            <?php } ?>
                            <td><?php echo $resultRow["remarks"]  ?></td>
                            <td><?php echo $resultRow["location"]  ?></td>
                        </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>
