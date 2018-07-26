<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa loại sách</h3>
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

				$form = <<< EOD
				<form class="form-horizontal" role="form" id="frmLoaiSach">
					<div class="form-group">
						<label class="control-label col-sm-2">Mã loại sách: </label>
						<div class="col-sm-10">
							<p class="form-control-static">$maloai</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tenloai">Tên loại sách: </label>
						<div class="col-sm-10">
							<input type="text" name="tenloai" value="$tenloai" class="form-control" required>
						</div>
					</div>
					$input_hidden
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" name="btnSua" class="btn btn-primary">Sửa loại sách</button>
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
	$(document).ready(function(e){
		$('#frmLoaiSach').validate({
			messages: {
				tenloai: {
					required: "Bạn chưa nhập tên loại sách."
				}
			}
		});
	});
</script>