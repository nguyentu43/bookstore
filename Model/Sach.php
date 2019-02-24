<?php
	include_once("DataProvider.php");
	define("ITEMS_PAGE", 9, true);
	
	class Sach
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function LaySach(){
			$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG";
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoDanhMuc($id)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON S.MATG = TG.MATG WHERE MADMS = $id";
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoDanhMucLimit($id)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON S.MATG = TG.MATG WHERE MADMS = $id LIMIT ".ITEMS_PAGE;
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoTenDanhMucLoai($tensach, $dms, $ls)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON S.MATG = TG.MATG JOIN DANHMUCSACH DMS ON DMS.MADMS = S.MADMS JOIN LOAISACH LS ON LS.MALOAI = S.MALOAI WHERE S.TENSACH LIKE '%$tensach%'";
			if($dms > 0)
				$sql.=" AND S.MADMS = $dms";
			if($ls > 0)
				$sql.=" AND S.MALOAI = $ls";
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoLoai($id)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON S.MATG = TG.MATG WHERE MALOAI = $id";
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoDanhMucLoai($dms, $ls)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON S.MATG = TG.MATG WHERE MALOAI = $ls and MADMS = $dms";
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoMa($id)
		{
			$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN DANHMUCSACH DMS ON S.MADMS = DMS.MADMS JOIN LOAISACH LS ON LS.MALOAI = S.MALOAI WHERE S.MASACH = $id";
			return $this->cn->Fetch($sql);
		}

		function LaySachTheoTenSachTacGia($tensach, $tentg)
		{
			$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE TENSACH = '$tensach' OR TENTG = '$tentg'";
			return $this->cn->FetchAll($sql);
		}

		function LaySachMoiXB($orderby, $offset)
		{
			if($orderby = -1)
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE DATEDIFF(CURDATE(), NGAYXB) <= 30 ORDER BY GIABAN DESC";
			}
			else if ($orderby = 1) 
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE DATEDIFF(CURDATE(), NGAYXB) <= 30 ORDER BY GIABAN";
			}
			else
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE DATEDIFF(CURDATE(), NGAYXB) <= 30";
			}

			if($offset > -1)
				$sql .=" LIMIT ".ITEMS_PAGE." OFFSET $offset";
			return $this->cn->FetchAll($sql);
		}

		function LaySachBanChay($orderby)
		{
			if($orderby = -1)
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE MASACH IN (SELECT MASACH FROM CHITIETHOADON GROUP BY MASACH ORDER BY COUNT(SOLUONG) DESC) ORDER BY GIABAN DESC LIMIT 9
";
			}
			else if ($orderby = 1) 
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE MASACH IN (SELECT MASACH FROM CHITIETHOADON GROUP BY MASACH ORDER BY COUNT(SOLUONG) DESC) ORDER BY GIABAN LIMIT 9
";
			}
			else
			{
				$sql = "SELECT * FROM SACH S JOIN TACGIA TG ON S.MATG = TG.MATG JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB WHERE MASACH IN (SELECT MASACH FROM CHITIETHOADON GROUP BY MASACH ORDER BY COUNT(SOLUONG) DESC) LIMIT 9
";
			}
			return $this->cn->FetchAll($sql);
		}

		function LaySachTheoYeuCau($tensach, $tentg, $dms, $ls, $gia1, $gia2, $sapxep, $offset)
		{
			$sql = "SELECT * FROM SACH S JOIN NHAXUATBAN NXB ON S.MANXB = NXB.MANXB JOIN TACGIA TG ON TG.MATG = S.MATG JOIN DANHMUCSACH DMS ON S.MADMS = DMS.MADMS JOIN LOAISACH LS ON LS.MALOAI = S.MALOAI";

			$sql.= " WHERE S.TENSACH LIKE '%$tensach%'";

			$sql.=" AND TG.TENTG LIKE '%$tentg%'";

			if($dms != 0)
			{
				$sql.= " AND S.MADMS = $dms";
			}

			if($ls != 0)
			{
				$sql.= " AND S.MALOAI = $ls";
			}

			if($gia1 > 0 && $gia2 > 0)
			{
				$sql.= " AND GIABAN BETWEEN $gia1 AND $gia2";
			}

			if($sapxep != 0)
			{
				if($sapxep == 1)
					$sql.= " ORDER BY GIABAN";
				else if($sapxep == -1)
					$sql.= " ORDER BY GIABAN DESC";
			}

			if($offset > -1)
				$sql.= " LIMIT ".ITEMS_PAGE." OFFSET $offset";

			return $this->cn->FetchAll($sql);
		}

		function ThemSach($madms, $maloai, $matg, $manxb, $tensach, $giaban, $baigioithieu, $hinh, $kichthuoc, $sotrang, $soluong, $ngayxb)
		{
			$sql = "INSERT INTO SACH(MADMS, MALOAI, MATG, MANXB, TENSACH, GIABAN, BAIGIOITHIEU, HINH, KICHTHUOC, SOTRANG, SOLUONG, CONLAI, NGAYXB) VALUES($madms, $maloai, $matg, $manxb, '$tensach', $giaban, '$baigioithieu', '$hinh', '$kichthuoc', $sotrang, $soluong, $soluong, '$ngayxb')";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function CapNhatSach($masach, $madms, $maloai, $matg, $manxb, $tensach, $giaban, $baigioithieu, $hinh, $kichthuoc, $sotrang, $soluong, $conlai, $ngayxb)
		{
			$sql = "UPDATE SACH SET MADMS = $madms, MALOAI = $maloai, MATG = $matg, MANXB = $manxb, TENSACH = '$tensach', GIABAN = $giaban, BAIGIOITHIEU = '$baigioithieu', HINH = '$hinh', KICHTHUOC = '$kichthuoc', SOTRANG = $sotrang, SOLUONG = $soluong, CONLAI = $conlai, NGAYXB = '$ngayxb' WHERE MASACH = $masach";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaSach($masach)
		{
			$sql = "DELETE FROM SACH WHERE MASACH = $masach";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>
