<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu"; // Thay 'ten_database' bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $user = $result->fetch_assoc();
        
        $_SESSION['user'] = $user;
        
            header("Location: index.php"); // Chuyển hướng đến trang dashboard hoặc trang chính của hệ thống
            
        
        exit();
    } else {
        // Đăng nhập thất bại
        echo "Username hoặc password không đúng";
    }
}

$conn->close();
?>