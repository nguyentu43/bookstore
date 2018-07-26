<?php
	include_once("Model/DanhMuc.php");
	$dms = new DanhMuc();
	$result = $dms->LayDanhMuc();
	include_once("View/DanhMuc/QuanLy.php");
?>