<?php
	include_once("Model/HoaDon.php");
	$hd = new HoaDon();
	$kq = $hd->XoaHoaDon($_GET['mahd']);
	include_once("View/HoaDon/Xoa.php");
?>