<?php
	include_once("Model/TaiKhoan.php");

	$tk = new TaiKhoan();

	if($_REQUEST['matk'] == $_SESSION['TaiKhoan_QL']['MATK'] || $_REQUEST['matk'] == 1)
		$kq = false;
	else
		$kq = $tk->XoaTaiKhoan($_REQUEST['matk']);


	include_once("View/TaiKhoan/Xoa.php");
?>