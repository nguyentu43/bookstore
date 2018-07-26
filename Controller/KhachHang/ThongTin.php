<?php
	if(isset($_SESSION['TaiKhoan']))
	{
		$tk = $_SESSION['TaiKhoan'];

		if(isset($_REQUEST['btnSua']))
		{
			include_once("Model/KhachHang.php");

			$kh = new KhachHang();

			$tenkh = $_REQUEST['tenkh'];
			$diachi = $_REQUEST['diachi'];
			$email = $_REQUEST['email'];
			$sdt = $_REQUEST['sdt'];
			$ngaysinh = $_REQUEST['ngaysinh'];
			$gioitinh = $_REQUEST['gioitinh'];

			$kq = $kh->CapNhatKhachHang($tk['MAKH'], $tenkh, $diachi, $sdt, $email, $gioitinh, $ngaysinh);

			if($kq == true)
			{
				$_SESSION['TaiKhoan']['TENKH'] = $tenkh;
				$_SESSION['TaiKhoan']['DIACHI'] = $diachi;
				$_SESSION['TaiKhoan']['EMAIL'] = $email;
				$_SESSION['TaiKhoan']['SDT'] = $sdt;
				$_SESSION['TaiKhoan']['NGAYSINH'] = $ngaysinh;
				$_SESSION['TaiKhoan']['GIOITINH'] = $gioitinh;
			}

			if(!empty($_REQUEST['matkhau_cu']))
			{
				if(md5($_REQUEST['matkhau_cu']) == $tk['MATKHAU'])
				{
					$kq = $kh->DoiMatKhau($tk['MAKH'], $_REQUEST['matkhau']);
					if($kq == true)
					{
						$_SESSION['TaiKhoan']['MATKHAU'] = md5($_REQUEST['matkhau']);
					}
				}
				else
				{
					$error = true;
				}
			}
		}

		include_once("View/KhachHang/ThongTin.php");
	}
	else
		header("Location: index.php");
?>