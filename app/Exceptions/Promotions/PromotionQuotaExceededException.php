<?php

namespace App\Exceptions\Promotions;

use Exception;

class PromotionQuotaExceededException extends Exception
{
    protected $message = 'This promotion has exceeded its quota.';
}
