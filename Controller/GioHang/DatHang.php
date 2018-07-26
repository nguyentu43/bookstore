<?php
	include_once("Model/Sach.php");
	include_once("Model/HoaDon.php");
	include_once("Model/ChiTietHoaDon.php");

	if(isset($_SESSION['GioHang']))
	{
		$result = array();

		$tonghd = 0;

		foreach ($_SESSION['GioHang'] as $id => $soluong) {
			$sach = new Sach();
			$row = $sach->LaySachTheoMa($id);
			$row['SoLuong'] = $soluong;
			$row['TongGia'] = $soluong * $row['GIABAN'];
			$tonghd += $row['TongGia'];
			array_push($result, $row);
		}
	}

	if(isset($_REQUEST['btnDatHang']))
	{
		if(count($result) > 0)
		{
			$tennn = $_REQUEST['tennn'];
			$diachi = $_REQUEST['diachi'];
			$sdt = $_REQUEST['sdt'];
			$email = $_REQUEST['email'];
			$makh = $_SESSION['TaiKhoan']['MAKH'];

			$hd = new HoaDon();
			$mahd = $hd->ThemHoaDon($makh, $tennn, $diachi, $sdt, $email, $tonghd);

			foreach ($result as $row) 
			{
				$cthd = new ChiTietHoaDon();
				$cthd->ThemChiTietHoaDon($mahd, $row['MASACH'], $row['SoLuong']);
			}

			unset($_SESSION['GioHang']);

			include_once("View/GioHang/DatHangThanhCong.php");
		}
	}
	else
	{
		if(isset($_SESSION['TaiKhoan']))
		{
			$tenkh = $_SESSION['TaiKhoan']['TENKH'];
			$diachi = $_SESSION['TaiKhoan']['DIACHI'];
			$sdt = $_SESSION['TaiKhoan']['SDT'];
			$email = $_SESSION['TaiKhoan']['EMAIL'];
		}

		include_once("View/GioHang/DatHang.php");
	}
?>