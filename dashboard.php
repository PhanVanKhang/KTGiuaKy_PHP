<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <p>Xin chào, <?php echo $_SESSION['role']; ?>!</p>
    <p>Đây là trang dashboard của bạn.</p>
    <p><a href="logout.php">Đăng xuất</a></p>
</body>
</html>
