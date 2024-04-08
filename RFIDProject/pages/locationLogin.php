<?php 
    require("../backend/local_setting.php");

      // Initialize student_id
      $student_id = "";

      // Check if student_id exists in GET or POST parameters
      if(isset($_REQUEST['student_id'])){
          $student_id = $_REQUEST['student_id'];
      }
  
      if(isset($_POST['location'])){
          $locationValue = $_POST['location'];
  
          if($locationValue == 'COMFORT ROOM'){
              $sqlInsert2 = "INSERT INTO attendance (`student_id`, `time-in`, `date`, `location`, `remarks`, `status`)
              VALUES ('$student_id', NOW(), NOW(), 'COMFORT ROOM', '', 'exit')";
              $resultInsert2 = mysqli_query($conn, $sqlInsert2);
          }

        else if($locationValue == 'FACULTY'){
            $sqlInsert2 = "INSERT INTO attendance (`student_id`, `time-in`, `date`, `location`, `remarks`, `status`)
            VALUES ($student_id, NOW(), NOW(), 'FACULTY', '', 'exit')";
            $resultInsert2 = mysqli_query($conn, $sqlInsert2);
        }

        else if($locationValue == 'CLINIC'){
            $sqlInsert2 = "INSERT INTO attendance (`student_id`, `time-in`, `date`, `location`, `remarks`, `status`)
            VALUES ($student_id, NOW(), NOW(), 'CLINIC', '', 'exit')";
            $resultInsert2 = mysqli_query($conn, $sqlInsert2);
        }
        else if($locationValue == 'SCHOOL OFFICE'){
            $sqlInsert2 = "INSERT INTO attendance (`student_id`, `time-in`, `date`, `location`, `remarks`, `status`)
            VALUES ($student_id, NOW(), NOW(), 'SCHOOL OFFICE', '', 'exit')";
            $resultInsert2 = mysqli_query($conn, $sqlInsert2);
        }
        header("Location: attendanceLog.php");
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/locationLogin.css">
    <title>Location Logging</title>
</head>
<body>
    <div class="location-container">
        <div class="location">
            <h1>LOCATION LOGGING</h1>
        </div>
    </div>
    <div class="align-btn1">
        <div class="comfort">
            <form action="locationLogin.php" method="POST">
                <input type="hidden" name="location" value="COMFORT ROOM">
                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                <button><h1>COMFORT ROOM</h1></button>
            </form>
        </div>
        <div class="faculty">
            <form action="locationLogin.php" method="POST">
                <input type="hidden" name="location" value="FACULTY">
                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                <button><h1>FACULTY</h1></button>
            </form>
        </div>
    </div>
    <div class="align-btn2">
        <div class="clinic">
            <form action="locationLogin.php" method="POST">
                <input type="hidden" name="location" value="CLINIC">
                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                <button><h1>CLINIC</h1></button>
            </form>
        </div>
        <div class="office">
            <form action="locationLogin.php" method="POST">
                <input type="hidden" name="location" value="SCHOOL OFFICE">
                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                <button><h1>SCHOOL OFFICE</h1></button>
            </form>
        </div>
    </div>
    <?php include '../layout/bottomNavbar.php'; ?>
</body>
</html>