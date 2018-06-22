@extends('wrapper')
@section('content')


<style type="text/css">
.a{
	display: none;
}
</style>
<div class="container">
	<div class="row main">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 id="dangki">ĐĂNG KÍ</h1>
				<hr />
			</div>
		</div>
		<div class="col-md-4"></div>
		<div class="main-login main-center col-md-4">
			<form id="formreg" class="form-horizontal" method="post">
				<div class="form-group">
					<label for="username" class="cols-sm-2 control-label">Tên đăng nhập</label>
					<div class="info" style="color: red"></div>
					<div class="cols-sm-10">
						<div class="form-group has-feedback">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
							<input type="text" class="form-control" name="username"   placeholder=""  />
						</div>

					</div>
				</div>
				<div class="form-group">
					<label for="password" class="cols-sm-2 control-label">Mật khẩu</label>
					<div class="cols-sm-10">
						<div class="form-group has-feedback">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							<input id="password" type="password"  name="password" class="form-control"  placeholder=""/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="confirm-password" class="cols-sm-2 control-label">Xác thực mật khẩu</label>
					<div class="cols-sm-10">
						<div class="form-group has-feedback">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							<input id="confirm-password" type="password"  name="confirm_password" class="form-control"  placeholder=""/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="cols-sm-2 control-label">Số điện thoại</label>
					<div class="cols-sm-10">
						<div class="form-group has-feedback">
							<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
							<input id="phone" type="text" name="phone" class="form-control"  placeholder=""/>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
				</div>

				{{ csrf_field()}}
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(function(){
		jQuery.validator.addMethod("phonevn", function(value, element) {
			return this.optional(element) || /^(09|01[2|6|8|9])+([0-9]{8})/.test(value);
		}, "Số điện thoại không hợp lệ!");
		window.location.href='#dangki';
		$("#formreg").validate({
			rules: {
				username:{
					required:true,
					minlength:5
				},
				password:{
					required:true,
					minlength:5,
				},
				confirm_password:{
					required:true,
					equalTo:"#password"
				},
				phone:{
					required:true,
					minlength:10,
					maxlength:11,
					number:true,
					phonevn:true
				}
			},
			messages:{
				username:{
					required:"Vui lòng nhập Username!",
					minlength:"Username phải nhiều hơn 5 kí tự"
				},
				password:{
					required: "Vui lòng nhập password",
					minlength: "Mật khẩu phải nhiều hơn 5 kí tự"
				},
				confirm_password: {
					required:"Vui lòng nhập lại password",
					minlength: "Mật khẩu phải nhiều hơn 5 kí tự",
					equalTo: "Mật khẩu chưa trùng khớp"
				},
				phone:{
					required:"Vui lòng nhập số điện thoại",
					minlength:"Chưa nhập đúng số điện thoại",
					maxlength:"Chưa nhập đúng số điện thoại",
					number:"Chưa nhập đúng số điện thoại",
					phonevn:"Số điện thoại không hợp lệ"
				}

			},
			submitHandler: postform
		});

		function postform(){
			var data = $('#formreg').serialize();
			$.ajax({
				type:'POST',
				url:'register',
				data:data,
				beforeSend:function(){
					$('#info').fadeOut();
				},
				success:function(resp){
					if(resp.error==false){
						alert('Đăng kí thành công!');
						setTimeout('window.location.href ="",4000');
					}else{
						$(".info").fadeIn(function(){
							$('.info').html(resp.message);
						});
					}
				}
			});
		}
	})
</script>

@endsection