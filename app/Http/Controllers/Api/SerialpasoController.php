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

class SerialpasoController extends Controller
{
    public function __construct()
    {

    }
    
    //payload
    // {
    // 	"file":"hhss",
    // 	"app_env":"0",
    // 	"contact_server":"0",
    // }
    public function create(Request $request){

    	$data = $request->only('file','app_env','contact_server');

        $validator = [
            'file' => 'required|string|min:0|max:20',
            'app_env' => 'required|numeric|min:0|max:4',
            'contact_server' => 'required|numeric|min:0|max:4',
        ];

        $messages = [
            'file.required'=>'file là bắt buộc',
            'app_env.required'=>'app_env là bắt buộc',
            'contact_server.required'=>'Contact_server là bắt buộc',
            'contact_server.regex'=>'Contact_server là bắt buộc là đầu số +84',
        ];

        $validator = Validator::make($data, $validator,$messages);

        // validate data
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 300);
        }

        //tên thư mục root
        $nameFolderleRoot =  'imprints_html_file';

		$resultListFiles = $this->list_directory(base_path($nameFolderleRoot), $data['contact_server'], $data['app_env']);
		
		if(empty($resultListFiles)){

			return response()->json([
               	'success' => false,
		        'filename' => "",
		        'message' => "Seal Info response false"
            ], 300);

		}
		// Sử dụng hàm để tìm và đọc nội dung file
		return $searchResult = $this->findAndReadFile($nameFolderleRoot, $resultListFiles, $data['file']);

    }

    //lấy danh sách file full cấp
    private function list_directory($directory, $sub1 = null, $sub2 = null)
	{ 
	    $result = [];

	    $files = glob($directory . '/*');

	    foreach ($files as $file) {
	        $fileName = basename($file);

	        if ($fileName == "." || $fileName == "..") continue;

	        if (is_dir($file)) {
	            // Nếu có key index cấp 1 và cấp 2, kiểm tra xem key index của thư mục đang lặp qua có phải là key index cấp 1 không
	            if ($sub1 !== null && array_search($fileName, $files) != $sub1) {
	                continue;
	            }

	            // Nếu có key index cấp 2, gọi đệ quy để lặp qua thư mục cấp 2 tương ứng
	            if ($sub2 !== null) {
	                $subResult = $this->list_directory($file, null, $sub2);
	                if (!empty($subResult)) {
	                    $result[$fileName] = $subResult;
	                }
	            } else {
	                $subResult = $this->list_directory($file);
	                if (!empty($subResult)) {
	                    $result[$fileName] = $subResult;
	                }
	            }
	        } else {
	            // Nếu có key index cấp 2, kiểm tra xem key index của file có phải là key index cấp 2 không
	            if ($sub2 !== null && array_search($fileName, $files) != $sub2) {
	                continue;
	            }

	            $result[] = $fileName;
	        }
	    }

	    return $result;
	}

	// tìm và đọc file
	private function findAndReadFile($nameFolderleRoot, $result, $search)
	{
	    // Duyệt qua mảng đa cấp để tìm kiếm file
	    $filteredResult = collect($result)
	        ->flatMap(function ($subResult, $folder) use ($search) {
	            return collect($subResult)
	                ->flatMap(function ($files, $subfolder) use ($folder, $search) {
	                    return collect($files)
	                        ->filter(function ($file) use ($search) {
	                            return strpos($file, $search) !== false;
	                        })
	                        ->map(function ($file) use ($folder, $subfolder) {
	                            return [
	                                'folder' => $folder,
	                                'subfolder' => $subfolder,
	                                'file' => $file,
	                            ];
	                        });
	                });
	        });

	    // Nếu có ít nhất một file được tìm thấy
	    if ($filteredResult->isNotEmpty()) {

	        $firstFile = $filteredResult->first();

	        $filePath = base_path("{$nameFolderleRoot}/{$firstFile['folder']}/{$firstFile['subfolder']}/{$firstFile['file']}");
	        
	        if (file_exists($filePath)) {

	            $fileContent = file_get_contents($filePath);

	            return [
	                'success' => true,
	                'filename' => $firstFile['file'],
	                'content' => base64_encode($fileContent),
	                'message' => "Seal Info response successfully"
	            ];
	        }
	    }

	    // Nếu không tìm thấy file, trả về thông báo không thành công
	    return [
	        'success' => false,
	        'filename' => "",
	        'message' => "Seal Info response false"
	    ];
	}

}