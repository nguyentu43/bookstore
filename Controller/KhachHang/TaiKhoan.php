<?php
	if(isset($_REQUEST['btnDangXuat']))
	{
		include_once("Model/KhachHang.php");
		$kh = new KhachHang();
		$kh->DangXuat();
		header("Location: index.php".$_REQUEST['querystr']);
	}
	
	include_once("View/KhachHang/TaiKhoan.php");
?>