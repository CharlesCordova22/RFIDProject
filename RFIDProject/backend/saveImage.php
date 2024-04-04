<?php
// Check if the POST request contains image data
if (isset($_POST['imageDataURL'])) {
    // Get the image data
    $imageDataURL = $_POST['imageDataURL'];

    // Remove the data URI scheme and save the image data to a file
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageDataURL));

    // Define the path where you want to save the image
    $filePath = '../images/captured_image.png'; // Example path

    // Save the image to the file
    if (file_put_contents($filePath, $imageData)) {
        echo "Image saved successfully.";
    } else {
        echo "Error saving image.";
    }
} else {
    echo "No image data received.";
}
?>