<?php
	include_once("Model/LoaiSach.php");
	$ls = new LoaiSach();
	$result = $ls->LayLoaiSach();
	include_once("View/LoaiSach/QuanLy.php");
?>