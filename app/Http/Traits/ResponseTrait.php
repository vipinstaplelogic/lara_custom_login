<?php

namespace App\Http\Traits;

trait ResponseTrait {

    public function response($data) {
        $body = $data->json();
        if($body['status'] = "success" && $body['status_code'] == 200){
            return $body['data'];
        }
        else{
            return back()->withError('Please provide a valid cred.');
        }
        
    }
}