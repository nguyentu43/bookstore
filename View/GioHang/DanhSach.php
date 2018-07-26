<?php
	if(isset($_REQUEST['btnThem']))
	{
		echo json_encode(0);
	}
	else if(isset($_REQUEST['btnXoa']))
	{
		echo json_encode(0);
	}
	else if(isset($_REQUEST['btnCapNhat']))
	{
		echo json_encode($res);
	}
	else
	{
?>

<style type="text/css">
	.table > tbody > tr > td {
		vertical-align: middle;
	} 
</style>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Giỏ hàng của bạn</h3>
		</div>
		<div class="panel-body">
			<?php
				if(count($result) == 0 || !isset($_SESSION['GioHang'])):
					$thongbao = <<< EOD
					<h5>Bạn không có sách nào trong giỏ</h5>
					<div>
						<a href="index.php">Nhấp vào đây để xem các quyển sách khác</a>
					</div>
EOD;
					echo $thongbao;
				else:
			?>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>STT</th><th>Thông tin sách</th><th>Số lượng</th><th class="text-right">Xoá sách</th><th class="text-right">Tổng giá bán</th>
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
									<input type="hidden" name="masach" value="{$row['MASACH']}">
									<td class="col-md-1 stt">$id</td>
									<td class="col-md-6">
										<img height="100" width="70" class="img-thumbnail" src="hinh/{$row['HINH']}">
										{$row['TENSACH']} x {$row['SoLuong']}
									</td>
									<td class="col-md-2">
										<div class="col-xs-12">
											<input type="number" class="form-control capnhat" min="1" max="20" value='{$row['SoLuong']}' name="soluong" required>
										</div>
									</td>
									<td class="col-md-1 text-right">
										<button type="submit" class="btn btn-danger btnXoa" name="btnXoa">Xoá</button>
									</td>
									<td class="col-md-2 text-danger text-right tonggia">$gia VNĐ</td>
								</tr>
EOD;
								$id++;
								echo $item;
							endforeach;

							$tong = number_format($tonghd);
							$tr = <<<EOD
							<tr class="text-right active">
								<td colspan="4"><strong>Tổng hoá đơn: </strong></td>
								<td colspan="2" class="text-danger" id="tonghd">{$tong} VNĐ</td>
							</tr>
EOD;
							echo $tr;
					?>
				</tbody>
			</table>
			<?php
				endif;
			?>
		</div>
		
		<?php
			if(count($result) > 0)
			{
				$panel_footer = <<< EOD
		<div class="panel-footer text-right">
			<form>
				<input type="hidden" name="c" value="GioHang">
				<input type="hidden" name="act" value="DatHang">
				<button type="submit" class="btn btn-primary">Tiến hàng đặt hàng</button>
			</form>
		</div>
EOD;
				echo $panel_footer;
			}
		?>
	</div>
</div>
<?php
	}
?>