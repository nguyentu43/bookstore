<?php
	include_once("Model/NhaXB.php");
	$nxb = new NhaXB();
	if(!empty($_GET['tennxb']))
	{
		$kq = $nxb->ThemNhaXB($_GET['tennxb'], $_GET['diachi']);
		include_once("View/NhaXB/Them.php");
	}
?>