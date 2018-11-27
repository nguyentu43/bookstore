<?php
	$option_month = '';
	for ($i=1; $i <=12 ; $i++) { 
		if(isset($_REQUEST['thang']) && $_REQUEST['thang'] == $i)
			$option_month.="<option selected value='$i'>$i</option>";
		else
			$option_month.="<option value='$i'>$i</option>";
	}

	$arr = [];
	
	$year = 2016;
	foreach(range(0, date('Y') - $year) as $i)
		$arr[] = $year + $i;

	$option_year = '';
	for ($i=0; $i <count($arr) ; $i++) { 
		if(isset($_REQUEST['nam']) && $_REQUEST['nam'] == $arr[$i])
			$option_year.="<option selected value='{$arr[$i]}'>{$arr[$i]}</option>";
		else
			$option_year.="<option value='{$arr[$i]}'>{$arr[$i]}</option>";
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Thống kê</h3>
	</div>
	<div class="panel-body">
		<form class="form-inline text-center" role="form" style="margin-bottom: 40px">
			<label>Chọn</label>
			<div class="form-group">
				<label for="thang"> tháng: </label>
				<select class="form-control" name="thang" id="thang" required>
					<?php echo $option_month; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="name">Năm: </label>
				<select class="form-control" name="nam" id="nam" required>
					<?php echo $option_year; ?>
				</select>
			</div>
			<input type="hidden" name="c" value="ThongKe">
			<input type="hidden" name="act" value="ThongKe">
			<button type="submit" name="btnThongKe" class="btn btn-primary">Thống kê</button>
		</form>

		<?php
			if(isset($result)):
				if(count($result) > 0):
		?>
		<h3 class="text-center">DOANH THU THÁNG <?php echo $_GET['thang']."/".$_GET['nam'];?></h3>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>STT</th><th>Ngày</th><th>Số lượng sách đã bán</th><th class="text-right">Tổng doanh thu</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						$tong = 0;
						foreach ($result as $row):
							$tong += $row['TONGHD'];
							$tonghd = number_format($row['TONGHD']);
							$i++;
							$r = <<< EOD
								<tr>
									<td>$i</td><td>{$row['NGAYHD']}</td><td>{$row['SLSACHBAN']}</td><td class="text-right">$tonghd VNĐ</td>
								</tr>
EOD;
							echo $r;
							$pdf[] = array("$i", $row['NGAYHD'], $row['SLSACHBAN'], array("text" => "$tonghd VNĐ", "alignment" => "right"));
						endforeach;
						$tongdtt = number_format($tong);
						echo "<tr class='text-right'><td colspan='3' ><strong>Tổng doanh thu tháng: </strong></td><td>$tongdtt VNĐ</td></tr>";
						?>
				</tbody>
			</table>
			<button type="button" id="xuatpdf" class="btn btn-default">Xuất tập tin PDF</button>
			<script>
				$().ready(function(e){
					$('#xuatpdf').click(function(e){
						var table = <?php echo json_encode($pdf); ?>;
						table.unshift([{text: "STT", bold: true}, {text: "Ngày", bold: true}, {text: "Số lượng sách đã bán", bold: true}, {text: "Tổng doanh thu", bold: true, alignment: 'right'}]);
						table.push([{colSpan: 3, text: "Tổng doanh thu tháng: ", bold: true, alignment: 'right'}, {}, {}, {text: <?php echo "'$tongdtt VNĐ'"; ?>, alignment: 'right'} ]);
						var caption = "DOANH THU THÁNG " + $('#thang').val() + "/" + $('#nam').val();
						var doc = {
							content: [
								{
									text: caption, style: 'caption'
								},
								{
									table: {
										headerRows: 1,
										widths: [50, 120, '*', 150],
										body: table
									}
								}
							],
							styles: {
								caption: {
									fontSize: 18, bold: true, alignment: 'center', margin: [0, 0, 0, 20]
								}
							}
						};

						pdfMake.createPdf(doc).open();
					});
				});
			</script>
		</div>
		<?php
				else:
					echo '<h5>Không có doanh thu nào trong tháng</h5>';
				endif;
			endif;
		?>
	</div>
</div>
