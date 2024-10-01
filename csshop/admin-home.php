<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วและเป็น Admin หรือไม่
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    // ถ้าไม่ใช่แอดมิน ให้กลับไปที่หน้าเข้าสู่ระบบ
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
        .logout{
            color: royalblue;
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
            <h1>สวัสดี <?= $_SESSION["username"] ?></h1>
            welcome Admin
            หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'class="logout">ออกจากระบบ</a>
</article>
<nav id="menu">
    <h2>Menu</h2>
    <ul class="menu">
        <li class="dead"><a>Home</a></li>
        <li><a href="./updateproduct.php">All Products</a></li>
        <li><a href="./tableconnect.php">Table of All Products</a></li>
        <li><a href="./formproduct.html">InsertProduct</a></li>
        <!-- <li><a href="./formmember.html">InsertMember</a></li> -->
        <li><a href="./order-admin.php">Order</a></li>
        <!-- <li><a href="./cart.php">Cart</a></li> -->
        <!-- <li><a href="#">Page 07</a></li> -->
    </ul>
</nav>
<aside>
    <h2>List</h2>
    <ul class="member">
        <li><a href="./logout.php">Logout</a></li>
        <li><a href="./linkmember.php">View All Members</a></li>
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