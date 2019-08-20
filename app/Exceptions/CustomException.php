<?php

namespace App\Exceptions;

use Exception;
use App\Constants\ErrorConstants;
use Symfony\Component\HttpFoundation\Response;
class CustomException extends Exception
{
  protected $message;
  protected $statusCode;
    
    
    public function __construct($message)
    {
        $this->message=ErrorConstants::ERROR_MESSAGES[$message];
        $http=ErrorConstants::ERROR_CODES[$message];
        $this->statusCode=$http;
    }

    public function getCustomExceptionStatusCode()  
    {  
    return (int) $this->statusCode;  
    }   
    public function getCustomExceptionMessage()  
    {  
    return  $this->message;  
    } 

}

