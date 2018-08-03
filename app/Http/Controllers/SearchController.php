<?php

namespace App\Http\Controllers;
use App\Home;
use App\HomeType;
use App\Province;

class SearchController extends Controller {
	protected $Menu;
	//
	public function __construct() {
		$this->Menu = HomeType::all();
		$this->province = Province::orderBy('name', 'ASC')->get();
	}
	public function Search() {
		if (isset($_GET['type'])) {
			$type = $_GET['type'];
		}

		if (isset($_GET['province'])) {
			$province = $_GET['province'];
		}

		if (isset($_GET['district'])) {
			$district = $_GET['district'];
		}

		if (isset($_GET['price'])) {
			$price = $_GET['price'];
		}

		if (isset($_GET['area'])) {
			$area = $_GET['area'];
		}

		if (!empty($type)) {
			$a = Home::where('type_id', $type)->where('hienthi', 1)->get();
		}

		if (!empty($province)) {
			$a = $a->where('city', $province);
		}

		if (!empty($district)) {
			$a = $a->where('district', $district);
		}
		if (!empty($price)) {
			$id = array();
			$tientrieu = array();
			$tiennghin = array();
			$homenghin = Home::where('price', 'like', '%@1')->get();
			$hometrieu = Home::where('price', 'like', '%@0')->get();
			foreach ($hometrieu as $key => $value) {
				array_push($tientrieu, ['id' => $value->home_id, 'price' => strrev(substr(strrev($value->price), 2))]);
			}
			foreach ($homenghin as $key => $value) {
				array_push($tiennghin, ['id' => $value->home_id, 'price' => strrev(substr(strrev($value->price), 2))]);
			}

			if ($price == 1) {
				foreach ($tientrieu as $key => $value) {
					if ((float) $value['price'] < 1) {
						array_push($id, $value['id']);
					}
				}
				foreach ($tiennghin as $key => $value) {
					if ((float) $value['price'] < 1000000) {
						array_push($id, $value['id']);
					}
				}
				$a = $a->whereIn('home_id', $id);
			}
			if ($price == 2) {
				foreach ($tientrieu as $key => $value) {
					if ((float) $value['price'] >= 1 && (float) $value['price'] <= 2) {
						array_push($id, $value['id']);
					}
				}
				foreach ($tiennghin as $key => $value) {
					if ((float) $value['price'] >= 1000000 && (float) $value['price'] <= 2000000) {
						array_push($id, $value['id']);
					}
				}
				$a = $a->whereIn('home_id', $id);
			}
			if ($price == 3) {
				foreach ($tientrieu as $key => $value) {
					if ((float) $value['price'] >= 2 && (float) $value['price'] <= 5) {
						array_push($id, $value['id']);
					}
				}
				foreach ($tiennghin as $key => $value) {
					if ((float) $value['price'] >= 2000000 && (float) $value['price'] <= 5000000) {
						array_push($id, $value['id']);
					}
				}
				$a = $a->whereIn('home_id', $id);
			}
			if ($price == 4) {
				foreach ($tientrieu as $key => $value) {
					if ((float) $value['price'] > 5) {
						array_push($id, $value['id']);
					}
				}
				foreach ($tiennghin as $key => $value) {
					if ((float) $value['price'] > 5000000) {
						array_push($id, $value['id']);
					}
				}
				$a = $a->whereIn('home_id', $id);
			}

		}
		if (!empty($area)) {
			if ($area == 1) {
				$a = $a->where('area', '<', '10');
			} else if ($area == 2) {
				$a = $a->where('area', '>', '10')->where('area', '<', '30');
			} else {
				$a = $a->where('area', '>', '30');
			}

		}

		try {
			return view('subpage.search-home', ['search' => $a, 'hometype' => $this->Menu, 'province' => $this->province]);
		} catch (\Exception $ex) {
			return "Có lỗi xảy ra!";
		}

	}
}
