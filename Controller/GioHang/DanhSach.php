<?php
	include_once(dirname(__DIR__)."/../Model/GioHang.php");
	include_once(dirname(__DIR__)."/../Model/Sach.php");

	if(isset($_REQUEST['btnThem']))
	{
		if(isset($_REQUEST['masach']))
		{
			session_start();
			GioHang::Them($_REQUEST['masach']);
		}
	}

	if(isset($_REQUEST['btnXoa']))
	{
		if(isset($_REQUEST['masach']))
		{
			session_start();
			GioHang::Xoa($_REQUEST['masach']);
		}
	}

	if(isset($_REQUEST['btnCapNhat']))
	{
		if(isset($_REQUEST['masach']) && isset($_REQUEST['soluong']) && $_REQUEST['soluong'] > 0)
		{
			session_start();
			$sach = new Sach();
			$s = $sach->LaySachTheoMa($_REQUEST['masach']);
			$giaban = $s['GIABAN'];
			$conlai = $s['CONLAI'];

			if($_REQUEST['soluong'] > $conlai)
			{
				$res["error"] = 1;
				$res["msg"] = "Sách chỉ còn ".$conlai.".";
				$res["conlai"] = $conlai;
				$res["tonggia"] = number_format($conlai * $giaban);
				GioHang::CapNhat($_REQUEST['masach'], $conlai);
			}
			else
			{
				$res["error"] = 0;
				$res["tonggia"] = number_format($_REQUEST['soluong'] * $giaban);
				GioHang::CapNhat($_REQUEST['masach'], $_REQUEST['soluong']);
			}

			$tonghd = 0;

			foreach ($_SESSION['GioHang'] as $id => $soluong) 
			{
				$sach = new Sach();
				$row = $sach->LaySachTheoMa($id);
				$tonghd += $soluong * $row['GIABAN'];
			}

			$res["tonghd"] = number_format($tonghd);
		}
	}

	$result = array();

	if(isset($_SESSION['GioHang']))
	{
		foreach ($_SESSION['GioHang'] as $id => $soluong) 
		{
			$sach = new Sach();
			$row = $sach->LaySachTheoMa($id);
			$row['SoLuong'] = $soluong;
			$row['TongGia'] = $soluong * $row['GIABAN'];
			array_push($result, $row);
		}
	}

	include_once(dirname(__DIR__)."/../View/GioHang/DanhSach.php");
?>