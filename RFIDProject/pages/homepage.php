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
            // Function to fetch message from server
            function fetchMessage() {
                $.ajax({
                    url: "../backend/messageContainer.php",
                    type: "POST",
                    success: function(response) {
                        if (response.message === "Attendance recorded successfully!") {
                            console.log("Response received: ", response); // Log the response to the console
                            $("#getMessage").html(response); // Update the message on the page
                            captureImage(); // Capture image after swiping the card
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

            function captureImage() {
                var video = document.createElement('video');
                var canvas = document.getElementById('canvas');
                var context = canvas.getContext('2d');

                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: 'user'
                        }
                    })
                    .then(function(stream) {
                        video.srcObject = stream;
                        video.play();

                        // After a short delay, capture a frame from the video stream
                        setTimeout(function() {
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            var imageDataURL = canvas.toDataURL('image/png');

                            // Send the captured image data to the server
                            sendImageToServer(imageDataURL);

                            // Stop video stream and remove video element
                            video.srcObject.getTracks().forEach(track => track.stop());
                            video.remove();
                        }, 1000); // Delay in milliseconds before capturing the image
                    })
                    .catch(function(error) {
                        console.error('Error accessing camera: ', error);
                    });
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
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saving image: ", xhr.responseText);
                    }
                });
            }


            // Initial fetch
            fetchMessage();

            // Periodically fetch message every 3 seconds
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