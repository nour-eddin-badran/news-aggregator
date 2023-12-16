<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddPreferencesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sources' => ['required', 'array'],
            'sources.*' => ['numeric', 'exists:sources,id'],
            'categories' => ['required', 'array'],
            'categories.*' => ['numeric', 'exists:categories,id'],
            'authors' => ['required', 'array'],
        ];
    }
}
