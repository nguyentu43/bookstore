<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Hoá đơn</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã hoá đơn</th><th>Ngày</th><th>Tên khách hàng</th><th>Tổng tiền</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($result as $row) {
							$tongtien = number_format($row['TONGTIEN']);
							$item = <<< EOD
								<tr>
									<td>{$row['MAHD']}</td>
									<td>{$row['NGAYHD']}</td>
									<td>{$row['TENKH']}</td>
									<td>$tongtien VNĐ</td>
									<td>
										<a href="admin.php?c=HoaDon&act=ChiTiet&mahd={$row['MAHD']}" class="btn btn-default">Chi tiết</a>
										<a href="admin.php?c=HoaDon&act=Sua&mahd={$row['MAHD']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=HoaDon&act=Xoa&mahd={$row['MAHD']}" class="btn btn-danger">Xoá</a>
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
		<a href="admin.php?c=HoaDon&act=TaoMoi" class="btn btn-default">Thêm hoá đơn mới</a>
	</div>
</div>
<script>
	$().ready(function(e){
		$('.table tbody tr').css("cursor", "pointer");
		$('.table tbody tr').click(function(e){
			location.href=$(this).find('td a:first-child').attr("href");
		});
	});
</script>