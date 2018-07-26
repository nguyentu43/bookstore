<?php
	if(isset($kq)):
		if($kq == true):
			$msg = "Cập nhật thành công";
		else:
			$msg = "Cập nhật không thành công";
		endif;

		$panel = <<< EOD
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Cập nhật hoá đơn</h3>
			</div>
			<div class="panel-body">
				$msg
			</div>
		</div>
EOD;
		echo $panel;

	else:
?>
<form class="form-horizontal" role="form" id="frmSuaHoaDon">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Sửa hoá đơn</h3>
		</div>
		<div class="panel-body">
			<?php

				$tonghd = number_format($result_hd['TONGTIEN']);
				$hd = <<< EOD
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Thông tin hoá đơn</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label col-sm-2">Mã hoá đơn: </label>
								<div class="col-sm-10">
									<p class="form-control-static">{$result_hd['MAHD']}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">Tên khách hàng: </label>
								<div class="col-sm-10">
									<p class="form-control-static">{$result_hd['TENKH']}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="tennn">Tên người nhận: </label>
								<div class="col-sm-10">
									<input type="text" name="tennn" value="{$result_hd['TENNN']}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="diachi">Địa chỉ: </label>
								<div class="col-sm-10">
									<input type="text" name="diachi" value="{$result_hd['DIACHI']}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="sdt">Số điện thoại: </label>
								<div class="col-sm-10">
									<input type="text" name="sdt" value="{$result_hd['SDT']}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email: </label>
								<div class="col-sm-10">
									<input type="text" name="email" value="{$result_hd['EMAIL']}" class="form-control" required>
								</div>
							</div>
							<input type="hidden" name="act" value="Sua">
							<input type="hidden" name="c" value="HoaDon">
							<input type="hidden" name="mahd" value="{$result_hd['MAHD']}">
							<input type="hidden" name="makh" value="{$result_hd['MAKH']}">
						</div>
					</div>
EOD;
				echo $hd;

				foreach ($result_cthd as $row) {
					
				}
			?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Chi tiết hoá đơn</h3>
				</div>
				<div class="panel-body">
					<table class="table table-hover" id="table-cthd">
						<thead>
							<tr>
								<th>STT</th><th>Tên sách</th><th>Số lượng</th><th>Thao tác</th>
							</tr>
						</thead>
						<tbody>
							<?php

								$i = 0;
								foreach ($result_cthd as $row) {
									$i++;

									$option_sach = '';

									foreach ($result_s as $row_s) {
										if($row_s['MASACH'] == $row['MASACH'])
										{
											$option_sach.="<option selected value='{$row_s['MASACH']}'>{$row_s['TENSACH']}</option>";
										}
										else
										{
											$option_sach.="<option value='{$row_s['MASACH']}'>{$row_s['TENSACH']}</option>";
										}
									}

									$r = <<< EOD
										<tr>
											<td class="stt">$i</td>
											<td>
												<select name="masach[]" class="form-control">
													$option_sach
												</select>
											</td>
											<td>
												<input type="number" min="1" name="soluong[]" class="form-control" value='{$row['SOLUONG']}' required>
											</td>
											<td>
												<button type="button" class="btn btn-danger xoa_xp">Xoá</button>
											</td>
										</tr>
EOD;
									echo $r;
								}

								$item_cthd = "<td><select name='masach[]' class='form-control'>";

								foreach ($result_s as $row_s)
								{
									$item_cthd.="<option value='{$row_s['MASACH']}'>{$row_s['TENSACH']}</option>";
								}

								$item_cthd.="</select></td>";
								$item_cthd.="<td><input type='number' min='1' name='soluong[]'' value='1' class='form-control' required></td>";
								$item_cthd.="<td><button type='button' class='btn btn-danger xoa_xp'>Xoá</button></td>";
							?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<button type="button" id="themsp" class="btn btn-primary">Thêm sản phẩm</button>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button type="submit" name="btnSua" class="btn btn-primary">Sửa</button>
		</div>
	</div>
</form>
<script>
	$().ready(function(e){
		function xoa()
		{
			$('.xoa_xp').click(function(e){
				$(this).parent().parent().remove();

				$('.stt').each(function(index){
					$(this).text(index + 1);
				});
			});
		}
		$('#themsp').click(function(e){
			var i = $('#table-cthd tbody tr').length + 1;
			var stt = "<tr><td class='stt'>" + i + "</td>";
			$('#table-cthd tbody').append(stt + "<?php echo $item_cthd; ?>" + "</tr>");
			xoa();
		});

		xoa();

		$('#frmSuaHoaDon').validate({
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

<?php
	endif;
?>