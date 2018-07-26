<?php
	if(!empty($_GET['matg']))
	{
		include_once("Model/TacGia.php");
		$tg = new TacGia();
		$kq = $tg->XoaTacGia($_GET['matg']);
	}

	include_once("View/TacGia/Xoa.php");
?>