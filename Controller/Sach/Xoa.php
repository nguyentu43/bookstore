<?php
	if(isset($_REQUEST['masach']))
	{
		include_once("Model/Sach.php");
		$s = new Sach();
		$masach = $_REQUEST['masach'];
		$kq = $s->XoaSach($masach);

		include_once("View/Sach/Xoa.php");
	}
?>