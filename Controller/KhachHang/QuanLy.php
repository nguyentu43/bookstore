<?php
	include_once("Model/KhachHang.php");
	$kh = new KhachHang();
	$result = $kh->LayKhachHang();
	include_once("View/KhachHang/QuanLy.php");
?>