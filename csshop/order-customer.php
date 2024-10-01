<?php
include "connect.php";
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วและเป็น Member หรือไม่
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Customer') {
    // ถ้าไม่ใช่สมาชิก ให้กลับไปที่หน้าเข้าสู่ระบบ
    header("Location: mpage.html");
    exit();
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <style>
        table {
            width: 80%; /* ความกว้างของตาราง */
            margin: 20px auto; /* จัดกลาง */
            border-collapse: collapse; /* รวมเส้นขอบ */
        }
        th, td {
            border: 1px solid #ddd; /* เส้นขอบ */
            padding: 8px; /* ระยะห่าง */
            text-align: left; /* จัดข้อความไปทางซ้าย */
        }
        th {
            background-color: #f2f2f2; /* สีพื้นหลังของหัวตาราง */
        }
        tr:hover {
            background-color: #f5f5f5; /* สีพื้นหลังเมื่อชี้เมาส์ */
        }
        .selectpro,
        .edit,
        .delete {
            color: #404040;
        }

        ul.member {
            padding: 0 1em;
            margin: 0;
        }

        ul.member li {
            padding: 5px 10px;
            border-bottom: solid 1px #ccddcc;
            font-size: small;
            list-style: none;
        }

        ul.member li:hover {
            background-color: #ccffcc;
        }

        ul.member li a {
            display: block;
        }

        ul.member li a {
            color: #404040;
        }

        ul.member li a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="mpage.js"></script>
</head>

<body>

    <header>
        <div class="logo">
            <img src="cslogo.jpg" width="200" alt="Site Logo">
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="Search the site...">
                <button>Search</button>
            </form>
        </div>
    </header>

    <div class="mobile_bar">
        <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
        <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
        <article>
            <h1>Order ของ <?= $_SESSION['username'] ?></h1>
            <?php
            $stmt = $pdo->prepare("SELECT orders.ord_id AS 'รหัสคำสั่งซื้อ',product.pname AS 'pname',quantity,(product.price * item.quantity)
             AS 'ราคารวม' FROM orders JOIN item ON orders.ord_id = item.ord_id JOIN product ON item.pid = product.pid WHERE orders.username = ? ");
            $stmt->bindParam(1, $_SESSION['username']);
            $stmt->execute();
            echo "<table class='order-table' border='1px'>";
            echo "<tr>";
            echo "<th>รหัสคำสั่งซื้อ</th>";
            echo "<th>ชื่อสินค้า</th>";
            echo "<th>จำนวน</th>";
            echo "<th>ราคารวม(บาท)</th>";
            echo "</tr>";
            while ($order = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $order["รหัสคำสั่งซื้อ"] . "</td>";
                echo "<td>" . $order["pname"] . "</td>";
                echo "<td>" . $order["quantity"] . "</td>";
                echo "<td>" . $order["ราคารวม"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            ?>

        </article>
        <nav id="menu">
            <h2>Menu</h2>
            <ul class="menu">
                <li class="dead"><a>Home</a></li>
                <li><a href="./allproduct.php">All Products</a></li>
                <li><a href="./cart.php">Cart</a></li>
                <li><a href="#">Order</a></li>
            </ul>
        </nav>
        <aside>
            <h2>List</h2>
            <ul class="member">
                <li><a href="./user-home.php">Back Home</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </aside>
    </main>
    <footer>
        <a href="#">Sitemap</a>
        <a href="#">Contact</a>
        <a href="#">Privacy</a>
    </footer>
</body>

</html>