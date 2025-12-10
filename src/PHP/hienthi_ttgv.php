<?php
require 'libs.php';

// Kết nối CSDL
$db_connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($db_connect->connect_error) {
    die("Kết nối CSDL thất bại: " . $db_connect->connect_error);
}

// Lấy tất cả giảng viên
$sql = "SELECT TEN_GV, CHUC_VU, SO_NOI_BO, SO_DIEN_THOAI, MAIL, HINH_ANH FROM tt_gv";
$result = $db_connect->query($sql);

// Nếu có dữ liệu
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        // Đường dẫn đầy đủ tới ảnh
        $img_path = "../uploads/" . $row["HINH_ANH"];

        echo '
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card teacher-card">
            <img src="' . $img_path . '" class="card-img-top" alt="Ảnh giảng viên">
            <div class="card-body text-center">
              <h5 class="card-title">' . $row["TEN_GV"] . '</h5>
              <p class="card-text">
                  Chức vụ: ' . $row["CHUC_VU"] . '<br>
                  Số nội bộ: ' . $row["SO_NOI_BO"] . '<br>
                  Điện thoại: ' . $row["SO_DIEN_THOAI"] . '<br>
                  Email: ' . $row["MAIL"] . '
              </p>
              <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
            </div>
          </div>
        </div>
        ';
    }

} else {
    echo "<p>Không có giảng viên nào trong cơ sở dữ liệu.</p>";
}

// Đóng kết nối
$db_connect->close();
?>
