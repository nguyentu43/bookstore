<style>
	.aside{
		background-color: #f5f5f5;
		border: 1px solid #ddd;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.toolbar{
		background-color: #eee;
		padding-top: 5px;
		padding-bottom: 5px;
		margin-bottom: 10px;
	}
</style>
<div class="container">
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 aside" >
		<form role="form" id="frmTimKiem">
			<div class="form-group">
				<label for="txtTenSach">Tên sách: </label>
				<input type="text" class="form-control" name="tensach" id="txtTenSach" placeholder="Nhập tên sách cần tìm" <?php if(!empty($_GET['tensach'])) echo "value='{$_GET['tensach']}'"; ?>>
			</div>
			<div class="form-group">
				<label for="txtTenTG">Tên tác giả: </label>
				<input type="text" class="form-control" name="tentg" id="txtTenTG" placeholder="Nhập tên tác giả cần tìm" <?php if(!empty($_GET['tentg'])) echo "value='{$_GET['tentg']}'"; ?>>
			</div>
			<div class="form-group">
				<label for="madms">Danh mục sách: </label>
				<select class="form-control" name="madms" id="cmbDanhMuc">
					<?php
						foreach ($result_dms as $row) {
							if(isset($dms_id) && $dms_id == $row['MADMS'])
								echo "<option selected value='{$row['MADMS']}'>{$row['TENDMS']}</option>";
							else
								echo "<option value='{$row['MADMS']}'>{$row['TENDMS']}</option>";
						}
						if($dms_id == 0)
							echo "<option selected value='0'>Tất cả</option>";
						else
							echo "<option value='0'>Tất cả</option>";
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="maloai">Thể loại sách: </label>
				<select class="form-control" name="maloai" id="cmbTheLoai">
					<?php
						foreach ($result_ls as $row) {
							if(isset($ls_id) && $ls_id == $row['MALOAI'])
								echo "<option selected value='{$row['MALOAI']}'>{$row['TENLOAI']}</option>";
							else
								echo "<option value='{$row['MALOAI']}'>{$row['TENLOAI']}</option>";
						}

						if($ls_id == 0)
							echo "<option selected value='0'>Tất cả</option>";
						else
							echo "<option value='0'>Tất cả</option>";
					?>
				</select>
			</div>
			<div class="form-group">
				<label id="label-slider-range">Giá từ: </label>
				<div id="slider-range"></div>
			</div>
			<input type="hidden" name="act" value="DanhSach">
			<input type="hidden" name="c" value="Sach">
			<input type="hidden" name="gia1" <?php if(isset($_REQUEST['gia1'])) echo "value='{$_REQUEST['gia1']}'"; else echo "value='20000'"; ?> >
			<input type="hidden" name="gia2" <?php if(isset($_REQUEST['gia2'])) echo "value='{$_REQUEST['gia2']}'"; else echo "value='100000'"; ?>>
			<input type="hidden" name="danght" id="danght" value="grid">
			<button type="submit" name="btnTimKiem" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm kiếm</button>
		</form>
	</div>
	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
		<div class="panel panel-default">
			<div class="panel-heading text-right">
				<strong>Sắp xếp theo giá: </strong>
				<div class="btn-group">
					<button type="button" id="btnXoaSX" <?php if($sapxep == 0) echo "class='btn btn-danger'"; else echo "class='btn btn-default'"; ?>><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<button type="button" id="btnTangDan" <?php if($sapxep == 1) echo "class='btn btn-danger'"; else echo "class='btn btn-default'"; ?>><span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></button>
					<button type="button" id="btnGiamDan" <?php if($sapxep == -1) echo "class='btn btn-danger'"; else echo "class='btn btn-default'"; ?>><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></button>
				</div>
				<strong>Chọn chế độ xem: </strong>
				<div class="btn-group">
					<button type="button" id="btnGrid" <?php if(!isset($_GET['danght']) || (isset($_GET['danght']) && $_GET['danght'] != "list")) echo "class='btn btn-danger'"; else echo "class='btn btn-default'"; ?>><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
					<button type="button" id="btnList" <?php if(isset($_GET['danght']) && $_GET['danght'] == "list") echo "class='btn btn-danger'"; else echo "class='btn btn-default'"; ?>><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
				</div>
			</div>
			<div class="panel-body">
<?php
	if(count($result) == 0)
	{
		echo "<h5>Không có sách. Bạn hãy tìm kiếm với từ khoá khác.</h5>";
	}
	else
	{
		foreach ($result as $row) {
			$gia = number_format($row['GIABAN']);

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
				$button = '<button type="button" class="btn btn-danger btnThem">Đặt ngay</button>';
			}
			else
			{
				$button = '<button type="button" class="btn btn-danger disabled">Hết hàng</button>';
			}

			if(isset($_GET['danght']) && $_GET['danght'] == "list")
			{
				$item = <<<EOD
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default panel-sach">
						<div class="panel-body">
							<div class="col-sm-4 text-center">
								<img class="biasach" src="hinh/{$row['HINH']}">
								$moi
							</div>
							<div class="col-sm-8">
								<div class="tensach"><a href="index.php?c=Sach&act=ChiTiet&madms={$row['MADMS']}&maloai={$row['MALOAI']}&masach={$row['MASACH']}">{$row['TENSACH']}</a></div>
								<div class="tentg">Tác giả: {$row['TENTG']}</div>
								<div class="tennxb">Nhà xuất bản: {$row['TENNXB']}</div>
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
				</div>
EOD;
				echo $item;
			}
			else
			{
				$item = <<<EOD
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
		}

		if(isset($count_book) && $count_book > 0 && $count_book > ITEMS_PAGE)
		{
			$querystr = '?';
			$i = 0;
			foreach ($_REQUEST as $key => $value) {
				if($key == "offset")
					continue;
				$i++;
				$querystr.="$key=$value";
				if($i < count($_REQUEST))
					$querystr.="&";
			}

			echo '<div class="col-md-12 text-center"><ul class="pagination">';

			$totalpage = (int) ($count_book/ITEMS_PAGE);
			
			if($count_book % ITEMS_PAGE > 0) $totalpage++;

			$curpage = (int) ($offset / ITEMS_PAGE) + 1;

			if($curpage == 1)
				echo "<li class='disabled'><a href=''>&laquo;</a></li>";
			else
			{
				$i = ($curpage - 2) * ITEMS_PAGE;
				echo "<li><a href='index.php$querystr&offset=$i'>&laquo;</a></li>";
			}

			for ($i=1; $i <= $totalpage; $i++) { 
				$value = ($i - 1) * ITEMS_PAGE;
				if($i == $curpage)
					echo "<li class='active'><a href='index.php$querystr&offset=$value'>$i</a></li>";
				else
					echo "<li><a href='index.php$querystr&offset=$value'>$i</a></li>";
			}

			if($curpage == $totalpage)
			{
				echo "<li class='disabled'><a href='#'>&raquo;</a></li>";
			}
			else
			{
				$i = $curpage*ITEMS_PAGE;
				echo "<li><a href='index.php$querystr&offset=$i'>&raquo;</a></li>";
			}

			echo '</ul></div>';
		}
	}
?>
			</div>
		</div>
	</div>
</div>