<?php
	include_once("DataProvider.php");
	class BinhLuan
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function LayBinhLuanTheoMa($masach)
		{
			$sql = "SELECT * FROM BINHLUAN WHERE MASACH = $masach";
			return $this->cn->FetchAll($sql);
		}

		function ThemBinhLuan($masach, $id, $parent, $created, $modified, $content, $fullname, $upvote_count)
		{
			if($parent == 0)
				$sql = "INSERT INTO BINHLUAN VALUES($masach, '$id', NULL, '$created', '$modified', '$content', '$fullname', $upvote_count)";
			else
				$sql = "INSERT INTO BINHLUAN VALUES($masach, '$id', '$parent', '$created', '$modified', '$content', '$fullname', $upvote_count)";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatBinhLuan($masach, $id, $parent, $created, $modified, $content, $fullname, $upvote_count)
		{
			$sql = "UPDATE BINHLUAN SET CREATED = '$created', MODIFIED = '$modified', CONTENT = '$content', FULLNAME = '$fullname', UPVOTE_COUNT = $upvote_count WHERE MASACH = $masach AND ID = '$id'";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaBinhLuan($masach, $id)
		{
			$sql = "DELETE FROM BINHLUAN WHERE MASACH = $masach AND ID = '$id' OR MASACH = $masach AND PARENT = '$id'";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>