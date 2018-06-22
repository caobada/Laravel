@extends('wrapper')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="block-left">
                <div class="wrapper">
                    <ul class="list-post">
                        @foreach($search as $top10)
                        <li class="post-item">
                            <div class="media item-new">
                                <div class="pull-left">
                                    <?php
                                    $img = explode(";",$top10->image);
                                    $numpic = count($img);

                                    ?>
                                    <div class="media-object" style='background-image: url({{asset("images/home/$img[0]")}})'>

                                        <div class="numpic">{{$numpic}} ảnh</div>
                                    </div>
                                </div>
                                <div class="media-body new">
                                    <h4 class="media-heading"><a href='{{url("detail/$top10->home_id")}}'>{{$top10->title}}</a></h4>
                                    <p class="sumary-new">
                                        <?php 
                                        $lenght = str_word_count($top10->desc);
                                        if($lenght>100) echo strip_tags(substr($top10->desc, 0,250)).'...';
                                        else echo strip_tags(substr($top10->desc, 0,250)).'...';
                                        ?>
                                    </p>
                                    <span class="area-new">
                                        <p>Diện tích:<b> {{$top10->area}}m<sup>2</sup></b></p>
                                    </span>
                                    <span class="location-new">
                                        <p>Khu vực: <b> {{$top10->districted->type}} {{$top10->districted->name}}, {{$top10->province->name}}</b></p>
                                    </span>
                                    <span class="price-new"><p> 
                                        <?php                                      
                                        $var = explode("@",$top10->price);
                                        if($var[1]==1) echo  number_format($var[0])." Nghìn/tháng";
                                        else echo $var[0].' Triệu/tháng';
                                        ?>
                                        
                                    </p></span>
                                </div>
                            </div>
                        </li>

                        @endforeach
                       
                    </ul>
                </div>
               
            </div>
            <!--Phân trang-->

            <!-- End phân trang -->
        </div>
        <!--Nôi dung bên trái -->
        <div class="col-lg-3">
       
     </div>
 </div>
</div>
@endsection