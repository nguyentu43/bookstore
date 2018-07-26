<?php
	if(!isset($_REQUEST['btnTimKiem']))
	{
		include_once("Model/DanhMuc.php");
		include_once("Model/LoaiSach.php");
		include_once("Model/Sach.php");

		if(isset($_GET["madms"]) && $_GET["madms"] > 0)
		{
			$dms = new DanhMuc();
			$result_dms = $dms->LayDanhMucTheoMa($_GET['madms']);
		}

		if(isset($_GET["maloai"]))
		{
			$ls = new LoaiSach();
			$result_ls = $ls->LayLoaiSachTheoMa($_GET['maloai']);
		}

		if(isset($_GET["masach"]))
		{
			$s = new Sach();
			$result = $s->LaySachTheoMa($_GET["masach"]);
			$tensach = $result['TENSACH'];
		}
	}
	else
	{
		$timkiem = true;
	}

	include_once("View/Sach/Breadcrumb.php");
?>