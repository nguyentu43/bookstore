<?php
	if(isset($_SESSION['TaiKhoan']))
	{
		include_once("Model/HoaDon.php");
		include_once("Model/ChiTietHoaDon.php");

		$hd = new HoaDon();
		$cthd = new ChiTietHoaDon();

		$makh = $_REQUEST['makh'];

		$result_hd = $hd->LayHoaDonTheoMaKH($makh);

		for ($i=0; $i < count($result_hd); $i++) { 
			$result_hd[$i]['ChiTietHoaDon'] = $cthd->LayChiTietHoaDonTheoMa($result_hd[$i]['MAHD']);
		}
	}
	
	include_once("View/KhachHang/DonHangDaDat.php");
?>