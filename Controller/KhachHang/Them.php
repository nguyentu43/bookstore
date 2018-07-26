<?php
	include_once("Model/KhachHang.php");
	$kh = new KhachHang();
	if(!empty($_GET['tenkh']))
	{
		$kq = $kh->ThemKhachHang($_GET['tenkh'], $_GET['diachi'], $_GET['sdt'], $_GET['email'], $_GET['gioitinh'], $_GET['ngaysinh'], $_GET['tentk'], $_GET['matkhau']);
		include_once("View/KhachHang/Them.php");
	}
?>