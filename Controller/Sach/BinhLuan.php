<?php
	include_once(dirname(__DIR__)."/../Model/BinhLuan.php");
	$bl = new BinhLuan();

	session_start();
	if(isset($_REQUEST['masach']))
	{
		$masach = $_REQUEST['masach'];

		if(isset($_REQUEST['Them']))
		{
			if(isset($_SESSION['TaiKhoan']))
			{
				$cm = json_decode($_REQUEST['comment']);
				$bl->ThemBinhLuan($masach, $cm->id, $cm->parent, $cm->created, $cm->modified, $cm->content, $cm->fullname, $cm->upvote_count);
				$result['error'] = 0;
			}
			else
			{
				$result['error'] = 1;
			}
		}
		else if(isset($_REQUEST['CapNhat']))
		{
			if(isset($_SESSION['TaiKhoan']))
			{
				$cm = json_decode($_REQUEST['comment']);
				$kq = $bl->CapNhatBinhLuan($masach, $cm->id, $cm->parent, $cm->created, $cm->modified, $cm->content, $cm->fullname, $cm->upvote_count);
				if($kq == true)
					$result['error'] = 0;
				else
					$result['error'] = 1;
			}
			else
				$result['error'] = 1;
		}
		else if(isset($_REQUEST['Xoa']))
		{
			if(isset($_SESSION['TaiKhoan']))
			{
				$cm = json_decode($_REQUEST['comment']);
				$kq = $bl->XoaBinhLuan($masach, $cm->id);
				if($kq == true)
					$result['error'] = 0;
				else
					$result['error'] = 1;
			}
			else
				$result['error'] = 1;
		}
		else
		{
			$tentk = '';
			if(isset($_SESSION['TaiKhoan']))
				$tentk = $_SESSION['TaiKhoan']['TENTK'];
			$result['error'] = 0;
			$result['list'] = [];
			$arr = $bl->LayBinhLuanTheoMa($masach);
			foreach ($arr as $value) {
				foreach ($value as $key => $value) {
					if($key == 'MASACH')
						continue;
					if($key == "UPVOTE_COUNT")
						$obj[strtolower($key)] = intval($value);
					else
						$obj[strtolower($key)] = $value;
				}

				if($obj['fullname'] == $tentk)
					$obj['created_by_current_user'] = true;
				$result['list'][] = $obj;
			}
		}
	}
	else
	{
		$result['error'] = 1;
	}
	include_once(dirname(__DIR__)."/../View/Sach/BinhLuan.php");
?>