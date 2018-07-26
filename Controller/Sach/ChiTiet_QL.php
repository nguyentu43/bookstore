<?php
	if(isset($_REQUEST['masach']))
	{
		include_once("Model/Sach.php");
		$s = new Sach();
		$masach = $_REQUEST['masach'];
		$result = $s->LaySachTheoMa($masach);

		include_once("View/Sach/ChiTiet_QL.php");
	}
?>