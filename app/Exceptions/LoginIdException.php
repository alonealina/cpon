<?php

namespace App\Exceptions;

use Exception;

class LoginIdException extends Exception
{
    public function __construct($login_id){
        parent::__construct('店舗ID”' . $login_id . '”が重複しています。', 500);
    }
}
