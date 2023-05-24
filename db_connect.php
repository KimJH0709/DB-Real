<?php
    function connectDB() {
        $conn = mysqli_connect("localhost", "root", "11111111", "stores");
        if (!$conn) {
            die("DB 연결 실패: " . mysqli_connect_error());
        }
        return $conn;
    }
?>

include 'db_connect.php';
$conn = connectDB();
