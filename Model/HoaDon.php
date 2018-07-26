<?php
	include_once("DataProvider.php");
	class HoaDon
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function ThemHoaDon($makh, $tennn, $diachi, $sdt, $email, $tongtien){
			$sql = "INSERT INTO HOADON(MAKH, NGAYHD, TONGTIEN, TENNN, DIACHI, SDT, EMAIL) VALUES('$makh', CURDATE(), $tongtien, '$tennn', '$diachi', '$sdt', '$email')";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatHoaDon($mahd, $makh, $tennn, $diachi, $sdt, $email, $tongtien)
		{
			$sql = "UPDATE HOADON SET MAKH = $makh, TENNN = '$tennn', DIACHI = '$diachi', SDT = '$sdt', EMAIL = '$email', TONGTIEN = $tongtien WHERE MAHD = $mahd";
			return $this->cn->ExecuteQuery($sql);
		}

		function LayHoaDon()
		{
			$sql = "SELECT * FROM HOADON HD JOIN KHACHHANG KH ON HD.MAKH = KH.MAKH";
			return $this->cn->FetchAll($sql);
		}

		function LayHoaDonTheoMa($mahd)
		{
			$sql = "SELECT HD.MAHD, KH.MAKH, KH.TENKH, HD.TENNN, HD.DIACHI, HD.SDT, HD.EMAIL, HD.NGAYHD, TONGTIEN FROM HOADON HD JOIN KHACHHANG KH ON HD.MAKH = KH.MAKH WHERE MAHD = $mahd";
			return $this->cn->Fetch($sql);
		}

		function LayHoaDonTheoMaKH($makh)
		{
			$sql = "SELECT * FROM HOADON WHERE MAKH = $makh";
			return $this->cn->FetchAll($sql);
		}

		function XoaHoaDon($mahd)
		{
			$sql = "DELETE FROM HOADON WHERE MAHD = $mahd";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>