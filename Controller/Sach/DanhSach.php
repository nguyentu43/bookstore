<?php
	include_once("Model/Sach.php");
	include_once("Model/DanhMuc.php");
	include_once("Model/LoaiSach.php");

	$sach = new Sach();
	$dms = new DanhMuc();
	$ls = new LoaiSach();

	$result_dms = $dms->LayDanhMuc();
	$result_ls = $ls->LayLoaiSach();

	$tensach = '';
	$tentg = '';
	$dms_id = 0;
	$ls_id = 0;
	$gia1 = -1;
	$gia2 = -1;
	$sapxep = 0;

	$offset = 0;

	if(isset($_GET['offset']))
	{
		$offset = $_GET['offset'];
	}

	if(isset($_GET['tensach']))
	{
		$tensach = $_GET['tensach'];
	}

	if(isset($_GET['tentg']))
	{
		$tentg = $_GET['tentg'];
	}

	if(isset($_GET['madms']))
	{
		$dms_id = $_GET['madms'];
	}

	if(isset($_GET['maloai']))
	{
		$ls_id= $_GET['maloai'];
	}

	if(!empty($_GET['gia1']) && !empty($_GET['gia2']))
	{
		$gia1 = $_GET['gia1'];
		$gia2 = $_GET['gia2'];
	}

	if(isset($_GET['sapxep']))
	{
		$sapxep = $_GET['sapxep'];
	}

	if(isset($_GET['top']))
	{
		if($_GET['top'] == 'banchay')
		{
			$result = $sach->LaySachBanChay($sapxep);
		}
		else if($_GET['top'] == 'moixb')
		{
			$count_book = count($sach->LaySachMoiXB($sapxep, -1));
			$result=$sach->LaySachMoiXB($sapxep, $offset);
		}
	}
	else
	{
		$count_book = count($sach->LaySachTheoYeuCau($tensach, $tentg, $dms_id, $ls_id, $gia1, $gia2, $sapxep, -1));
		$result = $sach->LaySachTheoYeuCau($tensach, $tentg, $dms_id, $ls_id, $gia1, $gia2, $sapxep, $offset);
	}

	include_once("View/Sach/DanhSach.php");
?>