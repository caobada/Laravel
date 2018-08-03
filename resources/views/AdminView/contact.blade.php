@extends('AdminView.wrapper')
@section('content')


<section class="content-header">
	<h1>
		Liên hệ
		<small>Contacts</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Contacts</a></li>

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
								<th>ID</th>
								<th>Họ tên</th>
								<th>Email</th>
								<th>Nội dung</th>
								<th>Tùy chọn</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td></td>
								<td></td>

								<td>

								</td>
								<td></td>
								<td><span data-toggle="tooltip" title="Chỉnh sửa"><button class="btn btn-success option" data-id="" data-toggle="modal" data-target="#modal-option"><i class="fa fa-gear"></i></button></span>
									<button data-id="" class="btn btn-warning" ><i class="fa fa-trash"></i></button></td>
								</tr>

							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Họ tên</th>
									<th>Email</th>
									<th>Nội dung</th>
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
	@endsection