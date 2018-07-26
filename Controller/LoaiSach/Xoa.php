<?php
	if(!empty($_GET['maloai']))
	{
		include_once("Model/LoaiSach.php");
		$dms = new LoaiSach();
		$kq = $dms->XoaLoaiSach($_GET['maloai']);
	}

	include_once("View/LoaiSach/Xoa.php");
?>