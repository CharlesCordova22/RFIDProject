<?php
$Write = "<?php " . "echo " . "'';" . " ?>";
file_put_contents('../backend/messageContainer.php', $Write);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/homepage.css">
    <title>Homepage</title>
    <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchMessage() {
                $.ajax({
                    url: "../backend/messageContainer.php",
                    type: "POST",
                    success: function(response) {
                        if (response.message === "Attendance recorded successfully!") {
                            console.log("Response received: ", response); // Log the response to the console
                            $("#getMessage").html(response); // update the message on the page
                        } else if (response.message === "Time-out updated successfully!") {
                            let student_id = response.student_id;
                            window.location.href = '../pages/locationLogin.php?student_id=' + student_id;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: ", xhr.responseText);
                    }
                });
            }


            // Initial fetch
            fetchMessage();

            // Periodically fetch UID every 3 seconds
            setInterval(fetchMessage, 3000);
        });
    </script>
</head>

<body>
    <div class="main-container">
        <div class="logo-name">
            <div class="use-logo">
                <h1>ATTENDIFY</h1>
            </div>
            <div class="use-text">
                <p>USE ATTENDIFY TO SCAN YOUR ATTENDANCE</p>
            </div>
        </div>
    </div>
    <div class="scan-container">
        <div class="scan-name">
            <h6 id="getMessage"></h6>
            <h3>SCAN HERE</h3>
        </div>
    </div>
    <div class="arrow-container">
        <div class="arrow-down"></div>
    </div>
    <div id="scanMessage"></div> <!-- Placeholder for scan message -->
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>