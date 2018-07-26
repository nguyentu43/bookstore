<style type="text/css">
	.breadcrumb{
		border: 1px solid #ddd;
	}
</style>
<div class="container">
	<ol class="breadcrumb">
		<li>
			<a href="index.php">Trang chủ</a>
		</li>
		<?php
			if(isset($timkiem))
			{
				echo "<li class='active'>Kết quả tìm kiếm</li>";
			}
			else
			{
				if(isset($_REQUEST['top']))
				{
					if($_REQUEST['top'] == 'banchay')
					{
						echo "<li class='active'>Sách bán chạy</li>";
					}
					else if($_REQUEST['top'] == 'moixb')
					{
						echo "<li class='active'>Sách mới xuất bản</li>";
					}
				}
				else
				{
					if($_REQUEST['madms'] == 0)
					{
						echo "<li class='active'>Tất cả</li>";
					}
					else
					{
						if(!isset($result_ls))
						{
							echo "<li class='active'>{$result_dms['TENDMS']}</li>";
						}
						else
						{
							$str1 = <<<EOD
								<li>
									<a href="index.php?c=Sach&act=DanhSach&madms={$result_dms['MADMS']}">{$result_dms['TENDMS']}</a>
								</li>
EOD;
							echo $str1;

							if(!isset($tensach))
							{
								echo "<li class='active'>{$result_ls['TENLOAI']}</li>";
							}
							else
							{
								$str2 = <<<EOD
								<li>
									<a href="index.php?c=Sach&act=DanhSach&madms={$result_dms['MADMS']}&maloai={$result_ls['MALOAI']}">{$result_ls['TENLOAI']}</a>
								</li>
EOD;
								echo $str2;

								echo "<li class='active'>{$tensach}</li>";
							}
						}
					}
				}
			}
		?>
	</ol>
</div>
