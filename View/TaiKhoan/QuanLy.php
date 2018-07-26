<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tài khoản</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Mã tài khoản</th><th>Tên tài khoản</th><th>Chức vụ</th><th>Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($result as $row) {
						if($row['TENTK'] == 'admin' || $row['TENTK'] == $_SESSION['TaiKhoan_QL']['TENTK'])
						{
							$tr = <<< EOD
						<tr>
							<td>{$row['MATK']}</td>
							<td>{$row['TENTK']}</td>
							<td>{$row['CHUCVU']}</td>
							<td>
								<a href="admin.php?c=TaiKhoan&act=Sua&matk={$row['MATK']}" class="btn btn-primary">Sửa</a>
							</td>
						</tr>
EOD;
						}
						else
						{
							$tr = <<< EOD
						<tr>
							<td>{$row['MATK']}</td>
							<td>{$row['TENTK']}</td>
							<td>{$row['CHUCVU']}</td>
							<td>
								<a href="admin.php?c=TaiKhoan&act=Sua&matk={$row['MATK']}" class="btn btn-primary">Sửa</a>
								<a href="admin.php?c=TaiKhoan&act=Xoa&matk={$row['MATK']}" class="btn btn-danger">Xoá</a>
							</td>
						</tr>
EOD;
						}
						echo $tr;
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<a href="admin.php?c=TaiKhoan&act=Them" class="btn btn-default">Thêm tài khoản mới</a>
	</div>
</div>