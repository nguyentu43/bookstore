<?php
	include_once(dirname(__DIR__)."/../Model/DanhGia.php");
	$danhgia = new DanhGia();

	if(isset($_REQUEST['DanhGia']))
	{
		session_start();
		if(isset($_SESSION['TaiKhoan']))
		{
			
				$diem = $_REQUEST['diem'];
				$masach = $_REQUEST['masach'];
				$makh = $_REQUEST['makh'];

				$r_danhgia = $danhgia->LayDanhGiaKH($masach, $makh);

				if(isset($r_danhgia))
				{
					$danhgia->CapNhatDanhGia($masach, $makh, $diem);
				}
				else
				{
					$danhgia->ThemDanhGia($masach, $makh, $diem);
				}

				$result['error'] = 0;
		}
		else
		{
			$result['error'] = 1;
		}
	}
	else if(isset($_REQUEST['XoaDanhGia']))
	{
		session_start();
		if(isset($_SESSION['TaiKhoan']))
		{
			$masach = $_REQUEST['masach'];
			$makh = $_REQUEST['makh'];

			$danhgia->XoaDanhGia($masach, $makh);

			$result['error'] = 0;
		}
		else
		{
			$result['error'] = 1;
		}
	}

	include_once(dirname(__DIR__)."/../View/Sach/DanhGia.php");
?>