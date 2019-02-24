<div class="container">
	<?php
		if(!isset($_SESSION['TaiKhoan'])):
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Đặt hàng</h3>
			</div>
			<div class="panel-body">
				Bạn chưa đăng nhập tài khoản.
			</div>
		</div>
	<?php
		else:
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Đặt hàng</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h4>Nhập thông tin người nhận</h4>
				<form method="POST" role="form" id="frmDatHang">
					<div class="form-group">
						<label for="tennn">Họ và tên: </label>
						<input type="text" class="form-control" name="tennn" placeholder="Nhập họ tên" <?php if(isset($tenkh)) echo "value='$tenkh'"; ?> required>
					</div>
					<div class="form-group">
						<label for="diachi">Địa chỉ: </label>
						<input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ" required <?php if(isset($diachi)) echo "value='$diachi'"; ?>>
					</div>
					<div class="form-group">
						<label for="sdt">Số điện thoại: </label>
						<input type="text" class="form-control" name="sdt" placeholder="Nhập số điện thoại" required <?php if(isset($sdt)) echo "value='$sdt'"; ?>>
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" required <?php if(isset($email)) echo "value='$email'"; ?>>
					</div>
					<input type="hidden" value="DatHang" name="act">
					<button type="submit" class="btn btn-danger" name="btnDatHang">Đặt hàng</button>
				</form>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h4>Thông tin đơn hàng</h4>
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>STT</th><th>Tên sách</th><th>Số lượng</th><th class="text-right">Tổng giá</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$id = 1;
							$tonghd = 0;
							foreach ($result as $row):
								$tonghd+= $row['TongGia'];
								$gia = number_format($row['TongGia']);
								$item = <<<EOD
								<tr>
									<td>$id</td>
									<td class="col-sm-6">
										{$row['TENSACH']}
									</td>
									<td>
										{$row['SoLuong']}
									</td>
									<td class="text-right">$gia VNĐ</td>
								</tr>
EOD;
								$id++;
								echo $item;
							endforeach;

							$tong = number_format($tonghd);
							$tr = <<<EOD
							<tr class="text-right active">
								<td colspan="3"><strong>Tổng hoá đơn: </strong></td>
								<td class="text-danger">{$tong} VNĐ</td>
							</tr>
EOD;
							echo $tr;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php
	endif;
?>
</div>
