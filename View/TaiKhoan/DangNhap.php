<style>
	#login{
		margin-top: 120px;
	}

	body{
		background-color: #B3E5FC;
	}
</style>
<?php
	if(isset($login_fail))
	{
		$alert = <<< EOD
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Lỗi!</strong> Đăng nhập không thành công
		</div>
EOD;
	}
?>
<div class="container-fluid">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary" id="login">
			<div class="panel-heading">
				<h3 class="panel-title">Đăng nhập</h3>
			</div>
			<div class="panel-body">
				<form method="POST" role="form" id="frmDangNhap">
					<?php if(isset($alert)) echo $alert; ?>
					<div class="form-group">
						<label for="tentk">Tên đăng nhập</label>
						<input type="text" class="form-control" name="tentk" placeholder="Nhập tên đăng nhập" required <?php if(isset($_REQUEST['tentk'])) echo "value='{$_REQUEST['tentk']}'"; ?>>
					</div>
					<div class="form-group">
						<label for="matkhau">Mật khẩu</label>
						<input type="password" class="form-control" name="matkhau" placeholder="Nhập mật khẩu" required>
					</div>
					<input type="hidden" name="c" value="TaiKhoan">
					<input type="hidden" name="act" value="DangNhap">
					<button type="submit" name="btnDangNhap" class="btn btn-primary btn-block">Đăng nhập</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(e){
		$('#frmDangNhap').validate({
			rules:{
				tentk:{
					minlength: 5
				},
				matkhau:{
					minlength: 5
				}
			},
			messages: {
				tentk: {
					required: 'Bạn chưa nhập tên tài khoản',
					minlength: 'Bạn phải nhập tên tài khoản trên 5 ký tự.'
				},
				matkhau:{
					required: 'Bạn chưa nhập mật khẩu',
					minlength: 'Bạn phải nhập mật khẩu trên 5 ký tự.'
				}
			}
		});
	});
</script>