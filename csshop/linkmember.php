<?php
include "connect.php";
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วและเป็น Admin หรือไม่
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    // ถ้าไม่ใช่แอดมิน ให้กลับไปที่หน้าเข้าสู่ระบบ
    header("Location: mpage.html");
    exit();
}
?>


</html>
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
        a.edit,
        a.delete {
            color: gray;
        }
    </style>
    <script src="mpage.js"></script>
    <script>
        function confirmDelete(username) { // ฟังก์ชนจะถูกเรียกถ้าผู้ใช ั คลิกที่ ้ link ลบ
            var ans = confirm("ต้องการลบข้อมูลสมาชิก " + username); // แสดงกล่องถามผู้ใช ้
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "deletemember.php?username=" + username; // สงรหัสส ่ นค ้าไปให ้ไฟล์ ิ delete.php
        }
    </script>
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
        <article class="list">
            <div style="display:block">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM member");
                $stmt->execute();
                ?>
                <?php while ($row = $stmt->fetch()) : ?>
                    <a href="detailmember.php?username=<?= $row['username'] ?>">
                        <img src='<?php
                                    if (isset($row["imgmember"])) echo $row["imgmember"];
                                    else echo "member_photo/" . $row["username"];
                                    ?>' width='100'>
                    </a>
                    ชื่อสมาชิก : <?= $row["name"] ?><br>
                    <a class="edit" href='formedit_member.php?username=<?= $row["username"] ?>'>แก้ไข</a> |
                    <a class="delete" href='#' onclick='confirmDelete("<?= $row["username"] ?>")'>ลบ</a>
                    <hr>
                <?php endwhile; ?>
            </div>
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