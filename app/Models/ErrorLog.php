<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class ErrorLog extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'file', 'line', 'trace', 'request', 'user_id', 'url', 'err_code', 'created_at', 'updated_at'];

    public static function newError($e, $payload = null): int
    {
        $url = '';
        try {
            $url = Request::getRequestUri();
        } catch (\Throwable $e) {

        }

        $model = new ErrorLog();
        $model->message = $e->getMessage();
        $model->file = $e->getFile();
        $model->line = $e->getLine();
        $model->trace = $e->getTraceAsString();
        $model->err_code = $e->getCode();
        $model->request = $payload ? json_encode($payload) : json_encode(request()->all());
        $model->user_id = authUser() ? authUser()->id : 0;
        $model->url = $url;
        $model->save();

        return $model->id;
    }
}
