<?php
	include_once("Model/TacGia.php");
	$tg = new TacGia();

	$matg = $_GET['matg'];
	if(isset($_GET['tentg']) && isset($_GET['gioithieu']))
	{
		$tentg = $_GET['tentg'];
		$gioithieu = $_GET['gioithieu'];
		$kq = $tg->CapNhatTacGia($matg, $tentg, $gioithieu);
	}
	else
	{
		$result = $tg->LayTacGiaTheoMa($matg);
		$tentg = $result['TENTG'];
		$gioithieu = $result['GIOITHIEU'];
	}

	include_once("View/TacGia/Sua.php");
?>