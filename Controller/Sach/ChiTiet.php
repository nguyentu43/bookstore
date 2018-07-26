<?php
	if(isset($_GET['masach']))
	{
		$id = $_GET['masach'];
		include_once("Model/Sach.php");
		include_once("Model/DanhGia.php");
		$danhgia = new DanhGia();
		$sach = new Sach();
		$result = $sach->LaySachTheoMa($id);
		$list_book = $sach->LaySachTheoDanhMucLoai($_REQUEST['madms'], $_REQUEST['maloai']);

		if(isset($_SESSION['TaiKhoan']))
		{
			$r_diem = $danhgia->LayDanhGiaKH($id, $_SESSION['TaiKhoan']['MAKH']);
			$diem = $r_diem['DIEM'];
		}

		$r_danhgia = $danhgia->LayDanhGiaSach($id);

		if($r_danhgia['SL'] > 0)
		{
			$tongdiem = $r_danhgia['TONGDIEM'];
			$sl = $r_danhgia['SL'];
			$diemdg = round($tongdiem/$sl, 1);
		}

		if(count($list_book) < 1)
		{
			$list_book = $sach->LaySachTheoDanhMuc($_REQUEST['madms']);
		}
		
		include_once("View/Sach/ChiTiet.php");
	}
?>