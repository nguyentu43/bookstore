<?php
	include_once("Model/KhachHang.php");
	include_once("Model/Sach.php");

	$kh = new KhachHang();
	$s = new Sach();

	$result_kh = $kh->LayKhachHang();
	$result_s = $s->LaySach();

	include_once("View/HoaDon/TaoMoi.php");
?>