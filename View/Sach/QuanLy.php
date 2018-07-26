<style>
	.table tbody tr td {
		vertical-align: middle;
	}
</style>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sách</h3>
	</div>
	<div class="panel-body">
		<form class="form-inline text-center" role="form" style="margin-bottom: 10px">
			<div class="form-group">
				<label for="tensach">Tên sách: </label>
				<input type="text" class="form-control" name="tensach" placeholder="Nhập tên sách">
			</div>
			<div class="form-group">
				<label for="madms">Danh mục: </label>
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
			<input type="hidden" name="c" value="Sach">
			<input type="hidden" name="act" value="QuanLy">
			<button type="submit" class="btn btn-primary">Lọc</button>
		</form>
		<hr>
		<a href="admin.php?c=Sach&act=TaoMoi" class="btn btn-default">Thêm sách mới</a>
		<div class="table-responsive">
			<h4 class="text-center">Danh sách các quyển sách</h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>STT</th><th>Tên sách</th><th>Tác giả</th><th>Giá bán</th><th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($result as $row) {
							$gia = number_format($row['GIABAN']);
							$i++;
							$item = <<< EOD
								<tr>
									<td>$i</td>
									<td class="col-sm-5">
										<img width="60px" height="80px" src="hinh/{$row['HINH']}"> {$row['TENSACH']}
									</td>
									<td>{$row['TENTG']}</td>
									<td>$gia VNĐ</td>
									<td>
										<a href="admin.php?c=Sach&act=ChiTiet_QL&masach={$row['MASACH']}" class="btn btn-default">Chi tiết</a>
										<a href="admin.php?c=Sach&act=Sua&masach={$row['MASACH']}" class="btn btn-primary">Sửa</a>
										<a href="admin.php?c=Sach&act=Xoa&masach={$row['MASACH']}" class="btn btn-danger">Xoá</a>
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
</div>
<script type="text/javascript">
	$().ready(function(e){
		$('.table tbody tr').css("cursor", "pointer");
		$('.table tbody tr').click(function(e){
			location.href=$(this).find('td a:first-child').attr("href");
		});
	});
</script>