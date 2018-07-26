<?php
	if(isset($_FILES['hinh']))
	{
		include_once("Model/Upload.php");
		$hinh = Upload::UploadFile($_FILES['hinh'], 'book-icon.png');
	}

	if(!empty($_REQUEST['tensach']))
	{
		include_once("Model/Sach.php");

		$s = new Sach();

		$tensach = $_REQUEST['tensach'];

		if(!is_numeric($_REQUEST['madms']))
		{
			include_once("Model/DanhMuc.php");
			$dms = new DanhMuc();
			$madms = $dms->ThemDanhMuc($_REQUEST['madms']);
		}
		else
		{
			$madms = $_REQUEST['madms'];
		}

		if(!is_numeric($_REQUEST['maloai']))
		{
			include_once("Model/LoaiSach.php");
			$ls = new LoaiSach();
			$maloai = $ls->ThemLoaiSach($_REQUEST['maloai']);
		}
		else
		{
			$maloai = $_REQUEST['maloai'];
		}

		if(!is_numeric($_REQUEST['matg']))
		{
			include_once("Model/TacGia.php");
			$tg = new TacGia();
			$matg = $tg->ThemTacGia($_REQUEST['matg'], '');
		}
		else
		{
			$matg = $_REQUEST['matg'];
		}

		if(!is_numeric($_REQUEST['manxb']))
		{
			include_once("Model/NhaXB.php");
			$nxb = new NhaXB();
			$manxb = $nxb->ThemNhaXB($_REQUEST['manxb'], '');
		}
		else
		{
			$manxb = $_REQUEST['manxb'];
		}

		$giaban = $_REQUEST['giaban'];
		$baigioithieu = $_REQUEST['baigioithieu'];
		$kichthuoc = $_REQUEST['kichthuoc'];
		$sotrang = $_REQUEST['sotrang'];
		$soluong = $_REQUEST['soluong'];
		$ngayxb = $_REQUEST['ngayxb'];

		$kq = $s->ThemSach($madms, $maloai, $matg, $manxb, $tensach, $giaban, $baigioithieu, $hinh, $kichthuoc, $sotrang, $soluong, $ngayxb);
		
		include_once("View/Sach/Them.php");
	}
?>