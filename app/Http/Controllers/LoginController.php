<?php

namespace App\Http\Controllers;

use Exception;
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
            
            $response = Http::post('http://50.116.49.118/lara_hsvphry/api/login', [
                'user_id' => $request->user_id,
                'password' => $request->password,
            ]);
            
            if ($response->successful()) {
                $body = $response->json();
                if($body['status'] = "success" && $body['status_code'] == 200){

                    $request->session()->put('authenticated', $body['data']);

                    return redirect(route('profile.index'));
                }
                else{
                    return view('auth.login', [
                        'error' => 'Please provide a valid cred.',
                    ]);
                }
            }
            if($response->failed())
            {
                return view('auth.login', [
                    'error' => 'Please provide a valid cred.',
                ]);
            }
        }catch(RequestException $e){

        }
    }
}
