<?php
	include_once("Model/NhaXB.php");
	$nxb = new NhaXB();
	$result = $nxb->LayNhaXB();
	include_once("View/NhaXB/QuanLy.php");
?>