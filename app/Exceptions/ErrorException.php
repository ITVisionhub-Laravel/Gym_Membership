<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    protected $statusCode;

    public function __construct($message, $statusCode)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public static function successCode()
    {
        return new self('Success', 200);
    }

    public static function createdCode()
    {
        return new self('Created Success', 201);
    }

    public static function errorMessageCode($message)
    {
        return new self($message, 400);
    }

    public static function paymentRequireCode()
    {
        return new self('Your payment require', 402);
    }

    public static function forbiddenCode()
    {
        return new self('403 Unauthorized', 403);
    }

    public static function notAllowMethodCode()
    {
        return new self('Your Method Not Allowed', 405);
    }

    public static function serverErrorCode()
    {
        return new self('Internal server error', 500);
    }

    public static function badGateWayCode()
    {
        return new self('502 Bad Gateway', 502);
    }

    public static function unavailableServiceCode()
    {
        return new self('503 Service Unavailable', 503);
    }

    public static function recordNotFoundCode($message)
    {
        return new self($message, 404);
    }

    public static function modelNotFoundCode($message)
    {
        return new self("Model not found: " . $message, 404);
    }
}
