<?php
	include_once("Model/Sach.php");

	include_once("Model/DanhMuc.php");

	$sach = new Sach();
	$dms = new DanhMuc();

	$result_dms = $dms->LayDanhMuc();

	$result_banchay = $sach->LaySachBanChay(0);
	$result_moixb = $sach->LaySachMoiXB(0, 0);

	for ($i=0; $i < count($result_dms); $i++) { 
		$result_dms[$i]['Sach'] = $sach->LaySachTheoDanhMucLimit($result_dms[$i]['MADMS']);
	}

	include_once("View/Sach/Sach_Top.php");
?>