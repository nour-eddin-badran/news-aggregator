<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q' => ['nullable'],
            'source' => ['nullable', 'string', 'regex:/^[^\d]+$/'],
            'category' => ['nullable', 'string', 'regex:/^[^\d]+$/'],
            'from_date' => ['nullable', 'date_format:Y-m-d'],
            'to_date' => ['nullable', 'date_format:Y-m-d'],
            'author' => ['nullable', 'string', 'regex:/^[^\d]+$/'],
            'limit' => ['nullable', 'numeric', 'min:1', 'max:20'],
            'page' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
