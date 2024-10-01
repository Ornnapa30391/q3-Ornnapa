<?php include "connect.php" ?>
<?php
// 1. ก าหนดค าสง

$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
$stmt->bindParam(1, $_GET["username"]); // 2. น าค่า pid ที่สงมากับ ่ URL ก าหนดเป็ นเงื่อนไข
$stmt->execute(); // 3. เริ่มค้นหา
$row = $stmt->fetch(); // 4. ดึงผลลัพธ์ (เนื่องจากมีข้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
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
            <form action="editmember.php" method="post" enctype="multipart/form-data">
                <img src='<?php
                            if (isset($row["imgmember"])) echo $row["imgmember"];
                            else echo "member_photo/" . $row["username"];
                            ?>' width='100'><br>
                <label for="imgmember">รูปโปรไฟล์ :</label>
                <input type="file" id="imgmember" name="imgmember" accept="image/jpg,image/jpeg,image/png"><br><br>
                username : <input type="text" name="username" value="<?= $row["username"] ?>"><br>
                password : <input type="password" name="password" value="<?= $row["password"] ?>"><br>
                ชื่อ : <input type="text" name="name" value="<?= $row["name"] ?>"><br>
                ที่อยู่ : <br>
                <textarea name="address" rows="3" cols="40"><?= $row["address"] ?></textarea><br>
                เบอร์โทร : <input type="tel" name="mobile" value="<?= $row["mobile"] ?>"><br>
                email : <input type="email" name="email" value="<?= $row["email"] ?>"><br>
                
                <input type="submit" value="แก้ไขข้อมูล">
            </form>
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