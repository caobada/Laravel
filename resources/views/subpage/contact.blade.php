@extends('wrapper')
@section('title','Liên hệ')
@section('content')
<style type="text/css">
	.a{
		display: none;
	}
	.contact{
		margin-top:20px;
	}
</style>

<div class="container">
		<div class="row">
			<h2 class="contact">Liên hệ</h2>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<label>Địa chỉ:</label>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.7234791697391!2d106.68983157330568!3d10.819429743403052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528ef088603d9%3A0xcc242ee8f3dc4fda!2zMyBUcuG6p24gUXXhu5FjIFR14bqlbiwgUGjGsOG7nW5nIDEsIEfDsiBW4bqlcCwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1529647860203" width="100%" height="440" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-md-6">
					<form>
						<div class="form-group">
							<label>Họ và tên:</label>
							<input type="text" class="form-control" name="name">
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="text" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label>Nội dung:</label>
							<textarea class="form-control" rows="5" name="content">

							</textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-lg btn-warning" style="float:right;">Gửi</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection