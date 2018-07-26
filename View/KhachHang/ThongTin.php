<div class="container">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Thông tin tài khoản</h3>
			</div>
			<div class="panel-body">
				<?php
					if(!isset($error) && isset($_REQUEST['btnSua'])):
						if(isset($kq)):
							if($kq === true):
								echo "Đổi thông tin thành công";
							else:
								echo "Đổi thông tin thành công";
							endif;
						endif;
					else:
						$msg = '';
						if(isset($error) && $error == true):
							$msg = <<< EOD
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>Lỗi!</strong> Nhập mật khẩu cũ không chính xác.
								</div>
EOD;
						endif;

					if($tk['GIOITINH'] == 0):
						$option_gt ="<option selected value='0'>Nữ</option><option value='1'>Nam</option>";
					else:
						$option_gt ="<option value='0'>Nữ</option><option selected value='1'>Nam</option>";
					endif;
				?>
				<form method="post" role="form" id="frmThongTin">
					<div class="form-group">
						<label for="tenkh">Họ và tên: </label>
						<input type="text" class="form-control" name="tenkh" placeholder="Nhập tên khách hàng" <?php echo "value='{$tk['TENKH']}'"?> required>
					</div>
					<div class="form-group">
						<label for="gioitinh">Giới tính: </label>
						<select class="form-control" name="gioitinh" placeholder="Nhập số điện thoại" required>
								<?php echo $option_gt; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="tenkh">Ngày sinh: </label>
						<input type="text" class="form-control" id="date-picker-ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh" <?php echo "value='{$tk['NGAYSINH']}'"?> required>
					</div>
					<div class="form-group">
						<label for="diachi">Địa chỉ: </label>
						<input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ" <?php echo "value='{$tk['DIACHI']}'"?> required>
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" <?php echo "value='{$tk['EMAIL']}'"?> required>
					</div>
					<div class="form-group">
						<label for="sdt">Số điện thoại: </label>
						<input type="text" class="form-control" name="sdt" placeholder="Nhập số điện thoại" <?php echo "value='{$tk['SDT']}'"?> required>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label for="doimatkhau"><input type="checkbox" name="doimatkhau" id="doimatkhau"><strong>Đổi mật khẩu</strong></label>
						</div>
					</div>
					<?php echo $msg; ?>
					<div id="div-doimatkhau" style="display: none">
						<div class="form-group">
							<label for="matkhau_cu">Mật khẩu cũ: </label>
							<input type="password" class="form-control" id="matkhau_cu" name="matkhau_cu" placeholder="Nhập mật khẩu cũ">
						</div>
						<div class="form-group">
							<label for="matkhau">Mật khẩu mới: </label>
							<input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu mới">
						</div>
						<div class="form-group">
							<label for="r_matkhau">Nhập lại mật khẩu mới: </label>
							<input type="password" class="form-control" id="r_matkhau" name="r_matkhau" placeholder="Nhập lại mật khẩu">
						</div>
					</div>
					<button type="submit" name="btnSua" id="btnSua" class="btn btn-primary">Đổi thông tin</button>
				</form>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
</div>