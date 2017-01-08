<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FoundController extends Controller
{
    public function index(){
        //echo "<h1>Found<h1>";
        return view('found.found');
    }

    public function upload(Request $request)
    {
        $name = $request->input('name');
        $message = $request->input('message');
        $location = $request->input('location');
        $file = $request->file('image');
        $ext = array('jpg','JPEG','bmp','png');
        $valid = false;
        foreach($ext as $extension){
            if($file->getClientOriginalExtension() == $extension){
                $valid = true;
            }
        }
        if(!$valid)
        {
            return view('found.found')->with('valid', 'false');
        }
        else{
            $storage = base_path('eigencore/test/teach');
            $image_name = $this->GUIDRANDOM();
            $file_name = $image_name.".".$file->getClientOriginalExtension();
            $file->move($storage,$file_name);
            
            $now = date('Y-m-d H:i:s');

            DB::table('TrainInfo')->insert(
                ['name' => $name,
                 'location' => $location,
                 'message' => $message,
                 'found' => false,
                 'file' => $file_name,
                 'created_at' => $now,
                 'updated_at' => $now, 
                ]);
            $teach = base_path('eigencore/teach.py');
            $exec_query = '/usr/bin/python '.$teach.' '.$image_name.' '.$storage.'/'.$file_name;
            exec($exec_query , $output);

            return view('found.found')->with('uploaded', 'true');
        }
    }

    function GUIDRANDOM ($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace.
                substr($charid,  0,  8).$hyphen.
                substr($charid,  8,  4).$hyphen.
                substr($charid, 12,  4).$hyphen.
                substr($charid, 16,  4).$hyphen.
                substr($charid, 20, 12).
                $rbrace;
        return $guidv4;
    }
}
