<?php
	include_once("Model/DanhMuc.php");
	include_once("Model/LoaiSach.php");
	include_once("Model/TacGia.php");
	include_once("Model/NhaXB.php");

	$dms = new DanhMuc();
	$list_dms = $dms->LayDanhMuc();

	$ls = new LoaiSach();
	$list_ls = $ls->LayLoaiSach();

	$tg = new TacGia();
	$list_tg = $tg->LayTacGia();

	$nxb = new NhaXB();
	$list_nxb = $nxb->LayNhaXB();

	include_once("View/Sach/TaoMoi.php");
?>