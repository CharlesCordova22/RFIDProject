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
                    window.location.href = '../pages/attendanceLog.php';
                },
                error: function(xhr, status, error) {
                    console.error("Error saving image: ", xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            // Function to fetch message from server
            function fetchMessage() {
                $.ajax({
                    url: "../backend/messageContainer.php",
                    type: "POST",
                    success: function(response) {
                        response = JSON.parse(response); // Parse JSON response
                        if (response.message === "Attendance recorded successfully!") {
                            console.log("Response received: ", response); // Log the response to the console
                            $("#getMessage").html(response.message); // Update the message on the page
                            $('#captureImageButton').show(); // Show the capture image button after swiping the card
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

            // Initial fetch
            fetchMessage();

            // Periodically fetch message every 4 seconds
            setInterval(fetchMessage, 4000);
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
            <!-- Button to capture image -->
            <button id="captureImageButton" onclick="$('#imageFile').trigger('click');" style="display: none;">Capture Image</button>
            <!-- File input to capture image -->
            <input type="file" id="imageFile" accept="image/*" capture="user" onchange="handleImageUpload(event)" style="display: none;" />
        </div>
    </div>

    <div class="arrow-container">
        <div class="arrow-down"></div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>