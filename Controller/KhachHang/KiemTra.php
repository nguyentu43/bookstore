<?php
	if(isset($_REQUEST['Loai']))
	{
		$valid = false;

		if($_REQUEST['Loai'] == 'TenTK')
		{
			include_once(dirname(__DIR__)."/../Model/KhachHang.php");
			$kh = new KhachHang();

			if(!empty($_REQUEST['tentk']))
			{
				$ck = $kh->KiemTraTenTK($_REQUEST['tentk']);
				if($ck == 0)
					$valid = true;
			}
		}

		if($_REQUEST['Loai'] == 'MatKhauCu')
		{
			session_start();
			if(!empty($_REQUEST['matkhau_cu']))
			{
				if(isset($_SESSION['TaiKhoan']))
				{
					if($_SESSION['TaiKhoan']['MATKHAU'] == md5($_REQUEST['matkhau_cu']))
						$valid = true;
				}
			}
		}
		include_once(dirname(__DIR__)."/../View/KhachHang/KiemTra.php");
	}
?>