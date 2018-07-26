<?php
	include_once("DataProvider.php");
	class NhaXB
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function LayNhaXB(){
			$sql = "SELECT * FROM NHAXUATBAN";
			return $this->cn->FetchAll($sql);
		}

		function LayNhaXBTheoMa($id){
			$sql = "SELECT * FROM NHAXUATBAN WHERE MANXB = $id";
			return $this->cn->Fetch($sql);
		}

		function ThemNhaXB($tennxb, $diachi)
		{
			$sql = "INSERT INTO NHAXUATBAN(TENNXB, DIACHI) VALUES('$tennxb', '$diachi')";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatNhaXB($manxb, $tennxb, $diachi)
		{
			$sql = "UPDATE NHAXUATBAN SET TENNXB = '$tennxb', DIACHI = '$diachi' WHERE MANXB = $manxb";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaNhaXB($manxb)
		{
			$sql = "DELETE FROM NHAXUATBAN WHERE MANXB = $manxb";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>