<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUsersRequest extends Request
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
            'name' => 'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required',
            'password'=>'required'

        ];
    }

    public function attributes()
    {
        return [
            'name'    => trans('adminlte_lang::message.fullname'),
            'email'   => trans('adminlte_lang::message.email'),
            'role_id' => trans('adminlte_lang::message.role'),
            'password'=> trans('adminlte_lang::message.password')
        ];

    }



}
