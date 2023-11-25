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
use Illuminate\Support\Facades\File;
class CompareController extends Controller
{
    public function __construct()
    {

    }
    
    public function index(Request $request){

		$path_to_search = base_path('task3');

		$list_directorys = $this->list_directory($path_to_search);

		//lấy các file trùng trong thư mục
		$commonFiles = array_reduce($list_directorys, function ($result, $files) {
		    return ($result === null) ? $files : array_intersect($result, $files);
		});

		if(empty($commonFiles)){

			return response()->json([
	            'success' => false,
	            'message' => 'Không có file nào trùng trong thư mục'
	        ], 300);
		}
		return $commonFiles;
    }
    
    //get list file to directory
    private function list_directory($directory)
	{ 
	    $result = [];

	    $files = glob($directory . '/*');

	    if ($files === false) {
	        die("Error: $directory doesn't exist");
	    }

	    foreach ($files as $file) {
	    	
	        $fileName = basename($file);

	        if ($fileName == "." || $fileName == "..") continue;

	        if (is_dir($file)) {

	            // Đệ quy để xây dựng cấu trúc cây thư mục
	            $result[$fileName] = $this->list_directory($file);

	        } else {

	            // Thêm tên file vào mảng
	            $result[] = $fileName;
	        }
	    }

	    return $result;
	}

}