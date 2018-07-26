<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa nhà xuất bản</h3>
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
				<form class="form-horizontal" role="form" id="frmNhaXB">
					<div class="form-group">
						<label class="control-label col-sm-2">Mã nhà xuất bản: </label>
						<div class="col-sm-10">
							<p class="form-control-static">$manxb</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tennxb">Tên nhà xuất bản: </label>
						<div class="col-sm-10">
							<input type="text" name="tennxb" value="$tennxb" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="diachi">Địa chỉ: </label>
						<div class="col-sm-10">
							<input type="text" name="diachi" value="$diachi" class="form-control">
						</div>
					</div>
					$input_hidden
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" name="btnSua" class="btn btn-primary">Sửa nhà xuất bản</button>
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
		$('#frmNhaXB').validate({
			messages: {
				tennxb: {
					required: "Bạn chưa nhập tên nhà xuất bản"
				}
			}
		})
	});
</script>