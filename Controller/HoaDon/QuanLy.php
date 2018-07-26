<?php
	include_once("Model/HoaDon.php");
	$hd = new HoaDon();
	$result = $hd->LayHoaDon();
	include_once("View/HoaDon/QuanLy.php");
?>