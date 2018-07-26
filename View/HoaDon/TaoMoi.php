<form class="form-horizontal" role="form" id="frmHoaDon">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tạo hoá đơn mới</h3>
	</div>
	<div class="panel-body">
		<div class="form-group" id="kh">
			<label class="control-label col-sm-2" for="makh">Khách hàng: </label>
			<div class="col-sm-5">
				<select name="makh" class="form-control" required>
					<?php
						foreach ($result_kh as $r) {
							echo "<option value='{$r['MAKH']}'>{$r['TENKH']}</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="tennn">Tên người nhận: </label>
			<div class="col-sm-5">
				<input type="text" name="tennn" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="diachi">Đia chỉ: </label>
			<div class="col-sm-5">
				<input type="text" name="diachi" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="sdt">Số điện thoại: </label>
			<div class="col-sm-5">
				<input type="text" name="sdt" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email: </label>
			<div class="col-sm-5">
				<input type="text" name="email" class="form-control" required>
			</div>
		</div>
		<input type="hidden" name="c" value="HoaDon">
		<input type="hidden" name="act" value="Them">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Chi tiết hoá đơn</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover" id="table-cthd">
					<thead>
						<tr>
							<th>STT</th><th>Tên sách</th><th>Số lượng</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<button type="button" id="themsp" class="btn btn-primary">Thêm sản phẩm</button>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<button type="submit" name="btnThem" class="btn btn-primary">Thêm</button>
	</div>
</div>
<?php
	$item_cthd = "<td><select name='masach[]' class='form-control'>";

	foreach ($result_s as $row_s)
	{
		$item_cthd.="<option value='{$row_s['MASACH']}'>{$row_s['TENSACH']}</option>";
	}

	$item_cthd.="</select></td>";
	$item_cthd.="<td><input type='number' min='1' name='soluong[]'' value='1' class='form-control' required></td>";
	$item_cthd.="<td><button type='button' class='btn btn-danger xoa_xp'>Xoá</button></td>";
?>
</form>
<script>
	$().ready(function(e){
		$('#themsp').click(function(e){
			var i = $('#table-cthd tbody tr').length + 1;
			var stt = "<tr><td class='stt'>" + i + "</td>";
			$('#table-cthd tbody').append(stt + "<?php echo $item_cthd; ?>" + "</tr>");

			$('.xoa_xp').click(function(e){
				$(this).parent().parent().remove();

				$('.stt').each(function(index){
					$(this).text(index + 1);
				});
			});
		});

		$('#frmHoaDon').validate({
			rules: {
				sdt: {
					digits: true,
					minlength: 7
				},
				email: {
					email: true
				}
			},
			messages: {
				makh : {
					required: "Bạn chưa chọn khách hàng"
				},
				tennn: {
					required: "Bạn chưa nhập tên người nhận"
				},
				sdt: {
					required: "Bạn chưa nhập số điện thoại",
					digits: "Bạn nhập số điện thoại không hợp lệ",
					minlength: "Bạn nhập số điện thoại không hợp lệ"
				},
				email: {
					required: "Bạn chưa nhập địa chỉ email",
					email: "Bạn nhập địa chỉ email chưa hợp lệ"
				},
				diachi: {
					required: "Bạn chua nhập địa chỉ"
				}
			}
		});
	});
</script>