<?php include "connect.php" ?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
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
    </style>
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
        <table>
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>รายละเอียดสินค้า</th>
            <th>ราคา</th>
        </tr>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM product ORDER BY pid ASC");
        $stmt->execute();
        while ($row = $stmt->fetch()) :
        ?>
            <tr>
                <td><?php echo $row["pid"] ?></td>
                <td><?php echo $row["pname"] ?></td>
                <td><?php echo $row["pdetail"] ?></td>
                <td><?php echo $row["price"] ?> บาท</td>
            </tr>

        <?php endwhile ?>
    </table>
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
            </ul>
      </nav>
      <aside>
      <h2>List</h2>
            <ul class="member">
            <li><a href="./admin-home.php">Back Home</a></li>
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