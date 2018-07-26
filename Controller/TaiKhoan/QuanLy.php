<?php
	include_once("Model/TaiKhoan.php");

	$tk = new TaiKhoan();

	$result = $tk->LayTaiKhoan();

	include_once("View/TaiKhoan/QuanLy.php");
?>