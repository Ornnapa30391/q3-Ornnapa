<?php
session_start();
include 'connect.php';

    // ค้นหาผู้ใช้จากฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]); // ในทางปฏิบัติควรใช้ hashed password
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // เก็บข้อมูลผู้ใช้ใน session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // ตรวจสอบบทบาทของผู้ใช้
        if ($user['role'] == 'Admin') {
            // เปลี่ยนเส้นทางไปยังหน้าแอดมิน
            header("Location: admin-home.php");
        } else if ($user['role'] == 'Customer') {
            // เปลี่ยนเส้นทางไปยังหน้าสมาชิก
            header("Location: user-home.php");
        }
    } else {
        echo "Username or password incorrect!";
    }

?>

