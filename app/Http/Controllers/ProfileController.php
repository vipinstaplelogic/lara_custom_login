<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\ResponseTrait;

class ProfileController extends Controller
{
    use ResponseTrait;
    public function __construct()
    {
        $this->middleware('custom_auth');
    }
    public function index()
    {
        try{
            $url = $this->baseUrl.'profile';
            $token = request()->session()->get('authenticated');
            $data = Http::withToken($token['token'])->post($url,[
                'user_id' => $token['user_id'],
            ]);
    
            if($data->successful()){
                $profileData = $this->response($data);
            }
            return view('home', compact('profileData'));
           
        }
        catch(Exception $e){

        }
       
    }
}
