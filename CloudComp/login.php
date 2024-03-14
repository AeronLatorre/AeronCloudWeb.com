<?php
    include "include.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM faculty_tbl WHERE FacultyUsername='$username' AND FacultyPassword='$password'";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            header("location: home.html");
        } else {
            
            die(header('refresh: 0.1; url=login.html').'<script type="text/javascript">alert("Invalid Credentials. Try Again.");</script>');
        }
    }
    
    $conn->close();
?>