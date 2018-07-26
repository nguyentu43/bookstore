<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo mới loại sách</h3>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="frmLoaiSach">
			<div class="form-group">
				<label class="control-label col-sm-2" for="tenloai">Tên loại sách: </label>
				<div class="col-sm-10">
					<input type="text" name="tenloai" class="form-control" required>
				</div>
			</div>
			<input type="hidden" name="c" value="LoaiSach">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" name="act" value="Them" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</form>
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