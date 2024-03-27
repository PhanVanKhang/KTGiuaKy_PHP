<?php
session_start();

// Hàm logout
function logout() {
    // Hủy session
    session_destroy();
    
    // Chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Xử lý đăng xuất khi người dùng nhấn nút "Đăng xuất"
if(isset($_POST['logout'])) {
    logout();
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="submit" name="logout" value="Đăng xuất">
</form>
