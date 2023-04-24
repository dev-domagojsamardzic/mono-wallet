<?php

namespace App\Exceptions\Promotions;

use Exception;

class PromotionNotValidException extends Exception
{
    protected $message = 'This promotion code is not valid.';
}
