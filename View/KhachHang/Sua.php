<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa khách hàng</h3>
	</div>
	<div class="panel-body">
		<?php
			if(isset($kq))
			{
				if($kq === true)
					echo "Cập nhật thành công";
				else
					echo "Cập nhật không thành công";
			}
			else
			{
				$input_hidden = '';
				foreach ($_GET as $key => $value) {
					$input_hidden.= "<input type='hidden' name='$key' value='$value'>";
				}

				if($result['GIOITINH'] == 0)
					$option_gt ="<option selected value='0'>Nữ</option><option value='1'>Nam</option>";
				else
					$option_gt ="<option value='0'>Nữ</option><option selected value='1'>Nam</option>";

				$form = <<< EOD
				<form class="form-horizontal" role="form" id="frmSuaKH">
					<div class="form-group">
						<label class="control-label col-sm-2">Mã khách hàng: </label>
						<div class="col-sm-10">
							<p class="form-control-static">{$result['MAKH']}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tenkh">Tên khách hàng: </label>
						<div class="col-sm-5">
							<input type="text" name="tenkh" class="form-control" value="{$result['TENKH']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="gioitinh">Giới tính: </label>
						<div class="col-sm-5">
							<select class="form-control" name="gioitinh" required>
								$option_gt;
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ngaysinh">Ngày sinh: </label>
						<div class="col-sm-5">
							<input type="text" name="ngaysinh" class="form-control date-picker" value="{$result['NGAYSINH']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="diachi">Địa chỉ: </label>
						<div class="col-sm-5">
							<input type="text" name="diachi" class="form-control" value="{$result['DIACHI']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="sdt">Số điện thoại: </label>
						<div class="col-sm-5">
							<input type="text" name="sdt" class="form-control" value="{$result['SDT']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email: </label>
						<div class="col-sm-5">
							<input type="text" name="email" class="form-control" value="{$result['EMAIL']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tentk">Tên tài khoản: </label>
						<div class="col-sm-5">
							<p class="form-control-static">{$result['TENTK']}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="matkhau">Đặt lại mật khẩu: </label>
						<div class="col-sm-10">
							<div class="checkbox">
								<label>
									<input type="radio" name="DatLaiMK" value="1">Có
								</label>
								<label>
									<input type="radio" name="DatLaiMK" value="0" checked>Không
								</label>
							</div>
						</div>
					</div>
					$input_hidden
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" name="btnSua" class="btn btn-primary">Sửa</button>
						</div>
					</div>
				</form>
EOD;
				echo $form;
			}
		?>
	</div>
</div>
<script>
	$().ready(function(e){
		$('.date-picker').datepicker({maxDate: '-18y', dateFormat: 'yy-mm-dd'});

		$('#frmSuaKH').validate({
			rules: {
				ngaysinh: {
					date: true
				},
				sdt: {
					digits: true,
					minlength: 7
				},
				email:{
					email: true
				}
			},
			messages: {
				tenkh: {
					required: "Bạn chưa nhập tên khách hàng"
				},
				gioitinh: {
					required: "Bạn chưa chọn giới tính"
				},
				ngaysinh: {
					required: "Bạn chưa nhập ngày sinh",
					date: "Bạn nhập ngày sinh chưa hợp lệ"
				},
				diachi: {
					required: "Bạn chưa nhập địa chỉ"
				},
				sdt: {
					required: "Bạn chưa nhập số điện thoại",
					digits: "Bạn nhập số điện thoại chưa hợp lệ",
					minlength: "Bạn nhập số điện thoại chưa hợp lệ"
				},
				email: {
					required: "Bạn chưa nhập địa chỉ email",
					email: "Bạn nhập địa chỉ email chưa hợp lệ"
				}
			}
		});
	});
</script>