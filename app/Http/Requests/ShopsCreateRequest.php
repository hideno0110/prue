<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShopsCreateRequest extends Request
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
            //
            'shop_list_id'=>'required',
            'shop_branch_name'=>'required',

        ];
    }
    public function attributes()
    {
        return [
            'shop_list_id'    => trans('adminlte_lang::message.shop_lists'),
            'shop_branch_name'    => trans('adminlte_lang::message.shops'),
        ];
    }
}
