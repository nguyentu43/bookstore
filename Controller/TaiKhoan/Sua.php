<?php
	include_once("Model/TaiKhoan.php");
	$tk = new TaiKhoan();

	$result = $tk->LayTaiKhoanTheoMa($_REQUEST['matk']);

	if(isset($_REQUEST['btnSua']))
	{
		$matk = $_REQUEST['matk'];
		$matkhau = $_REQUEST['matkhau'];
		$r_matkhau = $_REQUEST['r_matkhau'];
		$chucvu = $_REQUEST['chucvu'];

		$kq = $tk->CapNhatTaiKhoan($matk, $chucvu);

		if(!empty($_REQUEST['matkhau']))
		{
			$kq = $tk->DoiMatKhau($matk, $_REQUEST['matkhau']);
		}
	}

	include_once("View/TaiKhoan/Sua.php");
?>