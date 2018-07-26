<?php
	include_once("Model/LoaiSach.php");
	$ls = new LoaiSach();
	if(!empty($_GET['tenloai']))
	{
		$kq = $ls->ThemLoaiSach($_GET['tenloai']);
		include_once("View/LoaiSach/Them.php");
	}
?>