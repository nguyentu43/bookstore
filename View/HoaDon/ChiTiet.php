<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Chi tiết hoá đơn</h3>
	</div>
	<div class="panel-body">
		<?php
			$tonghd = number_format($result_hd['TONGTIEN']);
			$hd = <<< EOD
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="pull-right">
							<a href="admin.php?c=HoaDon&act=Sua&mahd={$result_hd['MAHD']}" class="btn btn-primary">Sửa</a>
							<a href="admin.php?c=HoaDon&act=Xoa&mahd={$result_hd['MAHD']}" class="btn btn-danger">Xoá</a>
						</div>
						<h5>Thông tin hoá đơn</h5>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td><strong>Mã hoá đơn: </strong></td><td>{$result_hd['MAHD']}</td>
								</tr>
								<tr>
									<td><strong>Tên khách hàng: </strong></td><td>{$result_hd['TENKH']}</td>
								</tr>
								<tr>
									<td><strong>Tên người nhận: </strong></td><td>{$result_hd['TENNN']}</td>
								</tr>
								<tr>
									<td><strong>Địa chỉ: </strong></td><td>{$result_hd['DIACHI']}</td>
								</tr>
								<tr>
									<td><strong>Số điện thoại: </strong></td><td>{$result_hd['SDT']}</td>
								</tr>
								<tr>
									<td><strong>Email: </strong></td><td>{$result_hd['EMAIL']}</td>
								</tr>
								<tr>
									<td><strong>Ngày hoá đơn: </strong></td><td>{$result_hd['NGAYHD']}</td>
								</tr>
								<tr>
									<td><strong>Tổng tiền: </strong></td><td>$tonghd VNĐ</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
EOD;
			echo $hd;
		?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Chi tiết hoá đơn</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>STT</th><th>Tên sách</th><th>Số lượng</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i = 0;
							foreach ($result_cthd as $row) {
								$i++;
								$r = <<< EOD
									<tr>
										<td>$i</td>
										<td>{$row['TENSACH']}</td>
										<td>{$row['SOLUONG']}</td>
									</tr>
EOD;
								echo $r;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>