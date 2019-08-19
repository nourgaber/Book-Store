<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
  protected $message;
  protected $statusCode;
    
    
    public function __construct($message)
    {
        $this->message=$message;
        $this->statusCode=ErrorConstants::ERROR_CODES[$this->message];
    }

    public function getCustomExceptionStatusCode()  
    {  
    return (int) $this->status;  
    }   
    public function getCustomExceptionMessage()  
    {  
    return  $this->message;  
    } 

}

