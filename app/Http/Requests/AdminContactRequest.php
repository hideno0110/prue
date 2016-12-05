<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminContactRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'content' => 'required',           //
        ];
    }

    public function attributes()
    {
        return [
            'name'    => trans('adminlte_lang::message.fullname'),
            'email'   => trans('adminlte_lang::message.email'),
            'subject' => trans('adminlte_lang::message.contact_genre'),
            'content' => trans('adminlte_lang::message.contact_text'),
        ];

    }
}
