@extends('wrapper')
@section('link')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">
@endsection
@section('content')
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<table id="table_id" class="display">
			<a href="export-database"><input type="button" name="" class="btn btn-success" value="Export Excel"></a>
			<input type="button" name="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Import Excel" style="margin: 20px 20px 20px 10px">
			<thead>
				<tr>
					<th>ID</th>
					<th>username</th>
					<th>status</th>
					<th>phone</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($user as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->username}}</td>
					<td>{{$user->status}}</td>
					<td>{{$user->phone}}</td>
					<td>Xóa</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
 @if (session('alert'))
            <script type="text/javascript">
              
                alert('Thêm thành công!');
             
            </script>
          
          @endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form_excel" action="{{url('import-db')}}" enctype="multipart/form-data">
			<div class="modal-body">
					{{ csrf_field() }}
					<input type="file" name="excel" class="form-control">
				
			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-primary">Import</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.js')}}"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable({
			'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		});

		$('#import').click(function(){
			$('#form').fadeToggle();
		});
		  $('#form_excel').validate({
      rules:{
        excel:{
          required:true,
          accept: "application/vnd.ms-excel"
        }
      },
      messages:{
        excel: {
          required: "Vui lòng chọn file",
          accept: "Vui lòng chọn đúng file excel"
        }
      }

        });
	});

</script>
@endsection