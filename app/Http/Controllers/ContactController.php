<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Validator;

class ContactController extends Controller {
	//
	protected $contact_unread;
	public function __construct() {
		$contact_unread = Contact::where('readed', 0)->count();
		View::share('unread', $contact_unread);
	}
	public function index(Request $request) {
		$rules = array(
			'name' => 'required|string|max:30',
			'email' => 'required|string',
			'content' => 'required|string|min:5',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return response()->json([
				'code' => 403,
				'msg' => $validator->errors()->first(),
			]);
		} else {
			try {
				DB::beginTransaction();
				$new_contact = [
					'hoten' => $request->name,
					'email' => $request->email,
					'contents' => $request->content,
					'readed' => 0,
				];
				$commit = Contact::insert($new_contact);
				if ($commit) {
					DB::commit();
					return redirect()->back();
				} else {
					DB::rollBack();
					return response()->json([
						'code' => 500,
						'msg' => 'Error Server',
					]);
				}
			} catch (\Exception $ex) {
				DB::rollBack();
				return response()->json([
					'code' => 500,
					'msg' => $ex->getMessage(),
				]);
			}
		}
	}
	public function Contact() {
		return view('AdminView.contact');
	}
}
