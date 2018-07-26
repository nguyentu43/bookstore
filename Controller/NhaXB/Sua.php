<?php
	if(isset($_GET['manxb']))
	{
		include_once("Model/NhaXB.php");
		$nxb = new NhaXB();
		$manxb = $_GET['manxb'];

		if(isset($_GET['tennxb']) && isset($_GET['diachi']))
		{
			if(isset($_GET['btnSua']))
			{
				$tennxb = $_GET['tennxb'];
				$diachi = $_GET['diachi'];
				$kq = $nxb->CapNhatNhaXB($manxb, $tennxb, $diachi);
			}
		}
		else
		{
			$result = $nxb->LayNhaXBTheoMa($manxb);
			$tennxb = $result['TENNXB'];
			$diachi = $result['DIACHI'];
		}

		include_once("View/NhaXB/Sua.php");
	}
?>