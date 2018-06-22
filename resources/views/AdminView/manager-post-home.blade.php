@extends('AdminView.wrapper')

@section('content')
<section class="content-header">
	<h1>
		Quản lý bài đăng
		<small>Manager post</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Homes</a></li>
		<li><a href="#">Tables</a></li>
		<li class="active">Data tables</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12 col-md-12 col-12">
			<div class="box">
			<!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="manahome" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID Home</th>
								<th>Người đăng(ID)</th>
								<th>Tiêu đề</th>
								<th>Mục đăng</th>
								<th>Giá</th>
								<th>Link</th>
								<th>Lượt xem</th>
								<th>Hiển thị</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach($home as $home)
							<tr>
								<td>{{$home->home_id}}</td>
								<td>{{$home->user->username}}({{$home->user_id}})</td>
								<td>{{$home->title}}</td>
								<td>{{$home->hometype->nametype}}</td>
								<td><?php
$var = explode("@", $home->price);
if ($var[1] == 1) {
	echo number_format($var[0]) . " Nghìn/tháng";
} else {
	echo $var[0] . ' Triệu/tháng';
}

?></td>
								<td><a target="_blank" href='{{url("detail/$home->home_id")}}'><button class="btn bg-orange btn-flat margin">Xem bài viết</button></a></td>
								<td>{{$home->view}}</td>
								<td><input type="checkbox" class="check" data-id="{{$home->home_id}}" data-toggle="toggle" <?php if ($home->hienthi == 1) {
	echo 'checked="checked"';
}
?>></td>
								<td><button data-id="{{$home->home_id}}" class="btn btn-warning del-home"><i class="fa fa-trash"></i></button></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>ID Home</th>
								<th>Người đăng(ID)</th>
								<th>Tiêu đề</th>
								<th>Mục đăng</th>
								<th>Giá</th>
								<th>Link</th>
								<th>Lượt xem</th>
								<th>Hiển thị</th>
								<th>Xóa</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>

@endsection
@section('script')

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">

	$(function(){
			var data_table = $('#manahome').DataTable({
		"order": [[ 0, "desc" ]],

			});

			$(document).on('change','.check',function(){
			var val;
			var id = $(this).data('id');
			if($(this).parent('.toggle ').hasClass('off')){
				val = 0;
			}else{
				val =1;
			}
			$.ajax({
				type:'get',
				url:'editshow/'+id+'/'+val,
				success:function(resp){

				}
			});
		});

			$(document).on('click','.del-home',function(){
			var kq = confirm('Bạn có muốn xóa bài này?');
			if(kq==true){
				var id = $(this).data('id');
				var row = $(this).parents('tr');
				$.ajax({
					type:'get',
					url: 'del-home/'+id,
					success:function(resp){
						if(resp.error == false){
							data_table.row(row).remove().draw();
						}
					}
				});
			}

		});

	});

</script>
@endsection