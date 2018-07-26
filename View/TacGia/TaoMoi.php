<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo tác giả sách</h3>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="frmTacGia">
			<div class="form-group">
				<label class="control-label col-sm-2" for="tentg">Tên tác giả: </label>
				<div class="col-sm-10">
					<input type="text" name="tentg" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="gioithieu">Bài giới thiệu: </label>
				<div class="col-sm-10">
					<textarea name="gioithieu" class="form-control"></textarea>
				</div>
			</div>
			<input type="hidden" name="c" value="TacGia">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" name="act" value="Them" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</form>
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