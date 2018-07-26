<?php
	include_once("Model/TaiKhoan.php");

	if(isset($_REQUEST['btnDangNhap']))
	{
		$tk = new TaiKhoan();
		$tentk = $_REQUEST['tentk'];
		$matkhau = $_REQUEST['matkhau'];

		$tk->DangNhap($tentk, $matkhau);

		if(isset($_SESSION['TaiKhoan_QL']))
			header('Location: admin.php');

		$login_fail = true;
	}

	include_once("View/TaiKhoan/DangNhap.php");
?>