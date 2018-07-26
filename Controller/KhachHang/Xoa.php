<?php
	if(!empty($_GET['makh']))
	{
		include_once("Model/KhachHang.php");
		$kh = new KhachHang();
		$kq = $kh->XoaKhachHang($_GET['makh']);
	}

	include_once("View/KhachHang/Xoa.php");
?>