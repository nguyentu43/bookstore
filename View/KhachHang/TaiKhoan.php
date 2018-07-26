<?php
	if(isset($_SESSION['TaiKhoan']))
	{
		$tentk = $_SESSION['TaiKhoan']['TENTK'];
		$makh = $_SESSION['TaiKhoan']['MAKH'];
		$dangxuat = <<< EOD
		<div class="dropdown" style="display: inline-block">
			<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Tài khoản <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="index.php?c=KhachHang&act=ThongTin&makh=$makh"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Thông tin khách hàng</a>
</li>
				<li><a href="index.php?c=KhachHang&act=DonHangDaDat&makh=$makh"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Đơn hàng đã đặt</a>
</li>
			</ul>
		</div>
		<input type="hidden" name="makh" value="$makh">
		<input type="hidden" name="tentk" value="$tentk">
		<form method="post" id="frmDangXuat" style="display:inline-block">
			<input type="hidden" name="c" value="KhachHang">
			<input type="hidden" name="act" value="TaiKhoan">
			<input type="hidden" name="querystr" value="" id="querystr">
			<button type="submit" name="btnDangXuat" class="btn btn-primary"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Đăng xuất ({$tentk})</button>
		</form>
EOD;
		echo $dangxuat;
	}
	else
	{
		echo '<a href="index.php?c=KhachHang&act=DangNhap" id="DangNhap" class="btn btn-primary"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Đăng nhập</a>';
		echo ' <a href="index.php?c=KhachHang&act=DangKy" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Đăng ký</a>';
	}
?>