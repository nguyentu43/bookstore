<?php
	include_once("Model/LoaiSach.php");
	$ls = new LoaiSach();

	$maloai = $_GET['maloai'];
	if(isset($_GET['btnSua']))
	{
		$tenloai = $_GET['tenloai'];
		$kq = $ls->CapNhatLoaiSach($maloai, $tenloai);
	}
	else
	{
		$result = $ls->LayLoaiSachTheoMa($maloai);
		$tenloai = $result['TENLOAI'];
	}

	include_once("View/LoaiSach/Sua.php");
?>