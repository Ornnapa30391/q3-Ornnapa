<?php
include "connect.php";

$product_dir = "product_photo/";
$file_id = uniqid(); // Unique file name for the uploaded image
$product_img = $product_dir . basename($file_id . "_" . $_FILES["imgproduct"]["name"]); // Adding the original file name to the unique ID

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES["imgproduct"]["tmp_name"], $product_img)) {
    // Insert the product data along with the image path into the database
    $stmt = $pdo->prepare("INSERT INTO product (pid, pname, pdetail, price, imgproduct) VALUES (?, ?, ?, ?, ?)");

    $pid = (int)$_POST["pid"];
    $stmt->bindParam(1, $pid);
    
    $stmt->bindParam(2, $_POST["pname"]);
    $stmt->bindParam(3, $_POST["pdetail"]);

    $price = (int)$_POST["price"];
    $stmt->bindParam(4, $price);

    $stmt->bindParam(5, $product_img); // Save the full image path in the database
    $stmt->execute();

    // Redirect to the product page or show success message
    // echo "File uploaded and product saved successfully!";
    header("location:detailpro-admin.php?pid=".$pid);
} else {
    echo "Failed to upload the image!";
}
