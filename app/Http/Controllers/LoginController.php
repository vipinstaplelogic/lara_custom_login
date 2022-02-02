<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->session()->forget('authenticated');

            $request->validate([
                'user_id' => 'bail|required',
                'password' => 'bail|required',
            ]);
                // dd($request->all());
            
            $response = Http::post('http://50.116.49.118/lara_hsvphry/api/login', [
                'user_id' => $request->user_id,
                'password' => $request->password,
            ]);
            
            if ($response->successful()) {
                $body = $response->json();
               if($body['status'] = "success"){

                   $request->session()->put('authenticated', $body['data']);
                   return redirect()->intended('success');
               }
                // dd(session()->get('authenticated'));
            }
            if($response->failed())
            {
                return view('auth.login', [
                    'message' => 'Please provide a valid cred.',
                ]);
            }
        }catch(RequestException $e){

        }
    }
}
