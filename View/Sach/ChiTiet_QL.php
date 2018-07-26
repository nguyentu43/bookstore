<style>
	.hinh{
		height: 480px;
	}

	.hinh img{
		top: 50%;
		left: 50%;
		position: absolute;
		transform: translate(-50%, -50%);
		max-height: 300px;
	}
</style>
<?php
	$gia = number_format($result['GIABAN']);
	$item = <<< EOD
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-right">
				<a href="admin.php?c=Sach&act=Sua&masach={$result['MASACH']}" class="btn btn-primary">Sửa</a>
				<a href="admin.php?c=Sach&act=Xoa&masach={$result['MASACH']}" class="btn btn-danger">Xoá</a>
			</div>
			<h4>Chi tiết sách</h4>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 hinh text-center">
						<img src="hinh/{$result['HINH']}">
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
						<h3 class="text-primary">{$result['TENSACH']}</h3>
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
										<td>Danh mục sách: </td><td>{$result['TENDMS']}</td>
									</tr>
									<tr>
										<td>Thể loại: </td><td>{$result['TENLOAI']}</td>
									</tr>
									<tr>
										<td>Kích thước: </td><td>{$result['KICHTHUOC']}</td>
									</tr>
									<tr>
										<td>Số trang: </td><td>{$result['SOTRANG']}</td>
									</tr>
									<tr>
										<td>Số lượng: </td><td>{$result['SOLUONG']}</td>
									</tr>
									<tr>
										<td>Còn lại: </td><td>{$result['CONLAI']}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<h3 class="text-danger">Giá bán: $gia VNĐ</h3>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Giới thiệu về sách</h3>
				</div>
				<div class="panel-body">
					{$result['BAIGIOITHIEU']}
				</div>
			</div>
		</div>
	</div>
EOD;
	echo $item;
?>