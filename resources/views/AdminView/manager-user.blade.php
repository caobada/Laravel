@extends('AdminView.wrapper')
@section('content')
<style type="text/css">
.error{
	color:red;
	font-style: italic;
}

</style>
<section class="content-header">
	<h1>
		Quản lý tài khoản người dùng
		<small>Manager User</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Tables</a></li>
		<li class="active">Data tables</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="manauser" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID User</th>
								<th>Tài khoản</th>
								<th>Điện thoại</th>
								<th>Ngày tạo</th>
								<th>Trạng thái</th>
								<th>Quyền</th>
								<th>Tùy chọn</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user as $user)
							<tr @if($user->id == Auth::user()->id) style="color:#ff9c33" @endif>
								<td>{{$user->id}}</td>
								<td>{{$user->username}}</td>
								<td>{{$user->phone}}</td>
								<td>{{$user->created_at}}</td>
								<td>@if($user->status ==1)
									<button class="btn btn-xs btn-success">Active</button>
									@else
									<button class="btn btn-xs btn-warning">Block</button>
									@endif

								</td>
								<td><button class="btn btn-xs btn-info">{{ $user->roles[0]->display_name}}</button></td>
								<td><span data-toggle="tooltip" title="Chỉnh sửa"><button class="btn btn-success option" data-id="{{$user->id}}" data-toggle="modal" data-target="#modal-option" @role('owner') @if($user->roles[0]->name=="admin") disabled @endif  @endrole><i class="fa fa-gear"></i></button></span>
									<button data-id="{{$user->id}}" class="btn btn-warning del-account" @role('owner') @if($user->roles[0]->name=="admin") disabled @endif  @endrole><i class="fa fa-trash"></i></button></td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>ID User</th>
									<th>Tài khoản</th>
									<th>Điện thoại</th>
									<th>Ngày tạo</th>
									<th>Trạng thái</th>
									<th>Quyền</th>
									<th>Tùy chọn</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>

	<!--Modals-->
	<form id="option-form" method="post" action="option-user">
		<div class="modal fade" id="modal-option">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Chỉnh sửa</h4>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label>Tài khoản</label>
								<input disabled="disabled" type="text" class="form-control" name="username" id="username">
								<a id="change-pass" style="cursor: pointer;"><span>Đổi mật khẩu?</span></a>
							</div>
							<input type="hidden" name="id" id="id">
							<div class="change-pass" style="display: none">
								<div class="form-group">
									<label>Mật khẩu mới</label>
									<input type="password" class="form-control" name="password" id="password">
								</div>
								<div class="form-group">
									<label>Nhập lại mật khẩu</label>
									<input type="password" class="form-control" name="re_password" id="re_password">
								</div>
							</div>
							<div class="form-group">
								<label>Điện thoại</label>
								<input type="text" class="form-control" name="phone" id="phone">
							</div>

							<div class="row">
								<div class="form-group col-md-6">
									<label>Trạng thái</label>
									<select class="form-control" name="status" id="status">
										<option value="1">Active</option>
										<option value="2">Block</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label>Quyền</label>
									<select class="form-control" name="role" id="role" >
										<option @role('owner') disabled @endrole value="1">Admin</option>
										<option value="3">Owner</option>
										<option value="2">User</option>

									</select>
								</div>
							</div>

							{{csrf_field()}}
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>

					<!-- /.modal-content -->

					<!-- /.modal-dialog -->
				</div>
			</div>
		</form>
		@endsection
		@section('script')

		<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
		<script type="text/javascript">

			$(function(){
					jQuery.validator.addMethod("phonevn", function(value, element) {
						return this.optional(element) || /^(09|01[2|6|8|9])+([0-9]{8})/.test(value);
					}, "Số điện thoại không hợp lệ!");
					// Off toggle of button has disabled
					$(".option[disabled]").removeAttr('data-toggle');
					var curr = '<?php echo Auth::user()->id ?>';
					// Remove all option have id = 1 because it a super account
					if(curr==1){
						$('.del-account:first').remove();
					}else{
						$('.option:first').remove();
						$('.del-account:first').remove();
					}

					var data_table = $('#manauser').DataTable({
						"order": [[ 5, "asc" ]]
					});
					// Get data which use ajax for form info option
					$(document).on('click','.option',function(){
						$('.change-pass').css('display','none');
						$('#password').val('');
						$('#re_password').val('');
						var id = $(this).data('id');
						var curr = '<?php echo Auth::user()->id ?>';
						if($(this).data('id')==curr){
							$('#status').attr('disabled','disabled');
							$('#role').attr('disabled','disabled');
						}else{
							$('#status').removeAttr('disabled');
							$('#role').removeAttr('disabled');
						}
						$.ajax({
							type:'get',
							url:'getuser/'+id,
							success:function(resp){
								$('#username').val(resp[0].username);
								$('#phone').val(resp[0].phone);
								$('#status').val(resp[0].status);
								$('#id').val(resp[0].id);
								$('#role').val(resp[0].roles[0].id);
							}

						});
					});
					//xoa tai khoan

					$(document).on('click','.del-account',function(){
						var kq = confirm('Bạn có muốn xóa tài khoản này?');
						if(kq == true ){
							var id = $(this).data('id');
							var row = $(this).parents('tr');
							if(id == curr){
								alert('Bạn không thể xóa tài khoản chính bạn!');
							}else{
								$.ajax({
									type:'get',
									url:'del-account/'+id,
									success:function(resp){
										if(resp.error==true){
											alert(resp.message);
										}else{
											data_table.row(row).remove().draw();
										}
									}
								});
							}
						}
					});
					// Toogle doi password
					$('#change-pass').click(function(){
						$('.change-pass').slideToggle();
					});
					// Validate for form option
					$('#option-form').validate({
						rules:{
							phone:{
								required:true,
								number:true,
								minlength:10,
								maxlength:11,
								phonevn:true
							},
							password:{
								required:true,
								minlength:6,
								maxlength:20
							},
							re_password:{
								required:true,
								equalTo:"#password"
							}
						},
						messages:{
							phone:{
								required:"Vui lòng nhập số điện thoại",
								number:"Số điện thoại chưa đúng",
								minlength:"Số điện thoại chưa đúng",
								maxlength:"Số điện thoại chưa đúng"
							},
							password:{
								required:"Vui lòng nhập mật khẩu",
								minlength:"Mật khẩu phải trên 5 kí tự",
								maxlength:"Mật khẩu không quá 20 kí tự"

							},
							re_password:{
								required:"Vui lòng nhập mật khẩu lại",
								equalTo:"Mật khẩu không trùng khớp"
							}
						}
					});


				});

			</script>
			@endsection