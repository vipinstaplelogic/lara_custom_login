<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom_auth');
    }
    public function index()
    {

        try{
            $token = request()->session()->get('authenticated');
            $data = Http::withToken($token['token'])->post('http://50.116.49.118/lara_hsvphry/api/profile',[
                'user_id' => $token['user_id'],
            ]);
    
            if($data->successful()){
                $body = $data->json();
                if($body['status'] = "success" && $body['status_code'] == 200){
                    $profileData =  $body['data'];
                }
            }
            return view('home', compact('profileData'));
           
        }
        catch(Exception $e){

        }
       
    }
}
