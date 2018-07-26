<?php
	class GioHang
	{
		public static function Them($id){
			if(isset($_SESSION['GioHang'][$id]))
				$_SESSION['GioHang'][$id]++;
			else
				$_SESSION['GioHang'][$id] = 1;
		}

		public static function CapNhat($id, $soluong){
			if(isset($_SESSION['GioHang'][$id]))
				$_SESSION['GioHang'][$id] = $soluong;
		}

		public static function Xoa($id){
			if(isset($_SESSION['GioHang'][$id]))
				unset($_SESSION['GioHang'][$id]);
		}

		public static function SoLuongSP(){
			if(isset($_SESSION['GioHang']))
				return count($_SESSION['GioHang']);
			return 0;
		}
	}
?>