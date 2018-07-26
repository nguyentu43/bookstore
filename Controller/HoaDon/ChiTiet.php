<?php
	include_once("Model/HoaDon.php");
	include_once("Model/ChiTietHoaDon.php");

	$hd = new HoaDon();
	$cthd = new ChiTietHoaDon();

	$result_hd = $hd->LayHoaDonTheoMa($_GET['mahd']);
	$result_cthd = $cthd->LayChiTietHoaDonTheoMa($_GET['mahd']);

	include_once("View/HoaDon/ChiTiet.php");
?>