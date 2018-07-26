<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo khách hàng</h3>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="frmKhachHang">
			<div class="form-group">
				<label class="control-label col-sm-2" for="tenkh">Tên khách hàng: </label>
				<div class="col-sm-5">
					<input type="text" name="tenkh" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="gioitinh">Giới tính: </label>
				<div class="col-sm-5">
					<select class="form-control" name="gioitinh" required>
						<option value="0">Nữ</option>
						<option value="1">Nam</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="ngaysinh">Ngày sinh: </label>
				<div class="col-sm-5">
					<input type="text" name="ngaysinh" class="form-control date-picker" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="diachi">Địa chỉ: </label>
				<div class="col-sm-5">
					<input type="text" name="diachi" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="sdt">Số điện thoại: </label>
				<div class="col-sm-5">
					<input type="text" name="sdt" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email: </label>
				<div class="col-sm-5">
					<input type="text" name="email" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="tentk">Tên tài khoản: </label>
				<div class="col-sm-5">
					<input type="text" id="tentk" name="tentk" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="matkhau">Mật khẩu: </label>
				<div class="col-sm-5">
					<input type="password" name="matkhau" class="form-control" required>
				</div>
			</div>
			<input type="hidden" name="c" value="KhachHang">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" name="act" value="Them" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$().ready(function(e){
		$('.date-picker').datepicker({maxDate: '-18y', dateFormat: 'yy-mm-dd'});

		$('#frmKhachHang').validate({
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
				},
				tentk: {
					minlength: 6,
					remote: {
						url: 'Controller/KhachHang/KiemTra.php',
						type: 'post',
						data: {
							Loai: 'TenTK', tentk: function(){return $('#tentk').val();}
						}
					}
				},
				matkhau: {
					minlength: 6
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
				},
				tentk: {
					required: "Bạn chưa nhập tên tài khoản",
					minlength: "Bạn phải nhập tên tài khoản trên 6 kí tự",
					remote: "Tên tài khoản bị trùng. Bạn hãy nhập tên khác"
				},
				matkhau: {
					required: "Bạn chưa nhập mật khẩu",
					minlength: "Bạn phải nhập mật khẩu trên 6 kí tự"
				}
			}
		});
	});
</script>