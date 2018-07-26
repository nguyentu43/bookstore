<?php
	include_once("DataProvider.php");
	class ThongKe
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function ThongKeTheoThang($month, $year){
			$sql = "SELECT NGAYHD, SUM(TONGTIEN) AS TONGHD, SUM(SOLUONG) AS SLSACHBAN FROM hoadon JOIN chitiethoadon ON hoadon.MAHD = chitiethoadon.MAHD WHERE MONTH(NGAYHD) = $month AND YEAR(NGAYHD) = $year GROUP BY NGAYHD
	";
			return $this->cn->FetchAll($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>