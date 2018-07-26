<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Khách hàng</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>STT</th><th>Mã khách hàng</th><th>Tên khách hàng</th><th>Giới tính</th><th>Ngày sinh</th><th>Địa chỉ</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($result as $row) {
							$i++;
							if($row['GIOITINH'] == 0)
								$gioitinh = "Nữ";
							else
								$gioitinh = "Nam";
							$item = <<< EOD
								<tr>
									<td>$i</td>
									<td>{$row['MAKH']}</td>
									<td>{$row['TENKH']}</td>
									<td>$gioitinh</td>
									<td>{$row['NGAYSINH']}</td>
									<td>{$row['DIACHI']}</td>
									<td>
										<a href="admin.php?c=KhachHang&act=Sua&makh={$row['MAKH']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=KhachHang&act=Xoa&makh={$row['MAKH']}" class="btn btn-danger">Xoá</a>
									</td>
								</tr>
EOD;
							echo $item;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<a href="admin.php?c=KhachHang&act=TaoMoi" class="btn btn-default">Thêm khách hàng mới</a>
	</div>
</div>