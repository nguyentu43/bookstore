<?php
	include_once("Model/DanhMuc.php");
	$dms = new DanhMuc();
	if(!empty($_GET['tendms']))
	{
		$kq = $dms->ThemDanhMuc($_GET['tendms']);
		include_once("View/DanhMuc/Them.php");
	}
?>