<?php

namespace Core\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to acces to this page';
    protected $code = 403;
}