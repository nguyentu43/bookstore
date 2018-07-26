<?php
	include_once("Model/TacGia.php");
	$tg = new TacGia();
	if(!empty($_GET['tentg']))
	{
		$kq = $tg->ThemTacGia($_GET['tentg'], $_GET['gioithieu']);
		include_once("View/TacGia/Them.php");
	}
?>