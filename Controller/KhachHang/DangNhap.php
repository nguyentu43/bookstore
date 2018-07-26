<?php
	include_once("Model/KhachHang.php");

	if(isset($_REQUEST['btnDangNhap']))
	{
		$tentk = $_REQUEST['tentk'];
		$matkhau = $_REQUEST['matkhau'];

		$kh = new KhachHang();

		$kh->DangNhap($tentk, $matkhau);

		if(isset($_SESSION['TaiKhoan']))
		{
			$querystr = '';
			if(isset($_REQUEST['querystr']))
				$querystr = $_REQUEST['querystr'];
			header("Location: index.php".$querystr);
		}
		else
		{
			$login_fail = true;
		}
	}

	include_once("View/KhachHang/DangNhap.php");
?>