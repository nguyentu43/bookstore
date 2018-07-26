<?php
	if(isset($_REQUEST['btnThem']) && isset($_REQUEST['masach']))
	{
		include_once("Model/HoaDon.php");
		include_once("Model/ChiTietHoaDon.php");
		include_once("Model/Sach.php");

		$hd = new HoaDon();
		$cthd = new ChiTietHoaDon();
		$s = new Sach();
		$result_s = $s->LaySach();

		function GiaSach($result_s, $masach)
		{
			foreach ($result_s as $s) 
			{
				if($s['MASACH'] == $masach)
					return $s['GIABAN'];
			}
			return 0;
		}

		$tennn = $_REQUEST['tennn'];
		$diachi = $_REQUEST['diachi'];
		$sdt = $_REQUEST['sdt'];
		$email = $_REQUEST['email'];
		$makh = $_REQUEST['makh'];

		$tongtien = 0;

		$masach = $_REQUEST['masach'];
		$soluong = $_REQUEST['soluong'];

		for ($i=0; $i <count($masach); $i++) { 
			$tongtien += GiaSach($result_s, $masach[$i]) * $soluong[$i];
		}

		$mahd = $hd->ThemHoaDon($makh, $tennn, $diachi, $sdt, $email, $tongtien);

		foreach ($masach as $key => $value) {
			$cthd->ThemChiTietHoaDon($mahd, $value, $soluong[$key]);
		}

		include_once("View/HoaDon/Them.php");
	}
?>