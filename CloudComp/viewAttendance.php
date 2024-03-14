<?php
    include "include.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dateCondition = $_POST['attendanceDate'];
        $roomCondition = $_POST['room'];

        $queryStudents = "SELECT StudentName FROM ( SELECT attendance_tbl.*, student_tbl.StudentName FROM attendance_tbl INNER JOIN student_tbl ON attendance_tbl.StudentID = student_tbl.StudentID) t1 WHERE Room = '$roomCondition' AND AttendanceDate = '$dateCondition' ORDER BY StudentName ASC";
        $students = mysqli_query($conn,$queryStudents);
    }

    $queryDate = "SELECT DISTINCT AttendanceDate  FROM attendance_tbl ORDER BY AttendanceDate ASC";
    $attendanceDate = mysqli_query($conn,$queryDate);

    $queryRoom = "SELECT DISTINCT Room FROM attendance_tbl ORDER BY Room ASC";
    $room = mysqli_query($conn,$queryRoom);
?>
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>View Attendance</title>
        <link rel="stylesheet" href="viewStyles.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="menubar">
            <div class="titleContainerView"></div>
            <button onclick="window.location.href='home.html';" class="homeBtn"></button>
            <button onclick="window.location.href='login.html';" class="logoutBtn"></button>
        </div>
        <form action="" method="post">
        <div class ="container">
            <div class="menuViewAttendance">
                <div class="containerTable">
                    <div class="row mt-5">
                        <div class="col">
                            <div class="card">  
                                <div class="card-header">
                                Attendance Date:     <input type="text" list="attendanceDate" autocomplete="off" id="pcategory" name="attendanceDate">
                                    <datalist id="attendanceDate">
                                        <?php while($row = mysqli_fetch_array($attendanceDate)) { ?>
                                        <option value="<?php echo $row['AttendanceDate']; ?>"><?php echo $row['AttendanceDate']; ?></option>
                                        <?php } ?>
                                     </datalist>
                                Room:     <input type="text" list="room" autocomplete="off" id="pcategory" name="room">
                                    <datalist id="room">
                                        <?php while($row = mysqli_fetch_array($room)) { ?>
                                        <option value="<?php echo $row['Room']; ?>"><?php echo $row['Room']; ?></option>
                                        <?php } ?>
                                     </datalist>         
                                     <button  name="search" action ="" method="post" type="submit" class="btn btn-success float-right">Search</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-center">  
                                        <tr class="bg-dark text-white">
                                            <td>Students who attended:</td>
                                        </tr>
                                        <tr>
                                        <?php
                                            while($row = mysqli_fetch_assoc($students)) {
                                        ?>      
                                            <td><?php echo $row['StudentName'];?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </divl>
                </div>
            </div>
            <!--<img class="logo" src="images/BSU.png" alt ="BSU Logo">-->
        </form>
        </div>
    </body>
</html>