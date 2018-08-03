<?php

namespace App\Http\Controllers;

use App\District;
use App\Home;
use App\HomeType;
use App\Province;

class DetailController extends Controller {
	protected $province;
	protected $Menu;
	protected $rand;
	public function __construct() {
		$this->Menu = HomeType::all();
		$this->rand = Home::all()->random(3);
		$this->province = Province::orderBy('name', 'ASC')->get();
	}
	//
	public function show($id) {

		if (isset($id)) {
			try {
				$detail = Home::where('home_id', $id)->get();
				$created_at = $detail[0]->created_at;
				$date = explode(" ", $created_at)[0];
				$time = explode(" ", $created_at)[1];
				$y = explode('-', $date)[0];
				$m = explode('-', $date)[1];
				$d = explode('-', $date)[2];
				if (abs($y - date('Y')) == 0) {
					if (abs($m - date('m')) == 0) {
						if (abs($d - date('d')) == 0) {
							$H = explode(':', $time)[0];
							$i = explode(':', $time)[1];
							$s = explode(':', $time)[2];
							if (abs($H - date('H')) == 0) {
								if (abs($i - date('i')) == 0) {
									$str = "Vài giây";
								} else {
									$str = abs($i - date('i')) . ' phút';
								}
							} else {
								$str = abs($H - date('H')) . ' giờ';
							}
						} else {
							$str = abs($d - date('d')) . ' ngày';
						}
					} else {
						$str = abs($m - date('m')) . ' tháng';
					}
				} else {
					$str = abs($y - date('Y')) . ' năm';
				}

				$view = $detail[0]->view;
				$district = District::where('provinceid', $detail[0]->city)->get();
				Home::where('home_id', $id)->update(['view' => ++$view]);
				return view('subpage.detail-home', ['detail' => $detail, 'hometype' => $this->Menu, 'rand' => $this->rand, 'province' => $this->province, 'district' => $district, 'time' => $str]);

			} catch (\Exception $ex) {
				return view('errors.404');
			}

		}

	}
}
