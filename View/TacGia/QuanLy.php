<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tác giả</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã tác giả</th><th>Tên tác giả</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $row) {
							$item = <<< EOD
								<tr>
									<td>{$row['MATG']}</td>
									<td>{$row['TENTG']}</td>
									<td>
										<a href="admin.php?c=TacGia&act=Sua&matg={$row['MATG']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=TacGia&act=Xoa&matg={$row['MATG']}" class="btn btn-danger">Xoá</a>
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
		<a href="admin.php?c=TacGia&act=TaoMoi" class="btn btn-default">Thêm tác giả mới</a>
	</div>
</div>