<?php
namespace App\Services;

use App\Constants\ErrorConstants;

class ResponseService {


    public static function generateResponseWithError ($message,$code )
{
        return response()->json([
        'error' => [
            'message' => $message,
            'status_code' => $code
        ]
        ],$code);

}
public static function generateResponseWithSuccess ($message,$code)
{
    return response()->json([
        'success' => [
            'message' => $message,
            'status_code' => $code
        ]
        ], $code);

}
public static function generateResponseWithSuccessData ($message,$code,$data)
{
    return response()->json([
        'success' => [
            'data' => $data,
            'message' => $message,
            'status_code' => $code
        ]
        ], $code);

}
}