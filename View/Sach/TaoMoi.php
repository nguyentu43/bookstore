<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Thêm sách mới</h3>
	</div>
	<div class="panel-body">
		<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="frmSach">
			<div class="form-group">
				<label class="control-label col-sm-2" for="madms">Danh mục sách: </label>
				<div class="col-sm-5">
					<select name="madms" class="form-control" required>
						<?php
							foreach ($list_dms as $row) {
								echo "<option value='{$row['MADMS']}'>{$row['TENDMS']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="maloai">Thể loại sách: </label>
				<div class="col-sm-5">
					<select name="maloai" class="form-control" required>
						<?php
							foreach ($list_ls as $row) {
								echo "<option value='{$row['MALOAI']}'>{$row['TENLOAI']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="tensach">Tên sách: </label>
				<div class="col-sm-5">
					<input type="text" name="tensach" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="matg">Tác giả: </label>
				<div class="col-sm-5">
					<select name="matg" class="form-control" required>
						<?php
							foreach ($list_tg as $row) {
								echo "<option value='{$row['MATG']}'>{$row['TENTG']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="manxb">Nhà xuất bản: </label>
				<div class="col-sm-5">
					<select name="manxb" class="form-control" required>
						<?php
							foreach ($list_nxb as $row) {
								echo "<option value='{$row['MANXB']}'>{$row['TENNXB']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="giaban">Giá bán: </label>
				<div class="col-sm-5">
					<input type="text" name="giaban" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="ngayxb">Ngày xuất bản: </label>
				<div class="col-sm-5">
					<input type="text" name="ngayxb" class="form-control date-picker" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kichthuoc">Kích thước: </label>
				<div class="col-sm-5">
					<input type="text" name="kichthuoc" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="sotrang">Số trang: </label>
				<div class="col-sm-5">
					<input type="text" name="sotrang" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="soluong">Số lượng: </label>
				<div class="col-sm-5">
					<input type="text" name="soluong" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="hinh">Hình sách: </label>
				<div class="col-sm-5">
					<input type="file" accept="image/*" name="hinh" style="margin-top: 5px">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="baigioithieu">Bài giới thiệu: </label>
				<div class="col-sm-10">
					<textarea name="baigioithieu" class="form-control"></textarea>
				</div>
			</div>
			<input type="hidden" name="c" value="Sach">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" name="act" value="Them" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$().ready(function(e){
		$('select').selectize({
			create: true
		});

		$('.date-picker').datepicker({dateFormat: 'yy-mm-dd'});

		$('#frmSach').validate({
			rules:{
				giaban: {
					digits: true,
					min: 500
				},
				sotrang: {
					digits: true,
					min: 1
				},
				soluong: {
					digits: true,
					min: 1
				}
			},
			messages: {
				madms: {
					required: "Bạn chưa chọn danh mục sách"
				},
				maloai: {
					required: "Bạn chưa chọn loại sách"
				},
				tensach: {
					required: "Bạn chưa nhập tên sách"
				},
				matg: {
					required: "Bạn chưa chọn tác giả"
				},
				manxb: {
					required: "Bạn chưa chọn nhà xuất bản"
				},
				giaban: {
					required: "Bạn chưa nhập giá bán",
					digits: "Bạn nhập giá bán không hợp lệ",
					min: "Bạn nhập giá bán lớn hơn 500"
				},
				ngayxb: {
					required: "Bạn chưa nhập ngày xuất bản",
					date: "Bạn nhập ngày xuất bản chưa hợp lệ"
				},
				kichthuoc: {
					required: "Bạn chưa nhập kích thước sách"
				},
				sotrang: {
					required: "Bạn chưa nhập số trang",
					digits: "Bạn nhập số trang không hợp lệ",
					min: "Bạn phải nhập số trang lớn hơn 1"
				},
				soluong:{
					required: "Bạn chưa nhập số lượng",
					digits: "Bạn nhập số lượng không hợp lệ",
					min: "Bạn phải nhập số lượng lớn hơn 1"
				}
			}
		});
	});
</script>