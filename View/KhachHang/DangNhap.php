<?php
	$alert = '';
	if(isset($login_fail))
	{
		$alert = <<< EOD
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Lỗi!</strong> Đăng nhập không thành công
		</div>
EOD;
	}

	$querystr = '';

	if(isset($_REQUEST['querystr']))
		$querystr = $_REQUEST['querystr'];
	$dangnhap = <<< EOD
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Đăng nhập</h3>
				</div>
				<div class="panel-body">
					<form method="POST" role="form" id="frmDangNhap">
						{$alert}
						<div class="form-group">
							<label for="tentk">Tên đăng nhập: </label>
							<input type="text" class="form-control" name="tentk" placeholder="Nhập tên đăng nhập" required>
						</div>
						<div class="form-group">
							<label for="matkhau">Mật khẩu: </label>
							<input type="password" class="form-control" name="matkhau" placeholder="Nhập mật khẩu" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block" name="btnDangNhap">Đăng nhập</button>
						</div>
						<input type="hidden" name="c" value="KhachHang">
						<input type="hidden" name="act" value="DangNhap">
						<input type="hidden" name="querystr" value="$querystr">
					</form>
				</div>
			</div>
		</div>
	</div>
EOD;
	echo $dangnhap;
?>