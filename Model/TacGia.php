<?php
	include_once("DataProvider.php");
	class TacGia
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function LayTacGia(){
			$sql = "SELECT * FROM TACGIA";
			return $this->cn->FetchAll($sql);
		}

		function LayTacGiaTheoMa($id){
			$sql = "SELECT * FROM TACGIA WHERE MATG = $id";
			return $this->cn->Fetch($sql);
		}

		function ThemTacGia($tentg, $gioithieu)
		{
			$sql = "INSERT INTO TACGIA(TENTG, GIOITHIEU) VALUES('$tentg', '$gioithieu')";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatTacGia($matg, $tentg, $gioithieu)
		{
			$sql = "UPDATE TACGIA SET TENTG = '$tentg', GIOITHIEU = '$gioithieu' WHERE MATG = $matg";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaTacGia($matg)
		{
			$sql = "DELETE FROM TACGIA WHERE MATG = $matg";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>