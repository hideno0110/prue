<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',           //
        ];
    }

    public function attributes()
    {
        return [
            'name'    => trans('adminlte_lang::message.fullname'),
            'email'   => trans('adminlte_lang::message.email'),
            'content' => trans('adminlte_lang::message.contact_text'),
        ];

    }
}
