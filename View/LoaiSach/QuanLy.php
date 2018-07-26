<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Loại sách</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã loại sách</th><th>Tên loại sách</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $row) {
							$item = <<< EOD
								<tr>
									<td>{$row['MALOAI']}</td>
									<td>{$row['TENLOAI']}</td>
									<td>
										<a href="admin.php?c=LoaiSach&act=Sua&maloai={$row['MALOAI']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=LoaiSach&act=Xoa&maloai={$row['MALOAI']}" class="btn btn-danger">Xoá</a>
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
		<a href="admin.php?c=LoaiSach&act=TaoMoi" class="btn btn-default">Thêm loại sách mới</a>
	</div>
</div>