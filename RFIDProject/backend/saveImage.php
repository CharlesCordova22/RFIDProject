<?php
// Check if the POST request contains image data
if (isset($_POST['imageDataURL'])) {
    // Get the image data
    $imageDataURL = $_POST['imageDataURL'];

    // Remove the data URI scheme and save the image data to a file
    $imageData = str_replace('data:image/png;base64,', '', $imageDataURL);

    $imageData = base64_decode($imageData);

    // Define the path where you want to save the image
    $uploadPath = '../images/'; // Example path

    $filename = $uploadPath . uniqid() . '.png';

    // Save the image to the file
    if (file_put_contents($filename, $imageData) !== false) {
        echo "Image saved successfully.";
    } else {
        echo "Error saving image.";
    }
} else {
    echo "No image data received.";
}
?>
