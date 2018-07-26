<?php
	if(isset($_REQUEST['masach']))
	{
		$masach = $_REQUEST['masach'];
		include_once("Model/DanhMuc.php");
		include_once("Model/LoaiSach.php");
		include_once("Model/TacGia.php");
		include_once("Model/NhaXB.php");
		include_once("Model/Sach.php");

		$dms = new DanhMuc();
		$list_dms = $dms->LayDanhMuc();

		$ls = new LoaiSach();
		$list_ls = $ls->LayLoaiSach();

		$tg = new TacGia();
		$list_tg = $tg->LayTacGia();

		$nxb = new NhaXB();
		$list_nxb = $nxb->LayNhaXB();


		$s = new Sach();

		if(isset($_REQUEST['btnSua']))
		{
			if(isset($_FILES['hinh']))
			{
				include_once("Model/Upload.php");

				$hinh = Upload::UploadFile($_FILES['hinh'], $_REQUEST['old_img']);

				$tensach = $_REQUEST['tensach'];

				if(!is_numeric($_REQUEST['madms']))
				{
					$madms = $dms->ThemDanhMuc($_REQUEST['madms']);
				}
				else
				{
					$madms = $_REQUEST['madms'];
				}

				if(!is_numeric($_REQUEST['maloai']))
				{
					$maloai = $ls->ThemLoaiSach($_REQUEST['maloai']);
				}
				else
				{
					$maloai = $_REQUEST['maloai'];
				}

				if(!is_numeric($_REQUEST['matg']))
				{
					$matg = $tg->ThemTacGia($_REQUEST['matg'], '');
				}
				else
				{
					$matg = $_REQUEST['matg'];
				}

				if(!is_numeric($_REQUEST['manxb']))
				{
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
				$conlai = $_REQUEST['conlai'];
				$ngayxb = $_REQUEST['ngayxb'];

				$kq = $s->CapNhatSach($masach, $madms, $maloai, $matg, $manxb, $tensach, $giaban, $baigioithieu, $hinh, $kichthuoc, $sotrang, $soluong, $conlai, $ngayxb);
			}
		}
		else
		{
			$list_dms = $dms->LayDanhMuc();

			$list_ls = $ls->LayLoaiSach();

			$list_tg = $tg->LayTacGia();

			$list_nxb = $nxb->LayNhaXB();

			$result = $s->LaySachTheoMa($masach);
		}

		include_once("View/Sach/Sua.php");
	}

?>