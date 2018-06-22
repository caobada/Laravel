<footer style="margin-top: 20px;">
	<div class="footer">
			<div class="container">
				<div class="col-md-4" >
					<h2>Giới thiệu</h2>
					<p>FindHomeD. là trang web tìm kiếm phòng trọ uy tín và số người truy cập nhiều nhất Việt Nam. Với mong muốn tạo ra môi trường rộng lớn cho nhu cầu tìm kiếm nơi ăn ở cũng như nơi làm việc cho tất cả mọi người trên toàn quốc.</p>

					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>
						<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin fa-1x"></i></a></li>

					</ul>
				</div>

				<div class="col-md-4 linkstype">
					<h3>Truy tìm mục</h3>
					<ul>
						@foreach($hometype as $footer)
						<li><a href='{{url("type/$footer->nametypelink")}}'>{{$footer->nametype}}</a></li>
						@endforeach
					</ul>
				</div>

				<div class="col-md-4" >
					<h3>LIÊN HỆ</h3>
					<ul>
						<li><i class="fa fa-home fa-2x"></i> 114/3 Trần Quốc Tuấn, Phường 1, Quận Gò Vấp</li><hr>
						<li><i class="fa fa-phone fa-2x"></i> +84 0961 467 216</li><hr>
						<li><i class="fa fa-envelope fa-2x"></i> xuanmy.cntt96@gmail.com</li>
					</ul>
				</div>

			</div>
		</div>
		<div class="sub-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						&copy; 2018 <a target="_blank" href="#" title="Free Twitter Bootstrap WordPress Themes and HTML templates">DESIGN BY </a>Cao Xuân Mỹ
					</div>
                    <!--
                        All links in the footer should remain intact.
                        Licenseing information is available at: http://bootstraptaste.com/license/
                        You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Multi
                    -->
					<div class="col-md-6">
						<ul class="pull-right">
							<li><a href="#">Home</a></li>
							<li><a href="#">Đăng tin</a></li>
							<li><a href="#">Liên Hệ</a></li>

						</ul>
					</div>
				</div>

			</div>
		</div>

</footer>