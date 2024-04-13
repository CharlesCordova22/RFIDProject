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
        // Function to handle image upload
        function handleImageUpload(event) {
            var file = event.target.files[0]; // Get the uploaded file
            if (file) {
                var reader = new FileReader();
                reader.readAsDataURL(file); // Read the file as data URL
                reader.onload = function() {
                    var imageDataURL = reader.result;
                    sendImageToServer(imageDataURL); // Send the image data to the server
                };
                reader.onerror = function(event) {
                    console.error("Error reading the file:", event.target.error);
                };
            }
        }

        // Function to send the captured image data to the server
        function sendImageToServer(imageDataURL) {
            $.ajax({
                type: "POST",
                url: "../backend/saveImage.php", // Path to your server-side script
                data: {
                    imageDataURL: imageDataURL
                },
                success: function(response) {
                    console.log("Image saved successfully.");
                    fetchAndProcessMessage(response); // Fetch message and process attendance after saving the image
                    window.location.href = '../pages/attendanceLog.php';
                },
                error: function(xhr, status, error) {
                    console.error("Error saving image: ", xhr.responseText);
                }
            });
        }

        // Function to fetch message from server and process attendance
        function fetchAndProcessMessage(filename) {
            $.ajax({
                url: "../backend/messageContainer.php",
                type: "POST",
                success: function(response) {
                    response = JSON.parse(response); // Parse JSON response
                    if (response.message === "Attendance recorded successfully!") {
                        console.log("Response received: ", response); // Log the response to the console
                        alert(response.message); // Display the message in an alert box
                        $('#captureImageButton').show(); // Show the capture image button after swiping the card
                        updateAttendance(filename, response.attendance_id); // Update attendance record with filename and student ID
                    } else if (response.message === "Time-out updated successfully!") {
                        let student_id = response.student_id;
                        window.location.href = '../pages/locationLogin.php?student_id=' + student_id;
                    } else {
                        // Handle other messages here
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: ", xhr.responseText);
                }
            });
        }

        // Function to update attendance record with the filename
        function updateAttendance(filename, attendance_id) {
            $.ajax({
                type: "POST",
                url: "../backend/updateAttendance.php", // Path to your server-side script for updating attendance
                data: {
                    filename: filename, // Pass the filename to updateAttendance.php
                    attendance_id: attendance_id // Pass the student ID to updateAttendance.php
                },
                success: function(response) {
                    console.log("Attendance record updated successfully.");
                },
                error: function(xhr, status, error) {
                    console.error("Error updating attendance: ", xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            // Initial fetch
            fetchAndProcessMessage('');

            // Periodically fetch message every 4 seconds
            setInterval(fetchAndProcessMessage, 4000);
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
            <!-- display messages -->
            <div class="message">
                <h6 id="getMessage"></h6>
            </div>
            <h3>SCAN HERE</h3>
        </div>
    </div>
    <div class="arrow-container">
        <div class="arrow-down"></div>
    </div>
    <!-- Button to capture image -->
    <div class="capture">
        <button id="captureImageButton" onclick="$('#imageFile').trigger('click');" style="display: none;">Capture Image</button>
    </div>
    <!-- File input to capture image -->
    <input type="file" id="imageFile" accept="image/*" capture="user" onchange="handleImageUpload(event)" style="display: none;" />
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>