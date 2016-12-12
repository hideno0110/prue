<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCreateRequest extends FormRequest
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
            'asin'       => 'required_without_all:jan_code,item_code',
            'jan_code'   => 'required_without_all:asin,item_code',
            'item_code'  => 'required_without_all:jan_code,asin',
        ];
    }
    
    public function attributes()
    {
        return [
            'asin'      => trans('adminlte_lang::message.asin'),
            'jan_code'  => trans('adminlte_lang::message.jan_code'),
            'item_code' => trans('adminlte_lang::message.item_code'),
        ];

    }
}
