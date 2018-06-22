 @extends('wrapper')
 @section('title','Chi tiết tin')
 @section('content')
 @foreach($detail as $detail)

 <div class="container ">
  <div class="row">
    <div class="col-lg-12">
      <!-- BreadScrum-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('')}}">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="../type/{{$detail->hometype->nametypelink}}">{{$detail->hometype->nametype}}</a></li>
          <li class="breadcrumb-item"><a href='../search?type={{$detail->hometype->id}}&province={{$detail->province->provinceid}}'>{{$detail->province->name}}</a></li>
          <li class="breadcrumb-item"><a href='../search?type={{$detail->hometype->id}}&province={{$detail->province->provinceid}}&district={{$detail->districted->districtid}}'>{{$detail->districted->type}} {{$detail->districted->name}}</a></li>
        </ol>
      </nav>
      <!-- End BreadScrum-->
      <p class="post-title-lg">{{$detail->title}} </p>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12 p" id='thongtin'>
      <div class="ycc" id="sticker">
        <div class="row">
          <div class="col-lg-8">
            <div class="navigation_post_left">
              <ul>
                <li><a href="#thongtin">thông tin chung</a></li>
                <li><a href="#motachitiet">mô tả chi tiết</a></li>
                <li><a href="#bando">bản đồ</a></li>
                <li><a href="#hinhanh">hình ảnh</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="navigation_post_right">
              <ul>
                <li><span>GỌI NGAY</span> <strong>{{$detail->phone_home}}</strong></li>

                <li class="save" data-id="{{$detail->home_id}}" id="save">
                  <i class="fa fa-heart-o"></i> Lưu tin
                </li>
                <li class="save" id="dis">
                  <i class="fa fa-heart-o"></i> Bỏ lưu tin
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12 ">
      <div class="row">
        <div class="col-lg-9 ">
          <div class="summary-item">
            <div class="summary-address">
              <div class="summary_item_headline">Địa chỉ:</div>
              <div class="summary_item_info">{{$detail->street}},{{$detail->districted->type}} {{$detail->districted->name}}, {{$detail->province->name}}</div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="summary_item_headline">Loại tin rao:</div>
                <div class="summary_item_info"><a href='{{url("search?type=$detail->type_id")}}'>{{$detail->hometype->nametype}}</a></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="summary_item_headline">Đối tượng:</div>
                <div class="summary_item_info"><?php if ($detail->doituong == 0) {
	echo "Tất cả";
} else if ($detail->doituong == 1) {
	echo "Nam";
} else {
	echo "Nữ";
}
?></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="summary_item_headline">Người đăng:</div>
                <div class="summary_item_info">{{$detail->user->username}}</div>
              </div>
              <div class="col-lg-6 item-phone-post col-md-6 col-sm-6 col-xs-12">
                <div class="summary_item_headline">Số điện thoại:</div>
                <div class="summary_item_info summary_item_info_phone">
                  <i class="fa fa-phone"></i> {{$detail->phone_home}}</div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="summary_item_headline">Ngày đăng:</div>
                  <div class="summary_item_info">{{$time}} trước</div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="summary_item_headline">Diện tích:</div>
                  <div class="summary_item_info summary_item_info_area">{{$detail->area}}m<sup>2</sup></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="summary_item_headline">Giá cho thuê:</div>
                  <div class="summary_item_info summary_item_info_price">
                    <?php $var = explode("@", $detail->price);if ($var[1] == 1) {echo number_format($var[0]) . " Nghìn/tháng";} else {echo $var[0] . ' Triệu/tháng';}?>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn_response_phone"><i class="fa fa-phone"></i> 0961467216</button>
            </div>
            <div class="descript_detail">
             <div class="motachitiet">
              <h2 id="motachitiet">Thông tin mô tả</h2>
              <p>{!!$detail->desc!!}</p>
            </div>
            <h2 id="hinhanh">Hình ảnh</h2>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php $img = explode(";", $detail->image);foreach ($img as $key => $val) {?>
                  <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>" ></li>

                  <?php }?>
              </ol>


              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
               @for ($i=0;$i<count($img);$i++)
               <div class="item @if($i==0) active @endif">
                <img src='{{asset("images/home/$img[$i]")}}'  alt="..." style="height:60vh;margin-left: auto;margin-right: auto">
              </div>
              @endfor



            </div>



            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <!--Bản đồ-->
          <h2 id="bando">Bản đồ</h2>

          <input type="hidden" class="form-control" name="maps_address" id="maps_address" value="" placeholder="Nhập tên địa điểm cần tìm">
          <div id="maps_maparea">
            <div id="maps_mapcanvas" style="margin-top:10px;" class="form-group"></div>


          </div>




        </div>
      </div>
      <div class="col-lg-3 mypanel">
        <!-- Danh mục cho thuê-->
        @include('subpage.right-main-content')
        <!--End danh mục cho thuê-->

        <!-- Tin theo quan huyen-->
        <div class="block-right aaaa">
          <div class="title">Xem theo quận huyện</div>
          <div class="content">
            <ul>

              @foreach($district as $district)
              <li><a href='../search?type={{$detail->hometype->id}}&district={{$district->districtid}}'>
                {{$detail->hometype->nametype}} {{$district->type}} {{$district->name}}
              </a>
            </li>
            @endforeach

          </ul>
        </div>
      </div>
      <!--end-->
    </div>
  </div>
</div>
</div>
</div>
@endforeach
@endsection
@section('script')
<script src="{{asset('js/jquery.sticky.js')}}"></script>
<script type="text/javascript">
  var map, ele, mapH, mapW, addEle, mapL, mapN, mapZ;

  ele = 'maps_mapcanvas';
  addEle = 'maps_address';
  mapLat = 'maps_maplat';
  mapLng = 'maps_maplng';
  mapZ = 'maps_mapzoom';
  mapArea = 'maps_maparea';
  mapCenLat = 'maps_mapcenterlat';
  mapCenLng = 'maps_mapcenterlng';

// Call Google MAP API
if( ! document.getElementById('googleMapAPI') ){
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.id = 'googleMapAPI';
  s.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBYlvnWyJkPlFWqACdwauIVaE04r0nGYJ8&v=3.exp&libraries=places&callback=controlMap';
  document.body.appendChild(s);
}else{
  controlMap();
}

// Creat map and map tools
function initializeMap(){
  var zoom = parseInt($("#" + mapZ).val()), lat = parseFloat($("#" + mapLat).val()), lng = parseFloat($("#" + mapLng).val()), Clat = parseFloat($("#" + mapCenLat).val()), Clng = parseFloat($("#" + mapCenLng).val());
  Clat || (Clat =  <?php

$location_map = $detail->location_map;
$map = explode(',', $location_map);
echo $map[0];
?>, $("#" + mapCenLat).val(Clat));
  Clng || (Clng =  <?php
$location_map = $detail->location_map;
$map = explode(',', $location_map);
echo $map[1];
?>, $("#" + mapCenLng).val(Clng));
  lat || (lat = Clat, $("#" + mapLat).val(lat));
  lng || (lng = Clng, $("#" + mapLng).val(lng));
  zoom || (zoom = 20, $("#" + mapZ).val(zoom));

  mapW = $('#' + ele).innerWidth();
  mapH = mapW * 3 / 4;

  // Init MAP
  $('#' + ele).width(mapW).height(mapH > 500 ? 500 : mapH);
  map = new google.maps.Map(document.getElementById(ele),{
    zoom: zoom,
    center: {
      lat: Clat,
      lng: Clng
    }
  });

  // Init default marker
  var markers = [];
  markers[0] = new google.maps.Marker({
    map: map,
    position: new google.maps.LatLng(lat,lng),
    draggable: true,
    animation: google.maps.Animation.DROP
  });
  markerdragEvent(markers);

  // Init search box
  var searchBox = new google.maps.places.SearchBox(document.getElementById(addEle));

  google.maps.event.addListener(searchBox, 'places_changed', function(){
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location,
        draggable: true,
        animation: google.maps.Animation.DROP
      });

      markers.push(marker);
      bounds.extend(place.geometry.location);
    }

    markerdragEvent(markers);
    map.fitBounds(bounds);
    console.log( places );
  });

  // Add marker when click on map
  // google.maps.event.addListener(map, 'click', function(e) {
  //     for (var i = 0, marker; marker = markers[i]; i++) {
  //         marker.setMap(null);
  //     }

  //     markers = [];
  //   markers[0] = new google.maps.Marker({
  //         map: map,
  //         position: new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()),
  //         draggable: true,
  //         animation: google.maps.Animation.DROP
  //     });

  //     markerdragEvent(markers);
  // });

  // Event on zoom map
  google.maps.event.addListener(map, 'zoom_changed', function() {
    $("#" + mapZ).val(map.getZoom());
  });

  // Event on change center map
  google.maps.event.addListener(map, 'center_changed', function() {
    $("#" + mapCenLat).val(map.getCenter().lat());
    $("#" + mapCenLng).val(map.getCenter().lng());
    console.log( map.getCenter() );
  });
}

// Show, hide map on select change
function controlMap(manual){
  $('#' + mapArea).slideDown(100, function(){
    initializeMap();
  });

  return !1;
}

// Map Marker drag event
function markerdragEvent(markers){
  for (var i = 0, marker; marker = markers[i]; i++) {
    $("#" + mapLat).val(marker.position.lat());
    $("#" + mapLng).val(marker.position.lng());
    google.maps.event.addListener(marker, 'drag', function(e) {
      $("#" + mapLat).val(e.latLng.lat());
      $("#" + mapLng).val(e.latLng.lng());
    });
  }
}

$(function(){
$("#sticker").sticky({topSpacing:0});
$('#save').click(function(){
  $id = $(this).data('id');
  if($('.save').hasClass('disable')){
    return false;
  }

  var width = $('.post-title-lg').width();
  var partop = $(document).find('.post-title-lg').offset().top;
  var parleft = $(document).find('.post-title-lg').offset().left;
  var a =parseInt(parleft)+parseInt(width)-50;
  var top = $(document).find('#home-save').offset().top;
  var left =$(document).find('#home-save').offset().left;

  setTimeout(function(){
    $(document).find('.img-save').remove();
  },1500);

    $('.save').addClass('disable');





  $(this).css('display','none');
  $('#dis').css('display','inline-block');
  array.push($id);
  $.session.set('id',array);
  gethomesave();
});
$('#dis').click(function(){
   var chuoi = $.session.get('id');
   var id = $('.save').data('id');
   var mang = chuoi.split(',');
   mang.shift();
   var i = mang.indexOf(id.toString());
    if(i!= -1){
      mang.splice(i,1);
      mang.unshift('a');
    }
  $.session.remove('id');
  $.session.set('id',mang);
    gethomesave();
    $(this).css('display','none');
  $('#save').css('display','inline-block');
  setTimeout(function(){
      $('.save').removeClass('disable');
    },2000);



});

})
</script>
@endsection
