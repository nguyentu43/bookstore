<?php
	include_once("Model/TaiKhoan.php");

	if(isset($_REQUEST['btnThem']))
	{

		$tk = new TaiKhoan();

		$tentk = $_REQUEST['tentk'];
		$matkhau = $_REQUEST['matkhau'];
		$r_matkhau = $_REQUEST['r_matkhau'];
		$chucvu = $_REQUEST['chucvu'];

		if($r_matkhau == $matkhau)
		{
			$f = $tk->KiemTraTenTK($tentk);

			if($f == 0)
				$kq = $tk->ThemTaiKhoan($tentk, $matkhau, $chucvu);
		}
		else
		{
			$f = -1;
		}
	}

	include_once("View/TaiKhoan/Them.php");
?>