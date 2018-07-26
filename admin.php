<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Trang quản lý bán sách</title>
	<link rel="icon" href="image/Aha-Soft-Free-Large-Boss-Manager.ico">
	<link rel="stylesheet" href="lib/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="lib/selectize/selectize.default.css"/>
	<link rel="stylesheet" href="lib/selectize/selectize.bootstrap3.css"/>
	<link rel="stylesheet" href="lib/jquery-ui-1.12.1.custom/jquery-ui.min.css">
	<style type="text/css">
		.col-md-3{
			padding-left: 0px;
			padding-right: 0px;
		}

		.sidebar{
			min-height: 100%;
			width: 320px;
			padding: 20px;
			background-color: #1A237E;
		}

		.content{
			margin-top: 20px;
		}

		.sidebar ul li a{
			color: white;
		}

		.sidebar ul li.select a{
			background-color: #B71C1C;
		}

		.sidebar ul li a:hover{
			background-color: #B71C1C;
		}

		.sidebar ul li.title a:hover{
			background-color: #1A237E;
			cursor: default;
		}
		.error{
			color: red;
			font-style: italic;
		}

	</style>
	<script src="lib/jquery/jquery-3.1.1.min.js"></script>
	<script src="lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="lib/tinymce/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
  	<script src="lib/selectize/selectize.js"></script>
  	<script src="lib/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  	<script src="lib/jquery-validation/jquery.validate.min.js"></script>
	<script src="lib/jquery-validation/additional-methods.min.js"></script>
	<script src="lib/pdfmake/pdfmake.min.js"></script>
	<script src="lib/pdfmake/vfs_fonts.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION['TaiKhoan_QL'])):
			include_once("Controller/TaiKhoan/DangNhap.php");
		else:
	?>
	<div>
		<div class="col-md-3">
			<div class="sidebar" data-spy="affix">
				<ul class="nav nav-pills nav-stacked" >
					<li class="title"><a href="#">DANH MỤC QUẢN LÝ</a></li>
					<li class="nav-divider"></li>
					<li <?php if((isset($_REQUEST['c']) && $_REQUEST['c'] == 'DanhMuc') || !isset($_REQUEST['c'])) echo "class='select'"; ?> ><a href='admin.php?c=DanhMuc&act=QuanLy'><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Quản lý danh mục sách</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'LoaiSach') echo "class='select'"; ?> ><a href='admin.php?c=LoaiSach&act=QuanLy'><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Quản lý loại sách</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'Sach') echo "class='select'"; ?> ><a href='admin.php?c=Sach&act=QuanLy'><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Quản lý sách</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'TacGia') echo "class='select'"; ?> ><a href='admin.php?c=TacGia&act=QuanLy'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Quản lý tác giả</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'NhaXB') echo "class='select'"; ?> ><a href='admin.php?c=NhaXB&act=QuanLy'><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Quản lý nhà xuất bản</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'KhachHang') echo "class='select'"; ?> ><a href='admin.php?c=KhachHang&act=QuanLy'><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Quản lý khách hàng</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'HoaDon') echo "class='select'"; ?> ><a href='admin.php?c=HoaDon&act=QuanLy'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Quản lý hoá đơn</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'ThongKe') echo "class='select'"; ?> ><a href='admin.php?c=ThongKe&act=ThongKe'><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Thống kê</a></li>
					<li <?php if(isset($_REQUEST['c']) && $_REQUEST['c'] == 'TaiKhoan') echo "class='select'"; ?> ><a href='admin.php?c=TaiKhoan&act=QuanLy'><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Quản lý tài khoản</a></li>
					<li class="nav-divider"></li>
				</ul>
				<a href="admin.php?c=TaiKhoan&act=DangXuat" class="btn btn-default btn-block">Đăng xuất (<?php echo $_SESSION['TaiKhoan_QL']['TENTK']; ?>)</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="container-fluid content">
				<?php
					if(isset($_SESSION['TaiKhoan_QL']))
					{
						if(isset($_REQUEST['c']) && isset($_REQUEST['act']))
						{
							include_once("Controller/".$_REQUEST['c']."/".$_REQUEST['act'].".php");
						}
						else
						{
							include_once("Controller/DanhMuc/QuanLy.php");
						}
					}
					else
					{
						echo "<script>alert('Bạn chưa đăng nhập');</script>";
					}
				?>
			</div>
		</div>
	</div>
	<?php
		endif;
	?>
</body>
</html>
<?php 
	ob_flush();
?>