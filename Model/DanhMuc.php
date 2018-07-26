<?php
	include_once("DataProvider.php");
	class DanhMuc
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function LayDanhMuc(){
			$sql = "select * from danhmucsach";
			return $this->cn->FetchAll($sql);
		}

		function LayDanhMucTheoMa($id){
			$sql = "select * from danhmucsach where MADMS = $id";
			return $this->cn->Fetch($sql);
		}

		function ThemDanhMuc($tendms)
		{
			$sql = "INSERT INTO DANHMUCSACH(TENDMS) VALUES('$tendms')";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatDanhMuc($madms, $tendms)
		{
			$sql = "UPDATE DANHMUCSACH SET TENDMS = '$tendms' WHERE MADMS = $madms";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaDanhMuc($madms)
		{
			$sql = "DELETE FROM DANHMUCSACH WHERE MADMS = $madms";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>