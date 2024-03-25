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
            $("#getUID").load("../backend/UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("../backend/UIDContainer.php");
            }, 500);
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
            <h3>SCAN HERE</h3>
        </div>
    </div>
    <div class="arrow-container">
        <div class="arrow-down"></div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>

</html>