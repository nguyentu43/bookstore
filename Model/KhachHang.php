<?php
	include_once("DataProvider.php");
	class KhachHang
	{
		private $cn;

		function __construct(){
			$this->cn = new DataProvider();
		}

		function ThemKhachHang($tenkh, $diachi, $sdt, $email, $gioitinh, $ngaysinh, $tentk, $matkhau){
			$sql = "INSERT INTO KHACHHANG(TENKH, DIACHI, SDT, EMAIL, GIOITINH, NGAYSINH, TENTK, MATKHAU) VALUES('$tenkh', '$diachi', '$sdt', '$email', $gioitinh, '$ngaysinh','$tentk', md5('{$matkhau}'))";
			return $this->cn->ExecuteQueryInsert($sql);
		}

		function DangNhap($tentk, $matkhau)
		{
			$sql = "SELECT * FROM KHACHHANG WHERE TENTK = '$tentk' AND MATKHAU = md5('$matkhau')";
			$result = $this->cn->Fetch($sql);
			if(count($result) > 0)
				$_SESSION['TaiKhoan'] = $result;
		}

		function DangXuat()
		{
			if(isset($_SESSION['TaiKhoan']))
			{
				unset($_SESSION['TaiKhoan']);
			}
		}

		function KiemTraTenTK($tentk)
		{
			$sql = "SELECT * FROM KHACHHANG WHERE TENTK = '$tentk'";
			return $this->cn->NumRows($sql);
		}

		function LayKhachHang()
		{
			$sql = "SELECT * FROM KHACHHANG";
			return $this->cn->FetchAll($sql);
		}

		function LayKhachHangTheoMa($makh)
		{
			$sql = "SELECT * FROM KHACHHANG WHERE MAKH = $makh";
			return $this->cn->Fetch($sql);
		}

		function CapNhatKhachHang($makh, $tenkh, $diachi, $sdt, $email, $gioitinh, $ngaysinh){
			$sql = "UPDATE KHACHHANG SET TENKH = '$tenkh', DIACHI = '$diachi', SDT = '$sdt', EMAIL = '$email', GIOITINH = $gioitinh, NGAYSINH = '$ngaysinh' WHERE MAKH = $makh";
			return $this->cn->ExecuteQuery($sql);
		}

		function DoiMatKhau($makh, $matkhau)
		{
			$sql = "UPDATE KHACHHANG SET MATKHAU = md5('$matkhau') WHERE MAKH = $makh";
			return $this->cn->ExecuteQuery($sql);
		}

		function DatLaiMatKhau($makh)
		{
			$sql = "UPDATE KHACHHANG SET MATKHAU = md5('000000') WHERE MAKH = $makh";
			return $this->cn->ExecuteQuery($sql);
		}

		function XoaKhachHang($makh)
		{
			$sql = "DELETE FROM KHACHHANG WHERE MAKH = $makh";
			return $this->cn->ExecuteQuery($sql);
		}

		function __destruct(){
			unset($this->cn);
		}
	}
?>