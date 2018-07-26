<?php
	echo '<ul class="nav navbar-nav">';
	if(isset($_REQUEST['madms']) && $_REQUEST['madms'] == 0)
		echo '<li class="active"><a href="index.php?c=Sach&act=DanhSach&madms=0&maloai=0">Tất cả sách</a></li>';
	else
		echo '<li><a href="index.php?c=Sach&act=DanhSach&madms=0&maloai=0">Tất cả sách</a></li>';
	foreach ($result as $row) {
		$active = '';
		if(isset($_REQUEST['madms']) && $_REQUEST['madms'] == $row['MADMS'])
			$active = 'active';
		$dms = <<< EOD
		<li class="dropdown $active">
			<a href='index.php?c=Sach&act=DanhSach&madms={$row['MADMS']}' class="dropdown-toggle" data-toggle="dropdown"> {$row['TENDMS']}<b class="caret"></b></a>
			<ul class="dropdown-menu">
EOD;
		echo $dms;

		if(isset($_REQUEST['maloai']) && $_REQUEST['maloai'] == 0 && isset($_REQUEST['madms']) && $_REQUEST['madms'] == $row['MADMS'])
		{
			echo "<li class='active'><a href='index.php?c=Sach&act=DanhSach&madms={$row['MADMS']}&maloai=0''>Tất cả</a></li>";
		}
		else
		{
			echo "<li><a href='index.php?c=Sach&act=DanhSach&madms={$row['MADMS']}&maloai=0''>Tất cả</a></li>";
		}

		foreach ($row['DSLoaiSach'] as $ls) 
		{
			if(isset($_REQUEST['maloai']) && $_REQUEST['maloai'] == $ls['MALOAI'] && isset($_REQUEST['madms']) && $_REQUEST['madms'] == $row['MADMS'])
			{
				echo "<li class='active'><a href='index.php?c=Sach&act=DanhSach&madms={$row['MADMS']}&maloai={$ls['MALOAI']}''>{$ls['TENLOAI']}</a></li>";
			}
			else
			{
				echo "<li><a href='index.php?c=Sach&act=DanhSach&madms={$row['MADMS']}&maloai={$ls['MALOAI']}''>{$ls['TENLOAI']}</a></li>";
			}
		}
		echo "</ul></li>";
	}
?>
</ul>