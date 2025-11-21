<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "tt_giangvien";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "<script>console.log('kết nối thành công');</script>";
}

echo "<script>console.log('kết nối thành công');</script>";

echo "Kết nối thành công!";
?>
