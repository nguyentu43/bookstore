<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Danh mục sách</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã danh mục</th><th>Tên danh mục</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $row) {
							$item = <<< EOD
								<tr>
									<td>{$row['MADMS']}</td>
									<td>{$row['TENDMS']}</td>
									<td>
										<a href="admin.php?c=DanhMuc&act=Sua&madms={$row['MADMS']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=DanhMuc&act=Xoa&madms={$row['MADMS']}" class="btn btn-danger">Xoá</a>
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
		<a href="admin.php?c=DanhMuc&act=TaoMoi" class="btn btn-default">Thêm danh mục sách mới</a>
	</div>
</div>