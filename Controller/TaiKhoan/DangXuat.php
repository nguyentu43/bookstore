<?php
	include_once("Model/TaiKhoan.php");

	$tk = new TaiKhoan();

	$tk->DangXuat();
	header("Location: admin.php");
?>