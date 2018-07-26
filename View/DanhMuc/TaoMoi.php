<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo mới danh mục</h3>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="frmDanhMuc">
			<div class="form-group">
				<label class="control-label col-sm-2" for="tendms">Tên danh mục: </label>
				<div class="col-sm-10">
					<input type="text" name="tendms" class="form-control" required>
				</div>
			</div>
			<input type="hidden" name="c" value="DanhMuc">
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
		$('#frmDanhMuc').validate({
			messages: {
				tendms: {
					required: "Bạn chưa nhập tên danh mục."
				}
			}
		});
	});
</script>