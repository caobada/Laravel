<?php

use Illuminate\Database\Seeder;
use App\Home;
class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = ['type_id'=>1,'user_id'=>1,'title'=>'nhà cho thuê học sinh sinh viên ở gò vấp','price'=>'1500000@1','area'=>'20','street'=>'114 Trần Quốc Tuấn','district'=>'Gò vấp','city'=>'Hồ Chí Minh','view'=>1,'desc'=>'PHÒNG TRỌ - CĂN HỘ ĐẦY ĐỦ TIỆN NGHI. CỬA SỔ GIỜ GIẤC TỰ DO- KHÔNG CHUNG CHỦ. BẢO VỆ 24/24 NƯỚC NÓNG LẠNH 100000/NGƯỜI /THÁNG ĐIỆN 3500KW NHÀ MỚI NGAY CHỢ Giá phòng 4t5 Hợp đồng thuê dài hạn','map_location'=>'1000000,2000000','image'=>'images/hinh1.jpeg'];
        Home::create($data);
    }
}
