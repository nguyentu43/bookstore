<?php
	if(!empty($_GET['madms']))
	{
		include_once("Model/DanhMuc.php");
		$dms = new DanhMuc();
		$kq = $dms->XoaDanhMuc($_GET['madms']);
	}

	include_once("View/DanhMuc/Xoa.php");
?>