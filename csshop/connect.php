<?php
try {
	$pdo = new PDO("mysql:host=localhost; dbname=sec1_21; charset=utf8", "Wstd21", "KEJpfwHP");
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>
