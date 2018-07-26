<div class="container">
	<?php
		if(isset($kq) && $kq == true):
			$success = <<< EOD
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Đăng ký tài khoản</h3>
				</div>
				<div class="panel-body">
					Đăng ký thành công
				</div>
			</div>
EOD;
			echo $success;
		else:
			if(isset($msg_err)):
				$alert = <<< EOD
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Lỗi!</strong> $msg_err
					</div>
EOD;
			endif;
	?>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Đăng ký tài khoản</h3>
			</div>
			<div class="panel-body">
				<?php if(isset($alert)) echo $alert; ?>
				<form method="POST" role="form" id="frmDangKy">
					<div class="form-group">
						<label for="tentk">Tên tài khoản: </label>
						<input type="text" class="form-control" id="tentk" name="tentk" placeholder="Nhập tên tài khoản" required>
					</div>
					<div class="form-group">
						<label for="tentk">Mật khẩu: </label>
						<input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu" required>
					</div>
					<div class="form-group">
						<label for="tentk">Nhập lại mật khẩu: </label>
						<input type="password" class="form-control" name="r_matkhau" placeholder="Nhập lại mật khẩu" required>
					</div>
					<div class="form-group">
						<label for="tenkh">Họ và tên: </label>
						<input type="text" class="form-control" name="tenkh" placeholder="Nhập họ và tên" <?php if(isset($_REQUEST['tenkh'])) echo "value='{$_REQUEST['tenkh']}'";?> required>
					</div>
					<div class="form-group">
						<label for="diachi">Giới tính: </label>
						<select class="form-control" name="gioitinh" id="gioitinh" required>
							<option <?php if(isset($_REQUEST['gioitinh']) && $_REQUEST['gioitinh'] == 0) echo "selected";?> value="0">Nữ</option>
							<option <?php if(isset($_REQUEST['gioitinh']) && $_REQUEST['gioitinh'] == 1) echo "selected";?> value="1">Nam</option>
						</select>
					</div>
					<div class="form-group">
						<label for="ngaysinh">Ngày sinh: </label>
						<input type="text" class="form-control" id="date-picker-ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh" <?php if(isset($_REQUEST['ngaysinh'])) echo "value='{$_REQUEST['ngaysinh']}'";?> required>
					</div>
					<div class="form-group">
						<label for="diachi">Địa chỉ: </label>
						<input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ" <?php if(isset($_REQUEST['diachi'])) echo "value='{$_REQUEST['diachi']}'";?> required>
					</div>
					<div class="form-group">
						<label for="sdt">Số điện thoại: </label>
						<input type="text" class="form-control" name="sdt" placeholder="Nhập số điện thoại" <?php if(isset($_REQUEST['sdt'])) echo "value='{$_REQUEST['sdt']}'";?> required>
					</div>
					<div class="form-group">
						<label for="email">Địa chỉ email: </label>
						<input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" <?php if(isset($_REQUEST['email'])) echo "value='{$_REQUEST['email']}'";?> required>
					</div>
					<button type="submit" class="btn btn-primary" name="btnTaoTK">Tạo tài khoản</button>
				</form>
			</div>
		</div>
	</div>
	<?php
		endif;
	?>
</div>