<style>
	.hinh{
		height: 370px;
	}

	.hinh img{
		top: 30%;
		left: 50%;
		position: absolute;
		transform: translate(-50%, -30%);
		max-height: 250px;
	}

	.hinh .rate{
		left: 50%;
		bottom: 20px;
		position: absolute;
		transform: translateX(-50%);
	}

	#star{
		position: absolute;
	}

	#star .text{
		font-size: 26px;
	}
</style>
<?php
	$moi = '';

	$ngayxb = $result['NGAYXB'];
	if($ngayxb != '')
	{

		$today = date('Y-m-d');

		$diff = date_diff(date_create($today), date_create($ngayxb));

		$day = $diff->format("%a");

		if(intval($day) <= 30)
		{
			$moi = "<div class='moi'>NEW</div>";
		}
	}

	if($result['CONLAI'] > 0)
	{
		$button = '<button type="button" class="btn btn-danger btn-lg btnThem" >Đặt ngay</button>';
	}
	else
	{
		$button = '<button type="submit" class="btn btn-danger btn-lg disabled">Hết hàng</button>';
	}

	$gia = number_format($result['GIABAN']);

	$option_danhgia = '';
	for ($i=1; $i <=5; $i++) { 
		if(isset($diem) && $diem == $i)
		{
			$option_danhgia.="<option value='$i' selected>$i</option>";
		}
		else
		{
			$option_danhgia.="<option value='$i'>$i</option>";
		}
	}

	$ddg = '';
	if(isset($diem))
		$ddg = "(Bạn đã thực hiện đánh giá)";

	$tdg = '';

	if(isset($diemdg))
	{
		$tdg = <<< EOD
		<span class="fa-stack fa-3x" id="star">
			<i class="fa fa-star fa-stack-2x" aria-hidden="true" style="color: #ffeb3b"></i>
			<strong class="fa-stack-1x text">$diemdg</strong>
		</span>
EOD;
	}

	$item = <<<EOD
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 hinh">
					<img src="hinh/{$result['HINH']}">
					$moi
					$tdg
					<div class="rate text-center">
					<h5>Đánh giá sản phẩm</h5>
						<select id="barrating">
							<option value=""></option>
							$option_danhgia
						</select>
						$ddg
					</div>
				</div>
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
					<div class="tensanpham"><h3 class="text-primary">{$result['TENSACH']}</h3></div>
					<div class="thongtincoban">
						<table class="table table-hover">
							<caption><h4>Thông tin sách</h4></caption>
							<tbody>
								<tr>
									<td>Tác giả: </td><td>{$result['TENTG']}</td>
								</tr>
								<tr>
									<td>Nhà xuất bản: </td><td>{$result['TENNXB']}</td>
								</tr>
								<tr>
									<td>Kích thước: </td><td>{$result['KICHTHUOC']}</td>
								</tr>
								<tr>
									<td>Số trang: </td><td>{$result['SOTRANG']}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="giaban"><h3 class="text-danger">Giá bán: $gia VNĐ</h3></div>
					<form method="post">
						<input type="hidden" name="masach" value="{$result['MASACH']}">
						<input type="hidden" name="btnThem">
						$button
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container" style="margin-top: 20px">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Giới thiệu về sách</h3>
			</div>
			<div class="panel-body">
				{$result['BAIGIOITHIEU']}
			</div>
		</div>
	</div>
EOD;
	echo $item;
?>

<?php 
	if(count($list_book) > 1):
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Các quyển sách liên quan</h3>
		</div>
		<div class="panel-body">
			<?php
				$size = 4;
				if(count($list_book) < 4)
					$size = count($list_book);
				for ($i=0; $i < $size; $i++) {
					$row = $list_book[$i];
					if($row['MASACH'] == $id)
						continue;
					$moi = '';
					$ngayxb = $row['NGAYXB'];
					if($ngayxb != '')
					{
						$today = date('Y-m-d');

						$diff = date_diff(date_create($today), date_create($ngayxb));

						$day = $diff->format("%a");

						if(intval($day) <= 30)
						{
							$moi = '<div class="moi">NEW</div>';
						}
					}

					if($row['CONLAI'] > 0)
					{
						$button = '<button type="submit" class="btn btn-danger" name="btnThem">Mua ngay</button>';
					}
					else
					{
						$button = '<button type="button" class="btn btn-danger disabled">Hết hàng</button>';
					}

					$gia = number_format($row['GIABAN']);
					$sach = <<<EOD
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<div class="panel panel-default">
							<div class="panel-body panel-sach text-center">
								<img class="biasach" src="hinh/{$row['HINH']}">
								$moi
								<div class="tensach text-ellipsis"><a href="index.php?act=xem&hienthi=chitiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}">{$row['TENSACH']}</a></div>
								<div class="giaban text-danger">Giá bán: $gia VNĐ</div>
								<form method="post">
									<input type="hidden" name="masach" value="{$row['MASACH']}">
									<div class="btn-group">
										$button
										<a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}" class="btn btn-primary">Chi tiết</a>
									</div>
								</form>
							</div>
						</div>
					</div>
EOD;
					echo $sach;
				}
			?>
		</div>
	</div>
</div>
<?php
	endif;
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Bình luận về sách</h3>
		</div>
		<div class="panel-body">
			<div id="comments-container"></div>
		</div>
	</div>
</div>