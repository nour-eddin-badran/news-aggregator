<?php

namespace App\Enums;

enum GeneralEnum: string
{
    case ALREADY_REGISTERED = 'already_registered';
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case INTERNAL_ERROR = 'internal_error';
    case VALIDATION = 'validation';
    case NOT_REGISTERED = 'not_registered';
    case INVALID_CREDENTIALS = 'invalid_credentials';
    case UNAUTHORIZED = 'unauthorized';
    case NOT_FOUND = 'not_found';
}
