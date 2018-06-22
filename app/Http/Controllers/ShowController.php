<?php

namespace App\Http\Controllers;
use App\District;
use App\Home;
use App\HomeType;
use App\Http\Controllers;
use App\Province;
use App\User;
use App\Ward;
use Excel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShowController extends Controller {
	//
	protected $province;
	protected $Menu;
	public function __construct() {
		$this->Menu = HomeType::where('status', 1)->get();
		$this->province = Province::orderBy('name', 'ASC')->get();
	}
	public function index() {
		$topviewpost = Home::orderBy('view', 'Desc')->where('hienthi', 1)->limit(6)->get();

		$top10 = Home::orderBy('home_id', 'Desc')->where('hienthi', 1)->paginate(10);
		$rand = Home::all()->random(3)->where('hienthi', 1);

		return view('subpage.main-content', ['hometype' => $this->Menu, 'top6post' => $topviewpost, 'top10s' => $top10, 'rand' => $rand, 'province' => $this->province]);

	}
	public function showDetail() {
		$rand = Home::all()->random(3)->where('hienthi', 1);
		return view('subpage.detail-home', ['hometype' => $this->Menu, 'rand' => $rand, 'province' => $this->province]);
	}

	public function province($id) {

		if (isset($id)) {

			$district = District::orderBy('name', 'ASC')->where('provinceid', $id)->get();
			echo "<option value=''>Tất cả</option>";
			foreach ($district as $district) {
				echo "<option  value='$district->districtid'>$district->type $district->name</option>";
			}
		}

	}
	public function district($id) {
		if (isset($id)) {
			if ($id == null) {
				$id = 0;
			}

			$ward = Ward::orderBy('name', 'ASC')->where('districtid', $id)->get();
			echo "<option value=''>Tất cả</option>";
			foreach ($ward as $ward) {
				echo "<option value='$ward->wardid'>$ward->type $ward->name</option>";
			}
		}
	}

	public function ShowType($type) {
		try {
			$type_id = HomeType::select('id')->where('nametypelink', $type)->get();
			$type_home = Home::where('type_id', $type_id[0]->id)->orderBy('view', 'Desc')->where('hienthi', 1)->limit(6)->get();
			$top10 = Home::where('type_id', $type_id[0]->id)->orderBy('home_id', 'Desc')->where('hienthi', 1)->paginate(10);
			$rand = Home::all()->random(3)->where('hienthi', 1);
			return view('subpage.main-content', ['hometype' => $this->Menu, 'top6post' => $type_home, 'top10s' => $top10, 'rand' => $rand, 'province' => $this->province]);
		} catch (\Exception $ex) {
			return view('errors.404');
		}
	}
	public function Datatable() {
		$data = Home::all();
		return view('subpage.datatable', ['data' => $data]);
	}
	// Export View
	public function export() {
		$data = Home::all();
		Excel::create('data', function ($excel) use ($data) {
			$excel->sheet('1', function ($sheet) use ($data) {
				$sheet->loadView('subpage.datatable', ['data' => $data, 'hometype' => $this->Menu, 'province' => $this->province]);
			});
		})->download('xls');
	}
	public function import(Request $request) {
		if ($request->hasFile('excel')) {
			$excel = $request->file('excel');
			$data = Home::all();

			try {
				$data2 = Excel::load($excel, function ($reader) {
				})->get();

				return view('subpage.datatable', ['data' => $data, 'data2' => $data2]);
			} catch (\Exception $ex) {
				echo "File excel format không chính xác!";
			}
		}
	}
	// Export DB
	public function export_db() {
		$contact = User::select('username', 'password', 'phone', 'status')->get();
		return Excel::create('data_user', function ($excel) use ($contact) {
			$excel->sheet('mysheet', function ($sheet) use ($contact) {
				$sheet->fromArray($contact);
			});
		})->export('xls');
	}
	public function import_db(Request $request) {

		if ($request->hasFile('excel')) {
			$excel = $request->file('excel');
			$data = Excel::load($excel, function ($reader) {
			})->get();
			try {
				foreach ($data as $key => $value) {
					$count = User::where('username', $value->username)->get();
					if (count($count) == 0) {
						$user = new User();
						$user->username = $value->username;
						$user->password = Hash::make($value->password);
						$user->status = $value->status;
						$user->phone = $value->phone;
						$user->save();
					};
				}
				return redirect()->back()->with('alert', 'Thêm thành công!');
			} catch (\Exception $ex) {
				return $ex->getMessage();
			}
		}
	}

	public function manager() {
		if (Auth::check()) {
			$data = Home::where('user_id', Auth::user()->id)->get();

			return view('subpage.manager', ['hometype' => $this->Menu, 'province' => $this->province, 'data' => $data]);
		} else {
			return redirect("/");
		}
	}
	public function Contact() {
		return view('subpage.contact', ['hometype' => $this->Menu, 'province' => $this->province]);
	}

}
