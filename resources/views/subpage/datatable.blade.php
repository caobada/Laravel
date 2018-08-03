
	<div class="container">
		<div class="row">
			<a href="{{url('export-excel')}}"><input type="button"  class="btn btn-success" value="Export View to Excel"></a>
			<input type="button" id="import" value="Import Excel on View" class="btn btn-success">

			<form id="form" action='{{url("import-excel")}}' method="post"  style="display: none;margin-top: 25px;" enctype="multipart/form-data">
				<input type="file"   name="excel">
				<button name="btnsubmit" type="submit">Import</button>
				{{ csrf_field() }}
			</form>

		</div>
	</div>
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<table id="table_id" class="display table-responsive">
			<thead>
				<tr>
					<th>ID Home</th>
					<th>Tiêu Đề</th>
					<th>Mô tả</th>
					<th>Địa chỉ đường</th>

					<th>Lượt view</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($data))
				@foreach($data as $data)
				<tr>
					<td>{{$data->home_id}}</td>
					<td>{{$data->title}}</td>
					<td>{!!strip_tags($data->desc)!!}</td>
					<td>{{$data->street}}</td>
					<td>{{$data->view}}</td>
				</tr>
				@endforeach
				@endif

				@if(isset($data2))
				<?php
foreach ($data2 as $key => $value) {

	?>
				<tr>
					<td><?php echo $value->id_home ?></td>
					<td><?php echo $value->tieu_de ?></td>
					<td><?php echo $value->mo_ta ?></td>
					<td><?php echo $value->dia_chi_duong ?></td>
					<td><?php echo $value->luot_view ?></td>
				</tr>
				<?php
}
?>
				@endif
			</tbody>
		</table>
	</div>
</div>



<script  src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.js')}}"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable();

		$('#import').click(function(){
		$('#form').fadeToggle();
	});
	});
</script>


	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">



