@extends('AdminView.wrapper')

@section('content')
<style type="text/css">
	#info{
		color:red;

	}
</style>
<section class="content-header">
	<h1>
		Quản lý chuyên mục
		<small>Manager Type</small>
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
					<table id="manatype" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên chuyên mục</th>
								<th>link</th>
								<th>Ngày tạo</th>
								<th>Trạng thái</th>
								<th><span data-toggle="tooltip" title="Thêm mới"><button class="btn btn-success" data-toggle="modal" data-target="#modal-type"><i class="fa fa-plus"></i></button></span></th>
							</tr>
						</thead>
						<tbody>
							@foreach($hometype as $hometype)
							<tr >
								<td>{{$hometype->id}}</td>
								<td>{{$hometype->nametype}}</td>
								<td>{{$hometype->nametypelink}}</td>
								<td>{{$hometype->created_at}}</td>
								<td>@if($hometype->status==1)
									<button class="btn btn-xs btn-success">Active</button>
									@else
									<button class="btn btn-xs btn-danger">Disable</button>
									@endif
								</td>
								<td><span data-toggle="tooltip" title="Chỉnh sửa"><button class="btn btn-info option-type" data-id="{{$hometype->id}}" data-toggle="modal" data-target="#modal-option"><i class="fa fa-gear"></i></button></span>
									<button data-id="{{$hometype->id}}" class="btn btn-warning del-type" ><i class="fa fa-trash"></i></button></td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Tên chuyên mục</th>
									<th>link</th>
									<th>Ngày tạo</th>
									<th>Trạng thái</th>
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
	<form id="option-form" method="post" action="option-type">
		<div class="modal fade" id="modal-option">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Chỉnh sửa</h4>
						</div>
						<div class="modal-body">
							<input type="hidden" id="id" name="id">
							<div class="form-group">
								<label>Tên chuyên mục</label>
								<input type="text" class="form-control" name="nametype" id="nametype">
							</div>
							<div class="form-group">
								<label>Tên link</label>
								<input type="text" class="form-control" name="nametypelink" id="nametypelink">
							</div>

							<div class="row">
								<div class="form-group col-md-12">
									<label>Trạng thái</label>
									<select class="form-control" name="status" id="status">
										<option value="1">Active</option>
										<option value="2">Disable</option>
									</select>
								</div>
							</div>

							{{csrf_field()}}
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
						</div>
					</div>

					<!-- /.modal-content -->

					<!-- /.modal-dialog -->
				</div>
			</div>
		</form>

		<form id="add-form" method="post" action="">
			<div class="modal fade" id="modal-type">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Thêm</h4>
							</div>
							<div class="modal-body">
								<div id="info"></div>
								<div class="form-group">
									<label>Tên chuyên mục</label>
									<input type="text" class="form-control" name="nametype" id="nametype">
								</div>
								<div class="row">
									<div class="form-group col-md-12">
										<label>Trạng thái</label>
										<select class="form-control" name="status" >
											<option value="1">Active</option>
											<option value="2">Block</option>
										</select>
									</div>
								</div>

								{{csrf_field()}}
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
								<button type="submit" id="add-type" class="btn btn-primary">Thêm</button>
							</div>
						</div>

						<!-- /.modal-content-->

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
					var data_table = $('#manatype').DataTable();

					$(document).on('click','.option-type',function(){
						var id = $(this).data('id');
						$.ajax({
							type:'get',
							url:'option-type/'+id,
							success:function(resp){
								$('#nametype').val(resp.nametype);
								$('#nametypelink').val(resp.nametypelink);
								$('#status').val(resp.status);
								$('#id').val(resp.id);
							}
						});
					});

					$(document).on('click','.del-type',function(){
						$this = $(this);
						var nd = $(this).parents('tr').find('td:nth-of-type(2)').html();
						swal({
							title: "Bạn có muốn xóa không?",
							text: "Bạn đang xóa muốn "+nd,
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: '#DD6B55',
							confirmButtonText: 'Có',
							cancelButtonText: "Không",
							closeOnConfirm: false,
							closeOnCancel: false
						},
						function(isConfirm){
							if (isConfirm){
								var id = $($this).data('id');
								var row = $($this).parents('tr');
								$.ajax({
									type:'get',
									url:'del-type/'+id,
									success:function(resp){
										if(resp.error==false)
											data_table.row(row).remove().draw();
										else
											alert(resp.message);
									}
								});
								swal("Đã xóa!", "Chuyên mục "+nd+" đã xóa thành công!", "success");
							} else {
								swal("Đã hủy", "Chuyên mục vẫn giữ nguyên", "error");
							}
						});




					});

					$('#add-form').validate({
						rules:{
							nametype:{
								required:true,
								minlength:5,
								maxlength:100
							}
						},
						messages:{
							nametype:{
								required:"Vui lòng nhập chuyên mục!",
								minlength: "Nhập tối thiểu 5 kí tự"
							}
						},
						submitHandler: addtype
					});
					$('#option-form').validate({
						rules:{
							nametype:{
								required:true
							},
							nametypelink:{
								required:true
							}
						},
						messages:{
							nametype:{
								required:"Vui lòng nhập chuyên mục!"
							},
							nametypelink:{
								required:"Vui lòng nhập chuyên mục link"
							}
						}
					});
					function addtype(){
						var data = $('#add-form').serialize();
						$.ajax({
							type:'post',
							url:'add-type',
							data:data,
							beforeSend:function(){
								$('#info').fadeOut();
							},
							success:function(resp){
								if(resp.error==false){
									swal({
										title: "Đã thêm thành công!",
										type: "success",

									},function(isConfirm){
									if (isConfirm){
										setTimeout('window.location.href ="",4000');
									}
										});

								}else{
									$("#info").fadeIn(500,function(){
										$('#info').html(resp.message);
									});
								}
							}

					});
					}
				});
			</script>
			@endsection