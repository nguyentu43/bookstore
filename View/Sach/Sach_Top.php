<div class="container">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Sách bán chạy</h3>
		</div>
		<div class="panel-body">
				<div class="multi-book">
				<?php
					foreach($result_banchay as $row) {
						$moi = '';

						$ngayxb = $row['NGAYXB'];
						$today = date('Y-m-d');

						$diff = date_diff(date_create($today), date_create($ngayxb));

						$day = $diff->format("%a");

						if(intval($day) <= 30)
						{
							$moi = '<div class="moi">NEW</div>';
						}

						if($row['CONLAI'] > 0)
						{
							$button = '<button type="button" class="btn btn-danger btnThem">Đặt ngay</button>';
						}
						else
						{
							$button = '<button type="button" class="btn btn-danger disabled">Hết hàng</button>';
						}

						$gia = number_format($row['GIABAN']);
						$item = <<<EOD
						<div class="col-md-3">
							<div class="panel panel-default panel-sach">
								<div class="panel-body text-center">
									<img class="biasach" src="hinh/{$row['HINH']}">
									$moi
									<div class="tensach text-ellipsis"><a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}">{$row['TENSACH']}</a></div>
									<div class="giaban text-danger">Giá bán: $gia VNĐ</div>
									<form method="post">
										<input type="hidden" name="masach" value="{$row['MASACH']}">
										<input type="hidden" name="btnThem">
										<div class="btn-group">
											$button
											<a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}" class="btn btn-primary">Chi tiết</a>
										</div>
									</form>
								</div>
							</div>
						</div>
EOD;
						echo $item;
					}
				?>
			</div>
		</div>
		<div class="panel-footer text-right">
			<a href="index.php?top=banchay&c=Sach&act=DanhSach" class="btn btn-danger">Xem thêm sách bán chạy</a>
		</div>
	</div>
	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Sách mới xuất bản</h3>
		</div>
		<div class="panel-body">
			<div class="multi-book">
				<?php
					foreach($result_moixb as $row) {
						$moi = '<div class="moi">NEW</div>';
						if($row['CONLAI'] > 0)
						{
							$button = '<button type="button" class="btn btn-danger btnThem">Đặt ngay</button>';
						}
						else
						{
							$button = '<button type="button" class="btn btn-danger disabled">Hết hàng</button>';
						}
						
						$gia = number_format($row['GIABAN']);
						$item = <<<EOD
						<div class="col-md-3">
							<div class="panel panel-default panel-sach">
								<div class="panel-body text-center">
									<img class="biasach" src="hinh/{$row['HINH']}">
									$moi
									<div class="tensach text-ellipsis"><a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}">{$row['TENSACH']}</a></div>
									<div class="giaban text-danger">Giá bán: $gia VNĐ</div>
									<form method="post">
										<input type="hidden" name="masach" value="{$row['MASACH']}">
										<input type="hidden" name="btnThem">
										<div class="btn-group">
											$button
											<a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}" class="btn btn-primary">Chi tiết</a>
										</div>
									</form>
								</div>
							</div>
						</div>
EOD;
						echo $item;
					}
				?>
			</div>
		</div>
		<div class="panel-footer text-right">
			<a href="index.php?top=moixb&c=Sach&act=DanhSach" class="btn btn-primary">Xem thêm sách mới xuất bản</a>
		</div>
	</div>

	<?php
		foreach ($result_dms as $r):
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $r['TENDMS'];?></h3>
		</div>
		<div class="panel-body">
			<div class="multi-book">
				<?php
					foreach($r['Sach'] as $row):
						$moi = '';

						$ngayxb = $row['NGAYXB'];
						$today = date('Y-m-d');

						$diff = date_diff(date_create($today), date_create($ngayxb));

						$day = $diff->format("%a");

						if(intval($day) <= 30):
							$moi = '<div class="moi">NEW</div>';
						endif;

						if($row['CONLAI'] > 0):
							$button = '<button type="button" class="btn btn-danger btnThem">Đặt ngay</button>';
						else:
							$button = '<button type="button" class="btn btn-danger disabled">Hết hàng</button>';
						endif;

						$gia = number_format($row['GIABAN']);
						$item = <<<EOD
						<div class="col-md-3">
							<div class="panel panel-default panel-sach">
								<div class="panel-body text-center">
									<img class="biasach" src="hinh/{$row['HINH']}">
									$moi
									<div class="tensach text-ellipsis"><a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}">{$row['TENSACH']}</a></div>
									<div class="giaban text-danger">Giá bán: $gia VNĐ</div>
									<form method="post">
										<input type="hidden" name="masach" value="{$row['MASACH']}">
										<input type="hidden" name="btnThem">
										<div class="btn-group">
											$button
											<a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}" class="btn btn-primary">Chi tiết</a>
										</div>
									</form>
								</div>
							</div>
						</div>
EOD;
						echo $item;
					endforeach;
				?>
			</div>
		</div>
		<?php
			$tendms = mb_strtolower($r['TENDMS'],'UTF-8');
			$footer = <<< EOD
			<div class="panel-footer text-right">
			<a href="index.php?&c=Sach&act=DanhSach&madms={$r['MADMS']}" class="btn btn-default">Xem thêm sách $tendms</a>
		</div>
EOD;
			echo $footer;
		?>
	</div>
<?php
	endforeach;
?>
</div>
