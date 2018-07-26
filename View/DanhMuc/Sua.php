<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa danh mục</h3>
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
				<form class="form-horizontal" role="form" id="frmDanhMuc">
					<div class="form-group">
						<label class="control-label col-sm-2">Mã danh mục: </label>
						<div class="col-sm-10">
							<p class="form-control-static">$madms</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tendms">Tên danh mục: </label>
						<div class="col-sm-10">
							<input type="text" name="tendms" value="$tendms" class="form-control" required>
						</div>
					</div>
					$input_hidden
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" name="btnSua" class="btn btn-primary">Sửa danh mục</button>
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
		$('#frmDanhMuc').validate({
			messages: {
				tendms: {
					required: "Bạn chưa nhập tên danh mục."
				}
			}
		});
	});
</script>