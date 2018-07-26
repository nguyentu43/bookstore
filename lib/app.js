$(document).ready(function(){

	$('.carousel').slick({
		autoplay: true,
		dots: true
	});

	$('.multi-book').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 4
	});

	$('#btnTangDan').click(function(){
		var querystring = location.search;
		if(querystring.indexOf("sapxep=") > -1)
		{
			querystring = querystring.replace("sapxep=-1", "sapxep=1");
		}
		else
		{
			querystring += "&sapxep=1";
		}
		location.href = "index.php" + querystring;
	});

	$('#btnGiamDan').click(function(){
		var querystring = location.search;
		if(querystring.indexOf("sapxep=") > -1)
		{
			querystring = querystring.replace("sapxep=1", "sapxep=-1");
		}
		else
		{
			querystring += "&sapxep=-1";
		}
		location.href = "index.php" + querystring;
	});

	$('#btnXoaSX').click(function(){
		var querystring = location.search;
		if(querystring.indexOf("sapxep=") > -1)
		{
			if(querystring.indexOf("sapxep=1") > -1)
				querystring = querystring.replace("&sapxep=1", "");
			else if(querystring.indexOf("sapxep=-1") > -1)
				querystring = querystring.replace("&sapxep=-1", "");
			location.href = "index.php" + querystring;
		}
	});


	$('#btnGrid').click(function(){
		var querystring = location.search;
		if(querystring.indexOf("danght=") > -1)
		{
			querystring = querystring.replace("danght=list", "danght=grid");
		}
		else
		{
			querystring += "&danght=grid";
		}
		location.href = "index.php" + querystring;

		$("#danght").val("grid");
	});

	$('#btnList').click(function(){
		var querystring = location.search;
		if(querystring.indexOf("danght=") > -1)
		{
			querystring = querystring.replace("danght=grid", "danght=list");
		}
		else
		{
			querystring += "&danght=list";
		}
		location.href = "index.php" + querystring;

		$("#danght").val("list");
	});

	$('#frmDangXuat').submit(function(e){
		$('#querystr').val(location.search);
	});

	$('#DangNhap').click(function(e){
		if($('#frmDangNhap').length == 0 && $('#frmDangKy').length == 0 && location.search.indexOf('act=DangKy') < 0 && location.search.indexOf('act=DonHangDaDat') < 0)
		{
			var querystr = encodeURIComponent(location.search);
			var href = $(this).attr('href');
			$(this).attr('href', href + "&querystr=" + querystr);
		}
	});

	$('.panel-sach').css('cursor', 'pointer');

	$('.panel-sach').click(function(e){
		location.href = $(this).find('form a').attr('href');
	});

	$('.panel-sach .moi').each(function(){
		var pos = $(this).parent().find('.biasach').position();
		var s = $('.multi-book').length > 0 ? 53: 0;
		$(this).css({'top': pos.top + 130, 'left': pos.left + s});
	});

	if($('.hinh .moi').length > 0)
	{
		var w_hinh = $('.hinh img').width();
		var h_hinh = $('.hinh img').height();
		var pos_hinh = $('.hinh img').position();
		$('.hinh .moi').css({'background-color': '#b71c1c', 'color': 'white', 'width': w_hinh, 'height': 25, 'line-height': '25px','text-align': 'center', 'font-weight': 'bold', 'position': 'absolute', 'left': pos_hinh.left, 'top': pos_hinh.top + h_hinh - 25});
	}

	$('.btnThem').click(function(e){
		e.stopPropagation();
		var data;
		if(e.target.parentNode.tagName.toLowerCase() == "form")
			data = $(e.target.parentNode).serialize();
		else
			data = $(e.target.parentNode.parentNode).serialize();
		$.ajax({
			url: 'Controller/GioHang/DanhSach.php',
			method: 'post',
			data: data,
			success: function(res){
				var err = JSON.parse(res);
				if(err == 0)
					$('body').append('<div class="alert alert-success alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn đã thêm sách vào giỏ hàng thành công</div>');
				else
					$('body').append('<div class="alert alert-danger alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Lỗi!</strong> Bạn đã thêm sách vào giỏ hàng không thành công</div>');

				setTimeout(function(){
					$(".alert-top").alert("close");
				}, 5000);
			}
		})
	});

	$(".btnXoa").click(function(e){
		var tr = $(this).parent().parent();
		var masach = tr.find("[name=masach]").val();

		$.ajax({
			url: 'Controller/GioHang/DanhSach.php',
			method: 'post',
			data: {c: 'GioHang', act: 'DanhSach', btnXoa: '', masach: masach},
			success: function(res)
			{
				var err = JSON.parse(res);

				if(err == 0)
				{
					tr.remove();
					//cap nhat cot tt
					if($(".stt").length > 0)
					{
						$(".stt").each(function(index){
							$(this).text(index + 1);
						});
					}
					else
					{
						$("table").remove();
						$(".panel-footer").remove();
						$(".panel-body").html("<h5>Bạn không có sách nào trong giỏ</h5><div><a href='index.php'>Nhấp vào đây để xem các quyển sách khác</a></div>");
					}

					$('body').append('<div class="alert alert-success alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn đã xoá sản phẩm</div>');
					
					setTimeout(function(){
						$(".alert-top").alert("close");
					}, 5000);
				}
			}
		});
	})

	$('.capnhat').change(function(e){
		var input = $(this);
		var soluong = input.val();

		if(soluong > 0)
		{
			var masach = $(this).parent().parent().parent().find('[name=masach]').val();
			var tonggia = $(this).parent().parent().next().next();

			$.ajax({
				url: 'Controller/GioHang/DanhSach.php',
				method: 'post',
				data: {btnCapNhat: '', masach: masach, soluong: soluong},
				success: function(res){
					var result = JSON.parse(res);

					if(result.error == 1)
					{
						tonggia.text(result.tonggia + " VNĐ");
						input.val(result.conlai);
						$('#tonghd').text(result.tonghd + " VNĐ");

						$('body').append('<div class="alert alert-warning alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> ' + result.msg + '</div>');
						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
					else if(result.error == 0)
					{
						tonggia.text(result.tonggia + " VNĐ");
						$('#tonghd').text(result.tonghd + " VNĐ");

						$('body').append('<div class="alert alert-success alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn đã cập nhật sản phẩm</div>');
						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
				}
			});
		}
	});

	$('#slider-range').slider({
		range: true,
		min: 1000,
		max: 500000,
		values: [50000, 300000],
		slide: function(e, ui){
			var str = "Giá từ: " + ui.values[0] + " VNĐ đến: " + ui.values[1] + " VNĐ";
			$('#label-slider-range').text(str);
		}
	});

	$('#frmTimKiem').submit(function(e){
		$('input[name=gia1]').val($('#slider-range').slider("values", 0));
		$('input[name=gia2]').val($('#slider-range').slider("values", 1));
	});

	if($('#frmTimKiem').length > 0)
	{
		var gia1 = $('input[name=gia1]').val();
		var gia2 = $('input[name=gia2]').val();
		if(gia1 != '' && gia2 != '')
		{
			$('#slider-range').slider("values", 0, gia1);
			$('#slider-range').slider("values", 1, gia2);
			$('#label-slider-range').text("Giá từ: " + gia1 + " VNĐ đến: " + gia2 + " VNĐ");
		}
	}

	$('#date-picker-ngaysinh').datepicker({
		maxDate: "-18y", dateFormat: 'yy-mm-dd'
	});

	$('#frmDangKy').validate({
		rules: {
			tentk: {
				minlength: 6,
				remote: {
					url: 'Controller/KhachHang/KiemTra.php',
					type: 'post',
					data: {
						Loai: 'TenTK', tentk: function(){return $('#tentk').val();}
					}
				}
			},
			matkhau: {
				minlength: 6
			},
			r_matkhau:{
				minlength: 6,
				equalTo: '#matkhau'
			},
			sdt: {
				digits: true,
				minlength: 7
			}
		},
		messages: {
			tentk: {
				required: 'Bạn chưa nhập tên tài khoản.',
				minlength: 'Bạn phải nhập tên tài khoản trên 6 ký tự.',
				remote: 'Tên tài khoản bị trùng. Bạn hãy dùng tên khác.'
			},
			matkhau:{
				required: 'Bạn chưa nhập mật khẩu',
				minlength: 'Bạn phải nhập mật khẩu trên 6 ký tự.'
			},
			r_matkhau: {
				required: 'Bạn chưa nhập mật khẩu',
				equalTo: 'Bạn nhập lại mật khẩu chưa trùng hớp',
				minlength: 'Bạn phải nhập mật khẩu trên 6 ký tự.'
			},
			tenkh: {
				required: 'Bạn chưa nhập họ và tên.'
			},
			gioitinh: {
				required: 'Bạn chưa chọn giới tính.'
			},
			ngaysinh: {
				required: 'Bạn chưa nhập ngày sinh.'
			},
			diachi: {
				required: 'Bạn chưa nhập địa chỉ.'
			},
			sdt: {
				required: 'Bạn chưa nhập số điện thoại.',
				digits: 'Bạn nhập số điện thoại không hợp lệ.',
				minlength: 'Bạn nhập số điện thoại không hợp lệ.'
			},
			email: {
				required: 'Bạn chưa nhập địa chỉ email.',
				email: 'Bạn nhập email không hợp lệ'
			}
		}
	});

	$('#frmDangNhap').validate({
		rules:{
			tentk:{
				minlength: 6
			},
			matkhau:{
				minlength: 6
			}
		},
		messages: {
			tentk: {
				required: 'Bạn chưa nhập tên tài khoản',
				minlength: 'Bạn phải nhập tên tài khoản trên 6 ký tự.'
			},
			matkhau:{
				required: 'Bạn chưa nhập mật khẩu',
				minlength: 'Bạn phải nhập mật khẩu trên 6 ký tự.'
			}
		}
	});

	$('#doimatkhau').change(function(){
		$('#div-doimatkhau').toggle('fast');
	});

	$('#frmThongTin').validate({
		rules: {
			ngaysinh: {
				date: true
			},
			email: {
				email: true
			},
			sdt: {
				digits: true,
				minlength: 7
			},
			matkhau_cu: {
				required: "#doimatkhau:checked",
				minlength: 6,
				remote: {
					url: 'Controller/KhachHang/KiemTra.php',
					type: 'post',
					data: {
						Loai: 'MatKhauCu', matkhau_cu: function(){ return $('#matkhau_cu').val();}
					}
				}
			},
			matkhau: {
				required: "#doimatkhau:checked",
				minlength: 6
			},
			r_matkhau: {
				required: "#doimatkhau:checked",
				minlength: 6,
				equalTo: '#matkhau'
			}
		},
		messages: {
			hoten: {
				required: 'Bạn chưa nhập họ và tên.'
			},
			ngaysinh: {
				required: 'Bạn chưa nhập ngày sinh.',
				date: 'Bạn nhập ngày sinh chưa hợp lệ.'
			},
			email: {
				required: 'Bạn chưa nhập địa chỉ email.',
				email: 'Bạn nhập địa chỉ email chưa hợp lệ.'
			},
			sdt: {
				required: 'Bạn chưa nhập số điện thoại.',
				digits: 'Bạn nhập số điện thoại chưa hợp lệ.',
				minlength: 'Bạn nhập số điện thoại chưa hợp lệ.'
			},
			matkhau_cu: {
				required: 'Bạn chưa nhập mật khẩu.',
				minlength: 'Mật khẩu phải dài hơn 6 kí tự.',
				remote: 'Bạn nhập lại mật khẩu cũ chưa chính xác.'
			},
			matkhau: {
				required: 'Bạn chưa nhập mật khẩu.',
				minlength: 'Mật khẩu phải dài hơn 6 kí tự.'
			},
			r_matkhau:{
				required: 'Bạn chưa nhập mật khẩu.',
				minlength: 'Mật khẩu phải dài hơn 6 kí tự.',
				equalTo: 'Bạn nhập lại mật khẩu chưa chính xác.'
			}
		}
	});

	$('#frmDatHang').validate({
		rules: {
			sdt: {
				minlength: 7,
				digits: true
			},
			email: {
				email: true
			}
		},
		messages: {
			tennn: {
				required: "Bạn chưa nhập tên người nhận"
			},
			diachi: {
				required: "Bạn chưa nhập địa chỉ giao hàng"
			},
			sdt: {
				required: 'Bạn chưa nhập số điện thoại.',
				digits: 'Bạn nhập số điện thoại chưa hợp lệ.',
				minlength: 'Bạn nhập số điện thoại chưa hợp lệ.'
			},
			email: {
				required: 'Bạn chưa nhập địa chỉ email.',
				email: 'Bạn nhập địa chỉ email chưa hợp lệ.'
			}
		}
	});

	$('#barrating').barrating({
		theme: 'fontawesome-stars',
		deselectable: true,
		allowEmpty: true,
		onSelect: function(value)
		{
			if(value != '')
			{
				$.ajax({
					url: "Controller/Sach/DanhGia.php",
					type: "post",
					data: { DanhGia: '', masach: $('[name=masach]').val(), makh: $('[name=makh]').val(), diem: value },
					success: function(res)
					{
						var result = JSON.parse(res);
						if(result.error == 0)
						{
							$('body').append('<div class="alert alert-success alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn đã đánh giá thành công</div>');
						}
						else
						{
							$('body').append('<div class="alert alert-danger alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn cần đăng nhập để đánh giá</div>');
						}

						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
				});
			}
			else
			{
				$.ajax({
					url: "Controller/Sach/DanhGia.php",
					type: "post",
					data: { XoaDanhGia: '', masach: $('[name=masach]').val(), makh: $('[name=makh]').val()},
					success: function(res)
					{
						var result = JSON.parse(res);
						if(result.error == 0)
						{
							$('body').append('<div class="alert alert-success alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn đã huỷ đánh giá thành công</div>');
						}
						else
						{
							$('body').append('<div class="alert alert-danger alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn cần đăng nhập để huỷ đánh giá</div>');
						}

						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
				});
			}
		}
	});

	if($('#barrating').length > 0)
	{
		var pos = $('.hinh img').position();
		var width_hinh = $('.hinh img').width();
		var width_star = $('#star').width();
		var height_star = $('#star').height();
		$('#star').css({'top': pos.top - height_star/2, 'left': pos.left + width_hinh - (width_star/2)});
	}

	$('#comments-container').comments({
		textareaPlaceholderText: "Nhập lời bình luận",
		newestText: "Mới",
		oldestText: "Cũ",
		popularText: "Phổ biến",
		sendText: "Gửi bình luận",
		replyText: "Trả lời",
		editText: "Chỉnh sửa",
		editedText: "Đã chỉnh sửa",
		youText: "Bạn",
		saveText: "Lưu",
		deleteText: "Xoá",
		noCommentsText: "Không có lời bình luận nào",
		enableAttachments: false,
		enableHashtags: false,
		enablePinging: false,
		postCommentOnEnter: true,
		getComments: function(success, error)
		{
			$.ajax({
				url: 'Controller/Sach/BinhLuan.php',
				type: 'get',
				data: { masach: $('[name=masach]').val() },
				success: function(res)
				{
					var result = JSON.parse(res);
					if(result.error == 0)
						success(result.list);
				}
			});
		},
		postComment: function(comment, success, error)
		{
			comment.fullname = $('[name=tentk]').val();
			$.ajax({
				url: 'Controller/Sach/BinhLuan.php',
				type: 'post',
				data: { Them: '', masach: $('[name=masach]').val(), comment: JSON.stringify(comment) },
				success: function(res)
				{
					var result = JSON.parse(res);
					if(result.error == 0)
					{
						success(comment);
					}
					else
					{
						$('body').append('<div class="alert alert-danger alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn cần đăng nhập để bình luận</div>');
						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
				}
			});
		},
		putComment: function(comment, success, error)
		{
			comment.modified = new Date(comment.modified);
			$.ajax({
				url: 'Controller/Sach/BinhLuan.php',
				type: 'post',
				data: { CapNhat: '', masach: $('[name=masach]').val(), comment: JSON.stringify(comment) },
				success: function(res)
				{
					var result = JSON.parse(res);
					if(result.error == 0)
					{
						success(comment);
					}
				}
			});
		},
		deleteComment: function(comment, success, error)
		{
			$.ajax({
				url: 'Controller/Sach/BinhLuan.php',
				type: 'post',
				data: { Xoa: '', masach: $('[name=masach]').val(), comment: JSON.stringify(comment) },
				success: function(res)
				{
					var result = JSON.parse(res);
					if(result.error == 0)
					{
						success();
					}
				}
			});
		},
		upvoteComment: function(comment, success, error)
		{
			$.ajax({
				url: 'Controller/Sach/BinhLuan.php',
				type: 'post',
				data: { CapNhat: '', masach: $('[name=masach]').val(), comment: JSON.stringify(comment) },
				success: function(res)
				{
					var result = JSON.parse(res);
					if(result.error == 1)
					{
						comment.upvote_count--;
						comment.user_has_upvoted = false;
						$('body').append('<div class="alert alert-danger alert-top fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Thông báo!</strong> Bạn cần đăng nhập để thực hiện chức năng này</div>');
						setTimeout(function(){
							$(".alert-top").alert("close");
						}, 5000);
					}
					success(comment);
				}
			});
		}
	});
});