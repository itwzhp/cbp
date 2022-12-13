<?php
namespace App\Domains\Users\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    protected $code = 403;
}
