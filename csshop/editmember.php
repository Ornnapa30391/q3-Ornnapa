<?php include "connect.php"; ?>

<?php
// กำหนดโฟลเดอร์เก็บรูปภาพ
$member_dir = "member_photo/";

// ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
if (!empty($_FILES["imgmember"]["name"])) {
    // สร้างชื่อไฟล์ใหม่เพื่อป้องกันการชนกัน
    $filem_id = uniqid();
    $member_img = $member_dir . $filem_id . "_" . $_FILES["imgmember"]["name"];

    // พยายามอัปโหลดไฟล์
    if (move_uploaded_file($_FILES["imgmember"]["tmp_name"], $member_img)) {
        // ถ้าอัปโหลดสำเร็จ ให้บันทึกพาธรูปใหม่
        $imgmember = $member_img;
    } else {
        echo "Failed to upload the image!";
        exit(); // จบการทำงานถ้าอัปโหลดไม่สำเร็จ
    }
} else {
    // ถ้าไม่มีการอัปโหลดรูปใหม่ ให้ใช้พาธรูปเก่า
    $stmt = $pdo->prepare("SELECT imgmember FROM member WHERE username = ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
    $imgmember = $row["imgmember"]; // ใช้พาธรูปเก่าจากฐานข้อมูล
}

// อัปเดตข้อมูลสมาชิกในฐานข้อมูล
$stmt = $pdo->prepare("UPDATE member SET  username = ?, password = ?, name = ?, address = ?, mobile = ?, email = ?, imgmember = ? WHERE username = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->bindParam(3, $_POST["name"]);
$stmt->bindParam(4, $_POST["address"]);
$stmt->bindParam(5, $_POST["mobile"]);
$stmt->bindParam(6, $_POST["email"]);
$stmt->bindParam(7, $imgmember);
$stmt->bindParam(8, $_POST["username"]); // ต้องการ bind username สำหรับเงื่อนไข WHERE

$stmt->execute();

// หลังจากแก้ไขเสร็จเรียบร้อย ให้เปลี่ยนเส้นทางไปที่หน้ารายละเอียดสมาชิก
header("location:detailmember.php?username=" . $_POST["username"]);
exit(); // จบการทำงานหลังจากเปลี่ยนเส้นทาง
?>
