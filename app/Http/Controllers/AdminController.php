<?php

namespace App\Http\Controllers;
use App\Home;
use App\HomeType;
use App\Role;
use App\Role_User;
use App\User;
use Entrust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
	//
	public function index() {
		$user = User::all();
		$item_duyet = Home::where('view', 0)->get();
		$home = Home::all();
		$hometype = HomeType::all();
		return view('AdminView.index', ['user' => $user, 'item' => $item_duyet, 'home' => $home, 'hometype' => $hometype]);
	}
	public function Drop_home($id) {
		try {
			Home::where('home_id', $id)->delete();
			return response()->json([
				'error' => false,
				'message' => 'success',
			]);
		} catch (\Exception $ex) {
			return "Co loi xay ra!";
		}
	}

	public function Savehome(Request $request) {
		$id = $request->mang;
		if ($id) {

			if (count($id) > 0) {
				foreach ($id as $key => $value) {
					$data = Home::select('home_id', 'title')->where('home_id', $value)->get();
					echo '<li><a href=http://localhost/FindHomeD/detail/' . $data[0]->home_id . '>' . $data[0]->title . '</a></li>';

				}
			} else {
				return false;
			}
		}

	}
	public function manager_post_home() {
		$home = Home::orderBy('home_id', 'desc')->get();
		return view('AdminView.manager-post-home', ['home' => $home]);
	}
	public function EditShow($id, $val) {
		try {
			$home = Home::where('home_id', $id)->update(['hienthi' => $val]);

		} catch (\Exception $ex) {
			echo "Đã xảy ra lỗi!";
		}
	}
	public function DelHome($id) {
		if ($id) {
			try {
				Home::where('home_id', $id)->delete();
				return response()->json([
					'error' => false,
					'message' => 'success',
				]);
			} catch (\Exception $ex) {

			}
		} else {
			return response()->json([
				'error' => true,
				'message' => 'false',
			]);
		}

	}
	public function ManagerUser() {
		$user = User::with('roles')->get();

		return view('AdminView.manager-user', ['user' => $user]);
	}
	public function GetUser($id) {
		return $user = User::where('id', $id)->with('roles')->get();
	}

	public function OptinoUser(Request $request) {
		// Just admin or owner have right edit user
		if (Entrust::hasRole(['admin', 'owner'])) {
			$id = $request->id;
			$user = User::where('id', $id)->with('roles')->get();
			$role = $user[0]->roles[0]->name;
			// Owner not edit admin
			if (Entrust::hasRole('owner')) {
				if ($role == 'admin') {
					return redirect()->back();
				}
			}
			// if account edit yourself
			if (Auth::user()->id == $id) {
				if ($request->password != '') {
					User::where('id', $id)->update(['phone' => $request->phone, 'password' => Hash::make($request->password)]);
				} else {
					// isset pass but id = admin  = 1 so not have right edit
					User::where('id', $id)->update(['phone' => $request->phone]);
				}
			}
			// if insset password
			else if ($request->password != '') {
				User::where('id', $id)->update(['password' => Hash::make($request->password), 'phone' => $request->phone, 'status' => $request->status]);
			} else if ($id == 1) {
				if ($request->password != '') {
					User::where('id', $id)->update(['phone' => $request->phone, 'password' => Hash::make($request->password)]);
				} else {
					// isset pass but id = admin  = 1 so not have right edit
					User::where('id', $id)->update(['phone' => $request->phone]);
				}
			} else {
				User::where('id', $id)->update(['phone' => $request->phone, 'status' => $request->status]);
			}
			if ($request->role) {
				if ($id == 1) {
					return redirect()->back();
				} else {
					$role = Role_User::where('user_id', $id)->update(['role_id' => $request->role]);
				}
			}
			return redirect()->back();
		}
	}

	public function Login() {
		if (Auth::check()) {
			if (Entrust::hasRole('admin') || Entrust::hasRole('owner')) {

				return redirect('admin');
			} else {
				return view('AdminView.login');

			}} else {
			return view('AdminView.login');
		}
	}
	public function PostLogin(Request $request) {
		if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1])) {
			if (Entrust::hasRole('admin')) {
				return redirect('admin');
			} else {
				return redirect()->back()->with('alert', 'Tài khoản không chính xác!');
			}
		} else {
			return redirect()->back()->with('alert', 'Tài khoản không chính xác!');
		}
	}
	public function SignOut() {
		Auth::logout();
		return redirect()->back();
	}
	public function DelAcount($id) {
		$user = User::with('roles')->where('id', $id)->get();
		$role = $user[0]->roles[0]->name;
		if (Entrust::hasRole('owner') && $role == 'admin') {
			return response()->json([
				'error' => true,
				'message' => 'Không đủ quyền để xóa!',
			]);
		} else {
			User::find($id)->delete();
			Role_User::where('user_id', $id)->delete();
			return response()->json([
				'error' => false,
				'message' => 'success',
			]);
		}
	}

	//Quản lý mục đăng
	public function ManagerType() {
		$hometype = HomeType::all();
		return view('AdminView.manager-home-type', ['hometype' => $hometype]);
	}
	public function OptionType($id) {
		try {
			$hometype = HomeType::find($id);
			return $hometype;
		} catch (\Exception $ex) {
			return "Co loi xay ra!";
		}
	}
	public function PostOptionType(Request $request) {
		$id = $request->id;
		$hometype = HomeType::find($id);
		$hometype->nametype = $request->nametype;
		$hometype->nametypelink = $request->nametypelink;
		$hometype->status = $request->status;
		$hometype->save();
		return redirect()->back();
	}
	public function AddType(Request $request) {
		try {
			$hometype = new HomeType();
			$hometype->nametype = $request->nametype;
			$hometype->nametypelink = self::changeTitle($request->nametype);
			$hometype->status = $request->status;
			$hometype->save();
			return redirect()->back();
		} catch (\Exception $ex) {
			return "Da xay ra loi";
		}
	}

	protected function stripUnicode($str) {
		if (!$str) {
			return false;
		}

		$unicode = array(
			'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
			'd' => 'đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'i' => 'í|ì|ỉ|ĩ|ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
		);
		foreach ($unicode as $nonUnicode => $uni) {
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}

		return $str;
	}
	protected function changeTitle($str) {
		$str = trim($str);
		if ($str == "") {
			return "";
		}

		$str = str_replace('"', '', $str);
		$str = str_replace("'", '', $str);
		$str = $this->stripUnicode($str);
		$str = str_replace(' ', '-', $str);
		return $str;
	}
	public function DelType($id) {
		try {
			if ($id) {
				if (Home::where('type_id', $id)->count() == 0) {
					HomeType::find($id)->delete();
					return response()->json([
						'error' => false,
						'message' => 'success',
					]);
				} else {
					return response()->json([
						'error' => true,
						'message' => 'Chuyên mục đang được sử dụng không thể xóa!',
					]);
				}
			} else {
				return response()->json([
					'error' => true,
					'message' => 'Gặp lỗi, không thể xóa!',
				]);
			}
		} catch (\Exception $ex) {
			return "Da xay ra loi";
		}
	}
}
