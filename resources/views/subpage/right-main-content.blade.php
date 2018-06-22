
<!-- Danh mục cho thuê-->
<div class="block-right">
    <div class="title title-relate">Danh mục cho thuê</div>
    <div class="content">
        <ul>
            @foreach($hometype as $right_home_type)
            <li><a href='{{url("type/$right_home_type->nametypelink")}}'>{{$right_home_type->nametype}}
              <i class="fa fa-angle-right" aria-hidden="true"></i>
          </a>
      </li>
      @endforeach
  </ul>
</div>
</div>
<!--End danh mục cho thuê-->
<div class="side-bar-left">
    <div class="title title-relate">CÁC TIN KHÁC</div>
    <div class="sidebar-list-item">
        <div class="sidebar-item">
            <ul>
                @foreach($rand as $rand)
                <li>
                    <a href='{{url("detail/$rand->home_id")}}'>
                        <div class="item-detail">
                            <span class="item-title">{{$rand->title}}</span>
                            <span class="item-price"><?php                                      
                            $var = explode("@",$rand->price);
                            if($var[1]==1) echo  number_format($var[0])." Nghìn/tháng";
                            else echo $var[0].' Triệu/tháng';
                            ?></span>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- Quảng cáo -->
<div class="ads">
    <a target="_blank" href="https://atrungroi.com/xstc-xo-so-tu-chon-mega-645-vietlott.html"><img src="{{asset('images/ads1.gif')}}" /></a>
</div>
