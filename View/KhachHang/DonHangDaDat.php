<style>
	.thongtin div{
		padding: 5px;
	}
</style>
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Các đơn hàng</h3>
			</div>
			<div class="panel-body">
				<?php
					if(!isset($_SESSION['TaiKhoan'])):
						echo "<h5>Bạn chưa đăng nhập.</h5>";
					else:
						if(count($result_hd) == 0):
							echo "<h5>Bạn không có đơn hàng nào đã đặt.</h5>";
						else:
							foreach ($result_hd as $hd):
								if(count($hd['ChiTietHoaDon']) == 0)
									continue;
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Mã hoá đơn: <?php echo $hd['MAHD']; ?></h3>
					</div>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body thongtin">
								<div><strong>Họ và tên người nhận: </strong><?php echo $hd['TENNN']; ?></div>
								<div><strong>Địa chỉ: </strong><?php echo $hd['DIACHI']; ?></div>
								<div><strong>Số điện thoại: </strong><?php echo $hd['SDT']; ?></div>
								<div><strong>Email: </strong><?php echo $hd['EMAIL']; ?></div>
								<div><strong>Tổng tiền: </strong><?php echo number_format($hd['TONGTIEN']); ?> VNĐ</div>
							</div>
						</div>
						<h4 class="text-center">Chi tiết hoá đơn</h4>
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>STT</th><th>Tên sách</th><th>Số lượng</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 0;
									foreach ($hd['ChiTietHoaDon'] as $r):
										$i++;
										$tr = <<< EOD
										<tr>
											<td>$i</td>
											<td>{$r['TENSACH']}</td>
											<td>{$r['SOLUONG']}</td>
										</tr>
EOD;
										echo $tr;
									endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
				<?php
							endforeach;
						endif;
					endif;
				?>
			</div>
		</div>
	</div>
</div>