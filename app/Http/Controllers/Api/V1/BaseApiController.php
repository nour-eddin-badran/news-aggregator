<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\MessageHandleHelper;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    use MessageHandleHelper;
}
