<?php include "connect.php" ?>

<?php

$member_dir = "member_photo/";
$filem_id = uniqid(); // Unique file name for the uploaded image
$member_img = $member_dir . basename($filem_id . "_" . $_FILES["imgmember"]["name"]);

if (move_uploaded_file($_FILES["imgmember"]["tmp_name"], $member_img)) {
    // Insert the product data along with the image path into the database
    $stmt = $pdo->prepare("INSERT INTO member VALUES (?, ?, ? , ?, ?, ?,?,?)");

    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->bindParam(3, $_POST["name"]);
    $stmt->bindParam(4, $_POST["address"]);
    $stmt->bindParam(5, $_POST["mobile"]);
    $stmt->bindParam(6, $_POST["email"]);
    $stmt->bindParam(7, $member_img);
    $stmt->bindParam(8, $_POST["role"]);
    $stmt->execute();
    $username = $_POST["username"];

    // Redirect to the product page or show success message
    // echo "File uploaded and product saved successfully!";
    header("location:detailmember.php?username=".$username);
} else {
    echo "Failed to upload the image!";
}

