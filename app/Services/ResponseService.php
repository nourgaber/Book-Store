<?php
namespace App\Services;

use App\Constants\ErrorConstants;

class ResponseService {


    public function generateResponseWithError ($message,$code )
{
    return $this->response([
        'error' => [
            'message' => $message,
            'status_code' => $code
        ]
        ],$code);

}

public function generateResponseWithSuccess ($message,$code,$data)
{
    return $this->response([
        'success' => [
            'data' => $data,
            'message' => $message,
            'status_code' => $code
        ]
        ],$code);

}
}