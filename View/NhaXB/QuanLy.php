<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nhà xuất bản</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã nhà xuất bản</th><th>Tên nhà xuất bản</th><th>Địa chỉ</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $row) {
							$item = <<< EOD
								<tr>
									<td>{$row['MANXB']}</td>
									<td>{$row['TENNXB']}</td>
									<td>{$row['DIACHI']}</td>
									<td>
										<a href="admin.php?c=NhaXB&act=Sua&manxb={$row['MANXB']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=NhaXB&act=Xoa&manxb={$row['MANXB']}" class="btn btn-danger">Xoá</a>
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
		<a href="admin.php?c=NhaXB&act=TaoMoi" class="btn btn-default">Thêm nhà xuất bản mới</a>
	</div>
</div>