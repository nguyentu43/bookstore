<?php
	$madms = $_GET['madms'];
	if(isset($_GET['btnSua']))
	{
		$tendms = $_GET['tendms'];
		include_once("Model/DanhMuc.php");
		$dms = new DanhMuc();
		$kq = $dms->CapNhatDanhMuc($madms, $tendms);
	}
	else
	{
		include_once("Model/DanhMuc.php");
		$dms = new DanhMuc();
		$result = $dms->LayDanhMucTheoMa($madms);
		$tendms = $result['TENDMS'];
	}

	include_once("View/DanhMuc/Sua.php");
?>