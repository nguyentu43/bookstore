<?php
	if(isset($f) && $f == 0):
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Thêm tài khoản</h3>
	</div>
	<div class="panel-body">
		<?php
			if($kq > 0):
				echo "Thêm thành công";
			else:
				echo "Thêm không thành công";
			endif;
		?>
	</div>
</div>

<?php
	else:
		$alert = '';
		if(isset($f))
		{
			if($f > 0)
			{
				$msg = "Tên tài khoản đã tồn tại hay dùng tên khác";
			}
			else
			{
				$msg = "Nhập lại mật khẩu không trùng khớp";
			}
			$alert = <<< EOD
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Lỗi!</strong> $msg
			</div>
EOD;
		}

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo tài khoản</h3>
	</div>
	<div class="panel-body">
		<form method="post" class="form-horizontal" role="form" id="frmTaiKhoan">
			<?php echo $alert; ?>
			<div class="form-group">
				<label class="control-label col-sm-2" for="tentk">Tên tài khoản: </label>
				<div class="col-sm-5">
					<input type="text" name="tentk" class="form-control" <?php if(isset($_REQUEST['tentk'])) echo "value='{$_REQUEST['tentk']}'";?> required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="matkhau">Mật khẩu: </label>
				<div class="col-sm-5">
					<input type="password" id="matkhau" name="matkhau" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="matkhau">Nhập lại mật khẩu: </label>
				<div class="col-sm-5">
					<input type="password" name="r_matkhau" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="chucvu">Chức vụ: </label>
				<div class="col-sm-5">
					<input type="text" name="chucvu" class="form-control" required>
				</div>
			</div>
			<input type="hidden" name="c" value="TaiKhoan">
			<input type="hidden" name="act" value="Them">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" name="btnThem" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$().ready(function(e){
		$('#frmTaiKhoan').validate({
			rules: {
				tentk: {
					minlength: 5
				},
				matkhau: {
					minlength: 5
				},
				r_matkhau: {
					equalTo: '#matkhau',
					minlength: 5
				}
			},
			messages: {
				tentk: {
					required: "Bạn chưa nhập tên tài khoản"
				},
				matkhau: {
					required: "Bạn chưa nhập mật khẩu",
					minlength: "Bạn phải nhập mật khẩu trên 5 kí tự"
				},
				r_matkhau: {
					required: "Bạn chưa nhập mật khẩu",
					minlength: "Bạn phải nhập mật khẩu trên 5 kí tự",
					equalTo: "Bạn nhập lại mật khẩu không trùng khớp"
				},
				chucvu: {
					required: "Bạn chưa nhập chức vụ"
				}
			}
		});
	});
</script>

<?php
	endif;
?>