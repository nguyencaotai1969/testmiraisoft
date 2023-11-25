<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use App\Models\Accounts;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function __construct()
    {

    }

    #danh sách tài khoản
    #payload ?getone=3
    public function index(Request $request){

    	$data = [];

 		$getone = $request->input('getone');

 		// bảng user
 		$accounts = new Accounts();

 		// truy vấn danh sách
 		$accountsQuery = $accounts::select(
 			'registerID as id_user',
 			'login as name_user',
 			'password as password_user',
 			'phone as phone_user')
 		->orderBy('registerID','DESC');

 		//lấy thông tin 1 user theo registerID
 		if (!empty($getone)) {

	        $accountsQuery->where(function ($query) use ($getone) {

	            $query->where('accounts.registerID', '=', "{$getone}")
	                ->orWhere('accounts.login', '=', "{$getone}")
	                ->orWhere('accounts.password', '=', "{$getone}")
	                ->orWhere('accounts.phone', '=', "{$getone}");
	        });
	    }

 		return $accountsQuery->paginate(20)->appends(['getone' => $getone]);
    }

    #tạo tài khoản
    #payload
		//     {
		//     "login": "user",
		//     "phone": "+84914320464",
		//     "password": "user"
		// }
    public function create(Request $request){

    	$data = $request->only('login','password','phone');

        $validator = [
            'login' => 'required|string|min:0|max:20|alpha|'.Rule::unique('accounts', 'login'),
            'password' => 'required|string|min:0|max:40',
            'phone' => [
        		'required',
        		'string',
        		'min:0',
        		'max:20',
        		'regex:/^(\+84)[0-9]{8,10}$/',
        		Rule::unique('accounts', 'phone')
        	],
        ];

        $messages = [
            'login.required'=>'Login là bắt buộc',
            'password.required'=>'Password là bắt buộc',
            'phone.required'=>'Phone là bắt buộc',
            'phone.regex'=>'Phone là bắt buộc là đầu số +84',
        ];

        $validator = Validator::make($data, $validator,$messages);

        // validate data
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 300);
        }

        try {
		    
		    Accounts::create([
		        'login' => $data['login'],
		        'phone' => $data['phone'],
		        'password' => $data['password'],
		    ]);

	        return response()->json([
	            'success' => true,
	            'message' => 'Tạo tài khoản thành công'
	        ], 200);

		} catch (QueryException $e) {

		     return response()->json([
	            'success' => false,
	            'message' => 'Tạo tài khoản không thành công'
	        ], 300);
		}
    }

    #cập nhật tài khoản
    #payload
		//     {
		//     "login": "user",
		//     "phone": "+84914320464",
		//     "password": "user"
		// }
    public function update(Request $request){

    	$registerID = $request->route('registerID');

    	$data = $request->only('login','phone','password');
		
		// Loại bỏ các phần tử không tồn tại trong mảng $data
		$data = array_filter($data, function ($value) {

		    return isset($value);
		});

	    $validator = Validator::make([
	        'registerID' => $registerID,
	        'login' => $data['login'] ?? null,
		    'phone' => $data['phone'] ?? null,
		    'password' => $data['password'] ?? null,
	    ], 
	    [
	    	'login' => 'nullable|string|min:0|max:20|alpha|'.Rule::unique('accounts', 'login'),
   		 	'registerID' => 'required|integer|min:1|exists:accounts,registerID',
   		 	'password' => 'nullable|string|min:0|max:40',
   		 	'phone' => [
   		 		'nullable',
   		 	    'string',
        		'min:0',
        		'max:20',
        		'regex:/^(\+84)[0-9]{8,10}$/'
        	],
	    ],
	    [
            'login.string'=>'Login nhập chỉ được là chuỗi',
            'phone.regex'=>'Phone là bắt buộc là đầu số +84',
        ]);
	    
        // validate data
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 300);
        }

        try {
		    
		    //cập nhật lại database
	        Accounts::where(['registerID' => $registerID])
	        ->update($data);

			return response()->json([
	            'success' => true,
	            'message' => 'Cập nhật thành công tài khoản id: '.$registerID
	        ], 200);

		} catch (QueryException $e) {

		     return response()->json([
	            'success' => false,
	            'message' => 'Cập nhật tài khoản không thành công'
	        ], 300);
		}
        
    }

    #api xóa tài khoản
    public function delete(Request $request){

    	$registerID = $request->route('registerID');

	    $validator = Validator::make([
	        'registerID' => $registerID
	    ], 
	    [
   		 	'registerID' => 'required|integer|min:1|exists:accounts,registerID',
	    ],
	    []);
	    
        // validate data
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 300);
        }

        try {
		    
		    //xóa database
	        Accounts::where(['registerID' => $registerID])
		        ->first()
		        ->forceDelete();

			return response()->json([
	            'success' => true,
	            'message' => 'Xóa thành công tài khoản id: '.$registerID
	        ], 200);

		} catch (QueryException $e) {

		     return response()->json([
	            'success' => false,
	            'message' => 'Xóa tài khoản không thành công'
	        ], 300);
		}
        
    }
}