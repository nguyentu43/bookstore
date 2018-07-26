<?php
	include_once("Model/TacGia.php");
	$tg = new TacGia();
	$result = $tg->LayTacGia();
	include_once("View/TacGia/QuanLy.php");
?>