<?php
// Check if the POST request contains image data
if (isset($_POST['imageDataURL'])) {
    // Get the image data
    $imageDataURL = $_POST['imageDataURL'];

    // Remove the data URI scheme and save the image data to a file
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageDataURL); // Change from PNG to JPEG
    $imageData = base64_decode($imageData);

    // Define the path where you want to save the image
    $uploadPath = '../images/'; // Example path

    // Ensure the directory exists
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $filename = $uploadPath . uniqid() . '.jpg'; // Change file extension to .jpg for JPEG format

    // Save the image to the file
    if (file_put_contents($filename, $imageData) !== false) {
        echo "Image saved successfully.";
    } else {
        echo "Error saving image.";
    }
} else {
    echo "No image data received.";
}
