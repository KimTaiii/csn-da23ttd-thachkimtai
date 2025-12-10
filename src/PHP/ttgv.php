<?php
require 'libs.php';

$input_fullname = $_POST["fullname"];
$input_position = $_POST["position"];
$input_internal = $_POST["internal"];
$input_phone = $_POST["phone"];
$input_email = $_POST["email"];

// Xử lý hình ảnh upload
$input_image     = $_FILES["image"]["name"];        // tên file gốc
$image_tmp       = $_FILES["image"]["tmp_name"];    // đường dẫn tạm thời
$image_folder    = "../uploads/";                      // thư mục lưu ảnh

// Tạo tên file mới tránh trùng lặp (timestamp + random)
$image_new_name = time() . "_" . rand(10000, 99999) . "_" . $input_image;

// Tạo folder nếu chưa có
if (!file_exists($image_folder)) {
    mkdir($image_folder, 0777, true);
}

// Di chuyển ảnh vào thư mục uploads
if (!move_uploaded_file($image_tmp, $image_folder . $image_new_name)) {
    echo "Lỗi: Không thể upload ảnh!";
    exit();
}

// Kết nối CSDL
$db_connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); // Tạo kết nối đến CSDL

// Kiểm tra kết nối
if($db_connect->connect_error) {
    echo "Kết nối CSDL: Lỗi kết nối!<br>";
} else {
    echo "Kết nối CSDL: Kết nối thành công!<br>";
}

// Lệnh SQL
// Lệnh SQL (thêm cột HINH_ANH)
$db_sql = "INSERT INTO tt_gv(TEN_GV, CHUC_VU, SO_NOI_BO, SO_DIEN_THOAI, MAIL, HINH_ANH)
           VALUES ('$input_fullname', '$input_position', '$input_internal', '$input_phone', '$input_email', '$image_new_name')";

// Tạo truy vấn. Nếu lỗi, dừng chương trình.
$stmt = $db_connect->prepare($db_sql);
if (!$stmt) {
    consolePrint("Lỗi chuẩn bị truy vấn");
    return false;
}

// Thực hiện truy vấn. Nếu có lỗi, báo lỗi.
$stmt->execute();
if (!$stmt) {
    die('Prepare error: ' . $db_connect->error);
}

// Đóng truy vấn, dừng chương trình.
$stmt->close();
return false;
?>