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
            $url = $this->baseUrl.'login';
            $request->session()->forget('authenticated');

            $request->validate([
                'user_id' => 'bail|required',
                'password' => 'bail|required',
            ]);
            
            $response = Http::post($url, [
                'user_id' => $request->user_id,
                'password' => $request->password,
            ]);
            
            if ($response->successful()) {
                $data = $this->response($response);
                $request->session()->put('authenticated', $data);

                return redirect(route('profile.index'));
            }
            if($response->failed())
            {
                return redirect(route('login'))->withError('Please provide a valid cred.');
            }
        }catch(RequestException $e){

        }
    }
}
