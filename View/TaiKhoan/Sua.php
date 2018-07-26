<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa tài khoản</h3>
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
				$alert = '';
				if(isset($f) && $f == false)
					$alert = <<< EOD
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Lỗi!</strong> Nhập lại mật khẩu không trùng khớp.
			</div>
EOD;

				$input_hidden = '';
				foreach ($_GET as $key => $value) {
					$input_hidden.= "<input type='hidden' name='$key' value='$value'>";
				}

				$form = <<< EOD
				<form class="form-horizontal" role="form" id="frmSuaTK">
					$alert
					<div class="form-group">
						<label class="control-label col-sm-2">Mã tài khoản: </label>
						<div class="col-sm-10">
							<p class="form-control-static">{$result['MATK']}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tentk">Tên tài khoản: </label>
						<div class="col-sm-10">
							<p class="form-control-static">{$result['TENTK']}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="chucvu">Chức vụ: </label>
						<div class="col-sm-5">
							<input type="text" name="chucvu" class="form-control" value="{$result['CHUCVU']}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="matkhau">Mật khẩu mới: </label>
						<div class="col-sm-5">
							<input type="password" id="matkhau" name="matkhau" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="r_matkhau">Nhập lại mật khẩu: </label>
						<div class="col-sm-5">
							<input type="password" name="r_matkhau" class="form-control">
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
		$('#frmSuaTK').validate({
			rules: {
				matkhau: {
					minlength: 5
				},
				r_matkhau: {
					equalTo: '#matkhau',
					minlength: 5
				}
			},
			messages: {
				chucvu: {
					required: "Bạn chưa nhập chức vụ"
				},
				matkhau: {
					minlength: "Bạn phải nhập mật khẩu trên 5 kí tự"
				},
				r_matkhau: {
					minlength: "Bạn phải nhập mật khẩu trên 5 kí tự",
					equalTo: "Bạn nhập mật khẩu không trùng khớp"
				}
			}
		});
	});
</script>