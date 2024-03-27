<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: center;
            border: 1px solid #ccc;
        }
        .gender-image {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Danh sách nhân viên</h2>

    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ql_nhansu";

        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli($servername, $username, $password, $database);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Số nhân viên trên mỗi trang
        $records_per_page = 5;

        // Xác định trang hiện tại
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        // Tính offset (bắt đầu từ mục nào của kết quả)
        $offset = ($page - 1) * $records_per_page;

        // Truy vấn dữ liệu từ bảng NHANVIEN với số lượng bản ghi được giới hạn bởi số trang và offset
        $sql = "SELECT * FROM NHANVIEN LIMIT $offset, $records_per_page";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu từ mỗi hàng kết quả
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["Ma_NV"]."</td>";
                echo "<td>".$row["Ten_NV"]."</td>";
                echo "<td>";
                if ($row["Phai"] == "NU") {
                    echo "<img src='woman.jpg' alt='Woman' class='gender-image'>";
                } else {
                    echo "<img src='man.jpg' alt='Man' class='gender-image'>";
                }
                echo "</td>";
                echo "<td>".$row["Noi_Sinh"]."</td>";
                echo "<td>".$row["Ma_Phong"]."</td>";
                echo "<td>".$row["Luong"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có kết quả.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <?php
    // Hiển thị phân trang
    $conn = new mysqli($servername, $username, $password, $database);
    $sql = "SELECT COUNT(*) AS total FROM NHANVIEN";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $records_per_page);
    echo "<div>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=".$i."'>".$i."</a> ";
    }
    echo "</div>";
    ?>
</div>






</body>
</html>
