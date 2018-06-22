@extends('wrapper')
@section('title','Quản lý bài đăng')
@section('content')

<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-md-12">
			<table id="table_id" class="display">


				<thead>
					<tr>
						<th>ID</th>
						<th>Tiêu Đề</th>
						<th>Danh mục</th>
						<th>Giá</th>
						<th>Phone</th>
						<th>Ngày đăng</th>
						<th>Xoá</th>

					</tr>
				</thead>
				<tbody>
					@foreach($data as $data)
					<tr>
						<td>{{$data->home_id}}</td>
						<td>{{$data->title}}</td>
						<td>{{$data->hometype->nametype}}</td>
						<td><?php
$var = explode("@", $data->price);
if ($var[1] == 1) {
	echo number_format($var[0]) . " Nghìn/tháng";
} else {
	echo $var[0] . ' Triệu/tháng';
}

?></td>
						<td>{{$data->phone_home}}</td>
						<td>{{$data->created_at}}</td>
						<td style="text-align: center;"><a class="drop-home" data-id="{{$data->home_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			var table = $("#table_id").DataTable({
				"language": {
					"emptyTable": "Hiện tại không có bài đăng nào!"
				},
				'paging'      : true,
				'lengthChange': true,
				'searching'   : true,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : true

			});
			$(".drop-home").click(function(){
				var kq = confirm('Bạn có muốn xóa?');
				if(kq == true){
				var id = $(this).data('id');
				var row = $(this).parents('tr');
				$.ajax({
					type:'get',
					url:'drop-home/'+id,
					success:function(resp){
						if(resp.error==false){
							table.row(row).remove().draw();
						}
					}
				});
			 }
			});

		})
	</script>
	@endsection