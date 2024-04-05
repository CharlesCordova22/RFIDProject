<?php
require("../backend/local_setting.php");
$Write = "<?php " . "echo " . "'';" . " ?>";
file_put_contents('../backend/messageContainer.php', $Write);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/attendanceLog.css">
    <title>Attendance Log</title>
    <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getUID").load("../backend/UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("../backend/UIDContainer.php");
            }, 500);
        });
    </script>
</head>

<body>
    <div class="location-container">
        <div class="location">
            <h1>ATTENDANCE LOG</h1>
            <?php ?>
            <div class="date">
                <h6><?php echo date('F j, Y - l'); ?></h6>
            </div>
            <?php ?>
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
                $sql = "SELECT * FROM student_info JOIN attendance ON attendance.student_id = student_info.student_id";
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
                            <?php if($resultRow['status'] == 'entered') { ?>
                                <td><?php echo date('h:i A', strtotime($resultRow["time-in"])).' (IN)' ?></td>
                            <?php } else { ?>
                                <td><?php echo date('h:i A', strtotime($resultRow["time-in"])).' (EXIT)' ?></td>
                            <?php } ?>
                            <td><?php echo $resultRow["remarks"]  ?></td>
                            <td><?php echo $resultRow["location"]  ?></td>
                        </tr>
                <?php  }
                } ?>
            </table>
        </div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>