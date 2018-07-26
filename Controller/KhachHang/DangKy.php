<?php
	include_once("Model/KhachHang.php");
	if(isset($_REQUEST['btnTaoTK']))
	{
		$kh = new KhachHang();
		$tenkh = $_REQUEST['tenkh'];
		$diachi = $_REQUEST['diachi'];
		$sdt = $_REQUEST['sdt'];
		$gioitinh = $_REQUEST['gioitinh'];
		$ngaysinh = $_REQUEST['ngaysinh'];
		$email = $_REQUEST['email'];
		$tentk = $_REQUEST['tentk'];
		$matkhau = $_REQUEST['matkhau'];

		if($matkhau != $_REQUEST['r_matkhau'])
		{
			$msg_err = "Mật khẩu nhập lại không trùng khớp";
		}
		else
		{
			$ck = $kh->KiemTraTenTK($tentk);

			if($ck === 0)
			{
				$kq = $kh->ThemKhachHang($tenkh, $diachi, $sdt, $email, $gioitinh, $ngaysinh, $tentk, $matkhau);
			}
			else
			{
				$msg_err = "Tên tài khoản nay đã có người sử dụng hay dùng tên khác";
			}
		}
	}

	include_once("View/KhachHang/DangKy.php");
?>