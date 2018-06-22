@extends('AdminView.wrapper')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <style type="text/css">

    .imgbox{
    display: grid;
  }
  img{
      position: relative;
      max-width:100%;
      margin: auto;
      padding: 0px 15px 0px 15px;
    }
  </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($home)}}</h3>

              <p>Bài đăng</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('admin/quan-ly-bai-dang')}}" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($item)}}</h3>

              <p>Bài chờ duyệt</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('admin/quan-ly-bai-dang')}}" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($user)}}</h3>

              <p>Người đăng kí</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('admin/quan-ly-nguoi-dung')}}" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{count($hometype)}}</h3>

              <p>Chuyên mục</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('admin/quan-ly-chuyen-muc')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="imgbox">
  <img src="{{asset('images/welcomadmin.jpg')}}">
    </div>
   <!-- /.content -->

      </div>



      </section>


  <!-- /.content-wrapper -->


@endsection