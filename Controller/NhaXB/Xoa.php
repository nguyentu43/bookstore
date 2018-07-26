<?php
	if(!empty($_GET['manxb']))
	{
		include_once("Model/NhaXB.php");
		$nxb = new NhaXB();
		$kq = $nxb->XoaNhaXB($_GET['manxb']);
	}

	include_once("View/NhaXB/Xoa.php");
?>