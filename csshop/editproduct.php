<?php include "connect.php"; ?>

<?php
// กำหนดโฟลเดอร์เก็บรูปภาพ
$product_dir = "product_photo/";

// ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
if (!empty($_FILES["imgproduct"]["name"])) {
    // สร้างชื่อไฟล์ใหม่เพื่อป้องกันการชนกัน
    $file_id = uniqid();
    $product_img = $product_dir . $file_id . "_" . $_FILES["imgproduct"]["name"]; // ไม่ต้องใช้ basename ที่นี่

    // พยายามอัปโหลดไฟล์
    if (move_uploaded_file($_FILES["imgproduct"]["tmp_name"], $product_img)) {
        // ถ้าอัปโหลดสำเร็จ ให้บันทึกพาธรูปใหม่
        // @unlink($imgproduct = $product_img);
        $imgproduct = $product_img;
    } else {
        echo "Failed to upload the image!";
        exit(); // จบการทำงานถ้าอัปโหลดไม่สำเร็จ
    }
} else {
    // ถ้าไม่มีการอัปโหลดรูปใหม่ ให้ใช้พาธรูปเก่า
    $stmt = $pdo->prepare("SELECT imgproduct FROM product WHERE pid = ?");
    $stmt->bindParam(1, $_POST["pid"]);
    $stmt->execute();
    $row = $stmt->fetch();
    $imgproduct = $row["imgproduct"]; // ใช้พาธรูปเก่าจากฐานข้อมูล
}

// อัปเดตข้อมูลสินค้าในฐานข้อมูล
$stmt = $pdo->prepare("UPDATE product SET pname = ?, pdetail = ?, price = ?, imgproduct = ? WHERE pid = ?");
$stmt->bindParam(1, $_POST["pname"]);
$stmt->bindParam(2, $_POST["pdetail"]);
$price = (int)$_POST["price"]; // ตรวจสอบประเภทข้อมูล price เป็น float
$stmt->bindParam(3, $price);
$stmt->bindParam(4, $imgproduct); // บันทึกพาธรูปใหม่หรือเก่า
$pid = (int)$_POST["pid"];
$stmt->bindParam(5, $pid, PDO::PARAM_INT);

$stmt->execute();

// หลังจากแก้ไขเสร็จเรียบร้อย ให้เปลี่ยนเส้นทางไปที่หน้ารายละเอียดสินค้า
header("Location: detailpro-admin.php?pid=" . $pid);
exit(); // จบการทำงานหลังจากเปลี่ยนเส้นทาง
?>
