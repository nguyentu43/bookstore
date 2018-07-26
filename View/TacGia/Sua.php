<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa tác giả</h3>
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
				<form class="form-horizontal" role="form" id="frmTacGia">
					<div class="form-group">
						<label class="control-label col-sm-2">Mã tác giả: </label>
						<div class="col-sm-10">
							<p class="form-control-static">$matg</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tentg">Tên tác giả: </label>
						<div class="col-sm-10">
							<input type="text" name="tentg" value="$tentg" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="gioithieu">Bài giới thiệu: </label>
						<div class="col-sm-10">
							<textarea name="gioithieu" class="form-control">$gioithieu</textarea>
						</div>
					</div>
					$input_hidden
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Sửa tác giả</button>
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
	$(document).ready(function(){
		$('#frmTacGia').validate({
			messages: {
				tentg: {
					required: "Bạn chưa nhập tên tác giả"
				}
			}
		})
	});
</script>