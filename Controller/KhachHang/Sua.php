<?php
	include_once("Model/KhachHang.php");
	$kh = new KhachHang();

	$makh = $_GET['makh'];
	if(isset($_GET['btnSua']))
	{
		$kq = $kh->CapNhatKhachHang($makh, $_GET['tenkh'], $_GET['diachi'], $_GET['sdt'], $_GET['email'], $_GET['gioitinh'], $_GET['ngaysinh']);
		if(isset($_GET['DatLaiMK']) && $_GET['DatLaiMK'] == 1)
		{
			$kh->DatLaiMatKhau($makh);
		}
	}
	else
	{
		$result = $kh->LayKhachHangTheoMa($makh);
	}

	include_once("View/KhachHang/Sua.php");
?>