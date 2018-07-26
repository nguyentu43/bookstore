<?php
	if(isset($_GET["btnThongKe"]) && isset($_GET['thang']) && isset($_GET['nam']))
	{
		include_once("Model/ThongKe.php");
		$tk = new ThongKe();
		$result = $tk->ThongKeTheoThang($_GET['thang'], $_GET['nam']);
	}
	include_once("View/ThongKe/ThongKe.php");
?>