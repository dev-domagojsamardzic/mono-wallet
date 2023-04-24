<?php

namespace App\Exceptions\Promotions;

use Exception;

class PromotionAlreadyAssignedException extends Exception
{
    protected $message = 'You have already used this promotion code.';
}
