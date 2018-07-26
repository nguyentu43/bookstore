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
	$dms_id = 0;
	$ls_id = 0;

	if(isset($_REQUEST['tensach']))
		$tensach = $_REQUEST['tensach'];

	if(isset($_REQUEST['madms']))
		$dms_id = $_REQUEST['madms'];

	if(isset($_REQUEST['maloai']))
		$ls_id = $_REQUEST['maloai'];

	$result = $sach->LaySachTheoTenDanhMucLoai($tensach, $dms_id, $ls_id);

	include_once("View/Sach/QuanLy.php");
?>